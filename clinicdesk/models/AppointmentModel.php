<?php

require_once __DIR__ . '/BaseModel.php';

class AppointmentModel extends BaseModel
{
    public function getAll()
    {
        $result = $this->execute("SELECT * FROM appointments ORDER BY appt_date DESC");

        $appointments = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row;
            }
        }

        return $appointments;
    }

    public function getFilteredPaginated($filters, $limit, $offset)
    {
        $sql = "SELECT * FROM appointments";
        $conditions = [];
        $types = "";
        $params = [];

        if (!empty($filters['status'])) {
            $conditions[] = "status = ?";
            $types .= "s";
            $params[] = $filters['status'];
        }

        if (!empty($filters['doctor_id'])) {
            $conditions[] = "doctor_id = ?";
            $types .= "i";
            $params[] = $filters['doctor_id'];
        }

        if (!empty($filters['date'])) {
            $conditions[] = "appt_date = ?";
            $types .= "s";
            $params[] = $filters['date'];
        }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY appt_date DESC LIMIT ? OFFSET ?";
        $types .= "ii";
        $params[] = $limit;
        $params[] = $offset;

        $result = $this->execute($sql, $types, $params);

        $appointments = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row;
            }
        }

        return $appointments;
    }

    public function countFiltered($filters)
    {
        $sql = "SELECT COUNT(*) AS total FROM appointments";
        $conditions = [];
        $types = "";
        $params = [];

        if (!empty($filters['status'])) {
            $conditions[] = "status = ?";
            $types .= "s";
            $params[] = $filters['status'];
        }

        if (!empty($filters['doctor_id'])) {
            $conditions[] = "doctor_id = ?";
            $types .= "i";
            $params[] = $filters['doctor_id'];
        }

        if (!empty($filters['date'])) {
            $conditions[] = "appt_date = ?";
            $types .= "s";
            $params[] = $filters['date'];
        }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $result = $this->execute($sql, $types, $params);

        if ($result && $row = $result->fetch_assoc()) {
            return $row['total'];
        }

        return 0;
    }

    public function findById($id)
    {
        $result = $this->execute(
            "SELECT * FROM appointments WHERE id = ? LIMIT 1",
            "i",
            [$id]
        );

        return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    public function hasConflict($doctorId, $date, $time)
    {
        $result = $this->execute(
            "SELECT id FROM appointments
             WHERE doctor_id = ?
             AND appt_date = ?
             AND appt_time = ?
             LIMIT 1",
            "iss",
            [$doctorId, $date, $time]
        );

        return $result && $result->num_rows > 0;
    }

    public function create($data)
    {
        return $this->execute(
            "INSERT INTO appointments
            (patient_id, doctor_id, appt_date, appt_time, status, reason)
            VALUES (?, ?, ?, ?, ?, ?)",
            "iissss",
            [
                $data['patient_id'],
                $data['doctor_id'],
                $data['appt_date'],
                $data['appt_time'],
                $data['status'],
                $data['reason']
            ]
        );
    }

    public function update($data)
    {
        return $this->execute(
            "UPDATE appointments
             SET patient_id=?, doctor_id=?, appt_date=?, appt_time=?, status=?, reason=?
             WHERE id=?",
            "iissssi",
            [
                $data['patient_id'],
                $data['doctor_id'],
                $data['appt_date'],
                $data['appt_time'],
                $data['status'],
                $data['reason'],
                $data['id']
            ]
        );
    }

    public function delete($id)
    {
        return $this->execute(
            "DELETE FROM appointments WHERE id = ?",
            "i",
            [$id]
        );
    }
}