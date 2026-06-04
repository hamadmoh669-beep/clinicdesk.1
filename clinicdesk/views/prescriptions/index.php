<?php
$pageTitle = "Prescriptions List";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Prescriptions List</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <a href="index.php?page=create-prescription"
                       class="btn btn-primary">
                        Add New Prescription
                    </a>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <tr>
                            <th>ID</th>
                            <th>Appointment ID</th>
                            <th>Diagnosis</th>
                            <th>Medications</th>
                            <th>Notes</th>
                            <th>PDF</th>
                            <th>Action</th>
                        </tr>

                        <?php foreach ($prescriptions as $prescription): ?>
                        <tr>

                            <td><?= $prescription['id'] ?></td>
                            <td><?= $prescription['appointment_id'] ?></td>
                            <td><?= $prescription['diagnosis'] ?></td>
                            <td><?= $prescription['medications'] ?></td>
                            <td><?= $prescription['notes'] ?></td>

                            <td>
                                <?php if (!empty($prescription['file_path'])): ?>
                                    <a class="btn btn-sm btn-success"
                                       href="index.php?page=download-prescription&id=<?= $prescription['id'] ?>">
                                        Download PDF
                                    </a>
                                <?php else: ?>
                                    <span class="badge text-bg-secondary">
                                        No File
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a class="btn btn-sm btn-danger"
                                   href="index.php?page=delete-prescription&id=<?= $prescription['id'] ?>"
                                   onclick="return confirm('Delete this prescription?')">
                                    Delete
                                </a>
                            </td>

                        </tr>
                        <?php endforeach; ?>

                    </table>

                    <br>

                    <a href="index.php?page=dashboard"
                       class="btn btn-outline-primary">
                        Back To Dashboard
                    </a>

                </div>

            </div>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>