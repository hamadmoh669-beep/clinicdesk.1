<?php
require_once __DIR__ . '/../../core/CSRF.php';

$pageTitle = "Add Doctor";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Add Doctor</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Create Doctor</h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="index.php?page=create-doctor">

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= CSRF::generateToken(); ?>"
                        >

                        <div class="mb-3">
                            <label>User ID</label>
                            <input
                                type="number"
                                name="user_id"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Specialization ID</label>
                            <input
                                type="number"
                                name="specialization_id"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Bio</label>
                            <textarea
                                name="bio"
                                class="form-control"
                                rows="4"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Consultation Fee</label>
                            <input
                                type="number"
                                step="0.01"
                                name="consultation_fee"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Available Days</label>
                            <input
                                type="text"
                                name="available_days"
                                class="form-control"
                                placeholder="Sun, Mon, Tue">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save Doctor
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