<?php

require_once __DIR__ . '/BaseModel.php';

class ReportModel extends BaseModel
{
    public function getAppointmentsReport()
    {
        $result = $this->execute("
            SELECT 
                a.id,
                a.appt_date,
                a.appt_time,
                a.status,
                a.reason,
                p.name AS patient_name,
                d.id AS doctor_id,
                u.name AS doctor_name
            FROM appointments a
            JOIN users p ON a.patient_id = p.id
            JOIN doctors d ON a.doctor_id = d.id
            JOIN users u ON d.user_id = u.id
            ORDER BY a.appt_date DESC
        ");

        $reports = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $reports[] = $row;
            }
        }

        return $reports;
    }
}