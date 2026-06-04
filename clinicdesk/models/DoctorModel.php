<?php

require_once __DIR__ . '/BaseModel.php';

class DoctorModel extends BaseModel
{
    public function getAll()
    {
        $result = $this->execute("
            SELECT d.*,
                   u.name,
                   s.name AS specialization
            FROM doctors d
            JOIN users u ON d.user_id = u.id
            JOIN specializations s ON d.specialization_id = s.id
        ");

        $doctors = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = $row;
            }
        }

        return $doctors;
    }

    public function findById($id)
    {
        $result = $this->execute(
            "SELECT * FROM doctors WHERE id = ? LIMIT 1",
            "i",
            [$id]
        );

        return $result && $result->num_rows > 0
            ? $result->fetch_assoc()
            : null;
    }

    public function create($data)
    {
        return $this->execute(
            "INSERT INTO doctors
            (user_id, specialization_id, bio, consultation_fee, available_days)
            VALUES (?, ?, ?, ?, ?)",
            "iisds",
            [
                $data['user_id'],
                $data['specialization_id'],
                $data['bio'],
                $data['consultation_fee'],
                $data['available_days']
            ]
        );
    }

    public function update($data)
    {
        return $this->execute(
            "UPDATE doctors
             SET specialization_id = ?,
                 bio = ?,
                 consultation_fee = ?,
                 available_days = ?
             WHERE id = ?",
            "isdsi",
            [
                $data['specialization_id'],
                $data['bio'],
                $data['consultation_fee'],
                $data['available_days'],
                $data['id']
            ]
        );
    }

    public function delete($id)
    {
        return $this->execute(
            "DELETE FROM doctors WHERE id = ?",
            "i",
            [$id]
        );
    }
}