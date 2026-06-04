<?php
$pageTitle = "Doctors List";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Doctors List</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <a href="index.php?page=create-doctor" class="btn btn-primary">
                        Add New Doctor
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Specialization</th>
                            <th>Fee</th>
                            <th>Available Days</th>
                            <th>Action</th>
                        </tr>

                        <?php foreach ($doctors as $doctor): ?>
                        <tr>
                            <td><?= $doctor['id'] ?></td>
                            <td><?= $doctor['name'] ?></td>
                            <td><?= $doctor['specialization'] ?></td>
                            <td><?= $doctor['consultation_fee'] ?></td>
                            <td><?= $doctor['available_days'] ?></td>

                            <td>
                                <a class="btn btn-sm btn-warning"
                                   href="index.php?page=edit-doctor&id=<?= $doctor['id'] ?>">
                                    Edit
                                </a>

                                <a class="btn btn-sm btn-danger"
                                   href="index.php?page=delete-doctor&id=<?= $doctor['id'] ?>"
                                   onclick="return confirm('Delete this doctor?')">
                                    Delete
                                </a>
                            </td>
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