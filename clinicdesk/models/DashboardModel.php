<?php

require_once __DIR__ . '/BaseModel.php';

class DashboardModel extends BaseModel
{
    public function countTable($table)
    {
        $allowedTables = [
            'users',
            'doctors',
            'appointments',
            'prescriptions',
            'specializations'
        ];

        if (!in_array($table, $allowedTables)) {
            return 0;
        }

        $result = $this->execute("SELECT COUNT(*) AS total FROM $table");

        if ($result && $row = $result->fetch_assoc()) {
            return $row['total'];
        }

        return 0;
    }

    public function appointmentsToday()
    {
        $result = $this->execute(
            "SELECT COUNT(*) AS total
             FROM appointments
             WHERE appt_date = CURDATE()"
        );

        if ($result && $row = $result->fetch_assoc()) {
            return $row['total'];
        }

        return 0;
    }
}