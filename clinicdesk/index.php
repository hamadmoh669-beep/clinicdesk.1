<?php

session_start();

require_once 'controllers/AuthController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/DoctorController.php';
require_once 'controllers/AppointmentController.php';
require_once 'controllers/PrescriptionController.php';
require_once 'controllers/ReportController.php';
require_once 'controllers/SpecializationController.php';
require_once 'models/DashboardModel.php';
require_once 'core/Auth.php';

$page = $_GET['page'] ?? 'login';

$authController = new AuthController();
$userController = new UserController();
$doctorController = new DoctorController();
$appointmentController = new AppointmentController();
$prescriptionController = new PrescriptionController();
$reportController = new ReportController();
$specializationController = new SpecializationController();
$dashboardModel = new DashboardModel();

if ($page === 'logout') {
    $authController->logout();
    exit;
}

/* Users - Admin Only */
if ($page === 'users') {
    Auth::requireRole('admin');
    $userController->index();
    exit;
}

if ($page === 'edit-user') {
    Auth::requireRole('admin');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { $userController->update(); exit; }
    $userController->edit();
    exit;
}

if ($page === 'delete-user') {
    Auth::requireRole('admin');
    $userController->delete();
    exit;
}

if ($page === 'create-user') {
    Auth::requireRole('admin');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { $userController->store(); exit; }
    $userController->create();
    exit;
}

/* Doctors - Admin Only */
if ($page === 'doctors') {
    Auth::requireRole('admin');
    $doctorController->index();
    exit;
}

if ($page === 'create-doctor') {
    Auth::requireRole('admin');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { $doctorController->store(); exit; }
    $doctorController->create();
    exit;
}

if ($page === 'edit-doctor') {
    Auth::requireRole('admin');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { $doctorController->update(); exit; }
    $doctorController->edit();
    exit;
}

if ($page === 'delete-doctor') {
    Auth::requireRole('admin');
    $doctorController->delete();
    exit;
}

/* Specializations - Admin Only */
if ($page === 'specializations') {
    Auth::requireRole('admin');
    $specializationController->index();
    exit;
}

if ($page === 'create-specialization') {
    Auth::requireRole('admin');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { $specializationController->store(); exit; }
    $specializationController->create();
    exit;
}

if ($page === 'edit-specialization') {
    Auth::requireRole('admin');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { $specializationController->update(); exit; }
    $specializationController->edit();
    exit;
}

if ($page === 'delete-specialization') {
    Auth::requireRole('admin');
    $specializationController->delete();
    exit;
}

/* Appointments - Logged Users */
if ($page === 'appointments') {
    Auth::requireRole('admin', 'doctor', 'patient');
    $appointmentController->index();
    exit;
}

if ($page === 'create-appointment') {
    Auth::requireRole('admin', 'patient');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { $appointmentController->store(); exit; }
    $appointmentController->create();
    exit;
}

if ($page === 'edit-appointment') {
    Auth::requireRole('admin', 'doctor');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { $appointmentController->update(); exit; }
    $appointmentController->edit();
    exit;
}

if ($page === 'delete-appointment') {
    Auth::requireRole('admin', 'patient');
    $appointmentController->delete();
    exit;
}

/* Prescriptions */
if ($page === 'prescriptions') {
    Auth::requireRole('admin', 'doctor', 'patient');
    $prescriptionController->index();
    exit;
}

if ($page === 'create-prescription') {
    Auth::requireRole('admin', 'doctor');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { $prescriptionController->store(); exit; }
    $prescriptionController->create();
    exit;
}

if ($page === 'download-prescription') {
    Auth::requireRole('admin', 'doctor', 'patient');
    $prescriptionController->download();
    exit;
}

if ($page === 'delete-prescription') {
    Auth::requireRole('admin', 'doctor');
    $prescriptionController->delete();
    exit;
}

/* Reports - Admin Only */
if ($page === 'reports') {
    Auth::requireRole('admin');
    $reportController->index();
    exit;
}

if ($page === 'export-reports') {
    Auth::requireRole('admin');
    $reportController->exportCsv();
    exit;
}

/* Dashboard */
if ($page === 'dashboard') {
    Auth::requireRole('admin', 'doctor', 'patient');

    $user = Auth::currentUser();

    if ($user['role'] === 'admin') {
        $stats = [
            'users' => $dashboardModel->countTable('users'),
            'doctors' => $dashboardModel->countTable('doctors'),
            'appointments' => $dashboardModel->countTable('appointments'),
            'prescriptions' => $dashboardModel->countTable('prescriptions'),
            'specializations' => $dashboardModel->countTable('specializations'),
            'appointments_today' => $dashboardModel->appointmentsToday()
        ];

        require_once 'views/dashboard/admin.php';
    } elseif ($user['role'] === 'doctor') {
        require_once 'views/dashboard/doctor.php';
    } else {
        require_once 'views/dashboard/patient.php';
    }

    exit;
}

/* Login POST */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->handleLogin();
    exit;
}

/* Login Page */
$authController->login();