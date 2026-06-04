<?php
require_once __DIR__ . '/../../core/CSRF.php';

$pageTitle = "Add Appointment";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Add Appointment</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Create Appointment</h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="index.php?page=create-appointment">

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= CSRF::generateToken(); ?>"
                        >

                        <div class="mb-3">
                            <label>Patient ID</label>
                            <input
                                type="number"
                                name="patient_id"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Doctor ID</label>
                            <input
                                type="number"
                                name="doctor_id"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Appointment Date</label>
                            <input
                                type="date"
                                name="appointment_date"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>

                            <select name="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save Appointment
                        </button>

                        <a href="index.php?page=appointments"
                           class="btn btn-secondary">
                            Back To Appointments
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>