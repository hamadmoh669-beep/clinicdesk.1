<?php

require_once __DIR__ . '/../models/AppointmentModel.php';
require_once __DIR__ . '/../core/CSRF.php';
require_once __DIR__ . '/../core/Paginator.php';

class AppointmentController
{
    public function index()
    {
        $appointmentModel = new AppointmentModel();

        $filters = [
            'status' => $_GET['status'] ?? '',
            'doctor_id' => $_GET['doctor_id'] ?? '',
            'date' => $_GET['date'] ?? ''
        ];

        $currentPage = $_GET['p'] ?? 1;
        $perPage = 5;

        $totalAppointments = $appointmentModel->countFiltered($filters);

        $paginator = new Paginator($totalAppointments, $perPage, $currentPage);

        $appointments = $appointmentModel->getFilteredPaginated(
            $filters,
            $perPage,
            $paginator->offset()
        );

        require_once __DIR__ . '/../views/appointments/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/appointments/create.php';
    }

    public function store()
    {
        if (
            !isset($_POST['csrf_token']) ||
            !CSRF::validateToken($_POST['csrf_token'])
        ) {
            die('Invalid CSRF Token');
        }

        $appointmentModel = new AppointmentModel();

        $doctorId = $_POST['doctor_id'];
        $date = $_POST['appointment_date'];
        $time = '09:00:00';

        if ($appointmentModel->hasConflict($doctorId, $date, $time)) {
            die('This slot is already booked, please choose another date.');
        }

        $appointmentModel->create([
            'patient_id' => $_POST['patient_id'],
            'doctor_id' => $doctorId,
            'appt_date' => $date,
            'appt_time' => $time,
            'status' => $_POST['status'],
            'reason' => 'General Checkup'
        ]);

        header("Location: index.php?page=appointments");
        exit;
    }

    public function edit()
    {
        $appointmentModel = new AppointmentModel();

        $appointment = $appointmentModel->findById($_GET['id']);

        require_once __DIR__ . '/../views/appointments/edit.php';
    }

    public function update()
    {
        if (
            !isset($_POST['csrf_token']) ||
            !CSRF::validateToken($_POST['csrf_token'])
        ) {
            die('Invalid CSRF Token');
        }

        $appointmentModel = new AppointmentModel();

        $appointmentModel->update([
            'id' => $_POST['id'],
            'patient_id' => $_POST['patient_id'],
            'doctor_id' => $_POST['doctor_id'],
            'appt_date' => $_POST['appointment_date'],
            'appt_time' => '09:00:00',
            'status' => $_POST['status'],
            'reason' => 'General Checkup'
        ]);

        header("Location: index.php?page=appointments");
        exit;
    }

    public function delete()
    {
        $appointmentModel = new AppointmentModel();

        $appointmentModel->delete($_GET['id']);

        header("Location: index.php?page=appointments");
        exit;
    }
}