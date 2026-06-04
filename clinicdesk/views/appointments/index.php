<?php
$pageTitle = "Appointments List";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../partials/navbar.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h1>Appointments List</h1>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <a href="index.php?page=create-appointment" class="btn btn-primary">
                        Add New Appointment
                    </a>
                </div>

                <div class="card-body">

                    <form method="GET" class="mb-3">

                        <input type="hidden" name="page" value="appointments">

                        <div class="row">

                            <div class="col-md-3">
                                <input
                                    type="number"
                                    class="form-control"
                                    name="doctor_id"
                                    placeholder="Doctor ID"
                                    value="<?= $_GET['doctor_id'] ?? '' ?>">
                            </div>

                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">All Status</option>

                                    <option value="pending"
                                        <?= (($_GET['status'] ?? '') == 'pending') ? 'selected' : '' ?>>
                                        Pending
                                    </option>

                                    <option value="confirmed"
                                        <?= (($_GET['status'] ?? '') == 'confirmed') ? 'selected' : '' ?>>
                                        Confirmed
                                    </option>

                                    <option value="completed"
                                        <?= (($_GET['status'] ?? '') == 'completed') ? 'selected' : '' ?>>
                                        Completed
                                    </option>

                                    <option value="cancelled"
                                        <?= (($_GET['status'] ?? '') == 'cancelled') ? 'selected' : '' ?>>
                                        Cancelled
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input
                                    type="date"
                                    class="form-control"
                                    name="date"
                                    value="<?= $_GET['date'] ?? '' ?>">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success">
                                    Filter
                                </button>
                            </div>

                        </div>

                    </form>

                    <table class="table table-bordered table-striped">

                        <tr>
                            <th>ID</th>
                            <th>Patient ID</th>
                            <th>Doctor ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                        <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= $appointment['id'] ?></td>
                            <td><?= $appointment['patient_id'] ?></td>
                            <td><?= $appointment['doctor_id'] ?></td>
                            <td><?= $appointment['appt_date'] ?></td>
                            <td><?= $appointment['appt_time'] ?></td>
                            <td><?= $appointment['status'] ?></td>

                            <td>
                                <a class="btn btn-sm btn-warning"
                                   href="index.php?page=edit-appointment&id=<?= $appointment['id'] ?>">
                                    Edit
                                </a>

                                <a class="btn btn-sm btn-danger"
                                   href="index.php?page=delete-appointment&id=<?= $appointment['id'] ?>"
                                   onclick="return confirm('Delete this appointment?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </table>

                    <br>

                    <div>
                        <?php if ($paginator->currentPage() > 1): ?>
                            <a class="btn btn-secondary"
                               href="index.php?page=appointments&p=<?= $paginator->currentPage() - 1 ?>">
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
                               href="index.php?page=appointments&p=<?= $paginator->currentPage() + 1 ?>">
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