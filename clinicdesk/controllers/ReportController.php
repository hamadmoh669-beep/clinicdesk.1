<?php

require_once __DIR__ . '/../models/ReportModel.php';

class ReportController
{
    public function index()
    {
        $reportModel = new ReportModel();

        $reports = $reportModel->getAppointmentsReport();

        require_once __DIR__ . '/../views/reports/index.php';
    }

    public function exportCsv()
    {
        $reportModel = new ReportModel();

        $reports = $reportModel->getAppointmentsReport();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="appointments_report.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, [
            'ID',
            'Patient',
            'Doctor',
            'Date',
            'Time',
            'Status',
            'Reason'
        ]);

        foreach ($reports as $report) {
            fputcsv($output, [
                $report['id'],
                $report['patient_name'],
                $report['doctor_name'],
                $report['appt_date'],
                $report['appt_time'],
                $report['status'],
                $report['reason']
            ]);
        }

        fclose($output);
        exit;
    }
}