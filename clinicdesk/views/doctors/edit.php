<?php
require_once __DIR__ . '/../../core/CSRF.php';

$pageTitle = "Edit Doctor";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Edit Doctor</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Update Doctor</h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="index.php?page=edit-doctor">

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= CSRF::generateToken(); ?>"
                        >

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $doctor['id'] ?>"
                        >

                        <div class="mb-3">
                            <label>Specialization ID</label>
                            <input
                                type="number"
                                name="specialization_id"
                                value="<?= $doctor['specialization_id'] ?>"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Bio</label>
                            <textarea
                                name="bio"
                                class="form-control"
                                rows="4"><?= $doctor['bio'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Consultation Fee</label>
                            <input
                                type="number"
                                step="0.01"
                                name="consultation_fee"
                                value="<?= $doctor['consultation_fee'] ?>"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Available Days</label>
                            <input
                                type="text"
                                name="available_days"
                                value="<?= $doctor['available_days'] ?>"
                                class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update Doctor
                        </button>

                        <a href="index.php?page=doctors"
                           class="btn btn-secondary">
                            Back To Doctors
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>