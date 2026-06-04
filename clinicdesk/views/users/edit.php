<?php
require_once __DIR__ . '/../../core/CSRF.php';

$pageTitle = "Edit User";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Edit User</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Update User</h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="index.php?page=edit-user">

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= CSRF::generateToken(); ?>"
                        >

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $user['id'] ?>"
                        >

                        <div class="mb-3">
                            <label>Name</label>
                            <input
                                type="text"
                                name="name"
                                value="<?= $user['name'] ?>"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                value="<?= $user['email'] ?>"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Role</label>

                            <select name="role" class="form-control">

                                <option value="admin"
                                    <?= $user['role'] == 'admin' ? 'selected' : '' ?>>
                                    Admin
                                </option>

                                <option value="doctor"
                                    <?= $user['role'] == 'doctor' ? 'selected' : '' ?>>
                                    Doctor
                                </option>

                                <option value="patient"
                                    <?= $user['role'] == 'patient' ? 'selected' : '' ?>>
                                    Patient
                                </option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Phone</label>

                            <input
                                type="text"
                                name="phone"
                                value="<?= $user['phone'] ?>"
                                class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update User
                        </button>

                        <a href="index.php?page=users"
                           class="btn btn-secondary">
                            Back To Users
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>