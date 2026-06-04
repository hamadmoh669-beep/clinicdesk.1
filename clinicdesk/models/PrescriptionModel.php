<?php

require_once __DIR__ . '/BaseModel.php';

class PrescriptionModel extends BaseModel
{
    public function getAll()
    {
        $result = $this->execute("SELECT * FROM prescriptions");

        $prescriptions = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $prescriptions[] = $row;
            }
        }

        return $prescriptions;
    }

    public function findById($id)
    {
        $result = $this->execute(
            "SELECT * FROM prescriptions WHERE id = ? LIMIT 1",
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
            "INSERT INTO prescriptions
            (appointment_id, diagnosis, medications, notes, file_path)
            VALUES (?, ?, ?, ?, ?)",
            "isssс",
            [
                $data['appointment_id'],
                $data['diagnosis'],
                $data['medications'],
                $data['notes'],
                $data['file_path']
            ]
        );
    }

    public function delete($id)
    {
        return $this->execute(
            "DELETE FROM prescriptions WHERE id = ?",
            "i",
            [$id]
        );
    }
}