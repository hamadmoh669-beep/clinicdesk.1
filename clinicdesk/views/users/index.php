<?php
$pageTitle = "Users List";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Users List</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <a href="index.php?page=create-user" class="btn btn-primary">
                        Add New User
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>

                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <a class="btn btn-sm btn-warning"
                                   href="index.php?page=edit-user&id=<?= $user['id'] ?>">
                                    Edit
                                </a>

                                <?php if ($user['id'] != 1): ?>
                                    <a class="btn btn-sm btn-danger"
                                       href="index.php?page=delete-user&id=<?= $user['id'] ?>"
                                       onclick="return confirm('Delete this user?')">
                                        Delete
                                    </a>
                                <?php else: ?>
                                    <span class="badge text-bg-success">
                                        Admin Account
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>

                    <br>

                    <div>
                        <?php if ($paginator->currentPage() > 1): ?>
                            <a class="btn btn-secondary"
                               href="index.php?page=users&p=<?= $paginator->currentPage() - 1 ?>">
                                Previous
                            </a>
                        <?php endif; ?>

                        <span>
                            Page <?= $paginator->currentPage() ?>
                            of
                            <?= $paginator->totalPages() ?>
                        </span>

                        <?php if ($paginator->currentPage() < $paginator->totalPages()): ?>
                            <a class="btn btn-secondary"
                               href="index.php?page=users&p=<?= $paginator->currentPage() + 1 ?>">
                                Next
                            </a>
                        <?php endif; ?>
                    </div>

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