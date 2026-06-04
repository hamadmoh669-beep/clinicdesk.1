<?php
$pageTitle = "Appointments Report";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Appointments Report</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <a href="index.php?page=export-reports" class="btn btn-success">
                        Export CSV
                    </a>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Reason</th>
                        </tr>

                        <?php foreach ($reports as $report): ?>
                        <tr>
                            <td><?= $report['id'] ?></td>
                            <td><?= $report['patient_name'] ?></td>
                            <td><?= $report['doctor_name'] ?></td>
                            <td><?= $report['appt_date'] ?></td>
                            <td><?= $report['appt_time'] ?></td>
                            <td><?= $report['status'] ?></td>
                            <td><?= $report['reason'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>

                    <br>

                    <a href="index.php?page=dashboard" class="btn btn-outline-primary">
                        Back To Dashboard
                    </a>

                </div>

            </div>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>