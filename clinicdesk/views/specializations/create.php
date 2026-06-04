<?php
require_once __DIR__ . '/../../core/CSRF.php';

$pageTitle = "Add Specialization";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Add Specialization</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Create Specialization</h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="index.php?page=create-specialization">

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= CSRF::generateToken(); ?>"
                        >

                        <div class="mb-3">
                            <label>Specialization Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Specialization Name"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>

                        <a href="index.php?page=specializations"
                           class="btn btn-secondary">
                            Back
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>