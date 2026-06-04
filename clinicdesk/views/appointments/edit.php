<?php
require_once __DIR__ . '/../../core/CSRF.php';

/** @var array $appointment */
?>

<h2>Edit Appointment</h2>

<form method="POST" action="index.php?page=edit-appointment">

    <input
        type="hidden"
        name="csrf_token"
        value="<?= CSRF::generateToken(); ?>"
    >

    <input type="hidden" name="id" value="<?= $appointment['id'] ?>">

    <p>
        Patient ID:
        <input type="number" name="patient_id" value="<?= $appointment['patient_id'] ?>" required>
    </p>

    <p>
        Doctor ID:
        <input type="number" name="doctor_id" value="<?= $appointment['doctor_id'] ?>" required>
    </p>

    <p>
        Appointment Date:
        <input type="date" name="appointment_date" value="<?= $appointment['appt_date'] ?>" required>
    </p>

    <p>
        Status:
        <select name="status">
            <option value="pending" <?= $appointment['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="confirmed" <?= $appointment['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
            <option value="completed" <?= $appointment['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
            <option value="cancelled" <?= $appointment['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>
    </p>

    <button type="submit">
        Update Appointment
    </button>

</form>

<br>

<a href="index.php?page=appointments">
    Back To Appointments
</a>