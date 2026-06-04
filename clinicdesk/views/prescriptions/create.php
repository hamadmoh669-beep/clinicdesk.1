<?php
require_once __DIR__ . '/../../core/CSRF.php';

$pageTitle = "Add Prescription";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Add Prescription</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Create Prescription</h3>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="index.php?page=create-prescription"
                          enctype="multipart/form-data">

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= CSRF::generateToken(); ?>"
                        >

                        <div class="mb-3">
                            <label>Appointment ID</label>
                            <input
                                type="number"
                                name="appointment_id"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Diagnosis</label>
                            <textarea
                                name="diagnosis"
                                class="form-control"
                                rows="4"
                                required></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Medications</label>
                            <textarea
                                name="medications"
                                class="form-control"
                                rows="4"
                                required></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Notes</label>
                            <textarea
                                name="notes"
                                class="form-control"
                                rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Prescription PDF</label>
                            <input
                                type="file"
                                name="prescription_file"
                                class="form-control"
                                accept="application/pdf">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save Prescription
                        </button>

                        <a href="index.php?page=prescriptions"
                           class="btn btn-secondary">
                            Back To Prescriptions
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>