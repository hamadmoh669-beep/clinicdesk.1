<?php
$pageTitle = "Specializations";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Specializations</h1>
        </div>
    </div>

    <div class="app-content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <a href="index.php?page=create-specialization"
                       class="btn btn-primary">
                        Add New Specialization
                    </a>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th width="180">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($specializations as $specialization): ?>
                        <tr>

                            <td><?= $specialization['id'] ?></td>

                            <td><?= $specialization['name'] ?></td>

                            <td>

                                <a href="index.php?page=edit-specialization&id=<?= $specialization['id'] ?>"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="index.php?page=delete-specialization&id=<?= $specialization['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete specialization?')">
                                    Delete
                                </a>

                            </td>

                        </tr>
                        <?php endforeach; ?>

                        </tbody>

                    </table>

                    <br>

                    <a href="index.php?page=dashboard"
                       class="btn btn-secondary">
                        Back To Dashboard
                    </a>

                </div>

            </div>

        </div>

    </div>

</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>