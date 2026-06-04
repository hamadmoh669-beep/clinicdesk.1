<?php
$pageTitle = "Admin Dashboard";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Welcome Admin</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <h3>Dashboard Statistics</h3>

            <div class="row">
                <div class="col-md-3">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3><?= $stats['users'] ?></h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3><?= $stats['doctors'] ?></h3>
                            <p>Total Doctors</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3><?= $stats['appointments'] ?></h3>
                            <p>Total Appointments</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3><?= $stats['prescriptions'] ?></h3>
                            <p>Total Prescriptions</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Management</h3>
                </div>

                <div class="card-body">
                    <p><a href="index.php?page=users">Manage Users</a></p>
                    <p><a href="index.php?page=doctors">Manage Doctors</a></p>
                    <p><a href="index.php?page=specializations">Manage Specializations</a></p>
                    <p><a href="index.php?page=appointments">Manage Appointments</a></p>
                    <p><a href="index.php?page=prescriptions">Manage Prescriptions</a></p>
                    <p><a href="index.php?page=reports">View Reports</a></p>
                </div>
            </div>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>