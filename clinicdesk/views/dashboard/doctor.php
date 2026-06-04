<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
</head>
<body>

<h1>Doctor Dashboard</h1>

<p>Welcome Doctor</p>

<p>
    <a href="index.php?page=appointments">
        View Appointments
    </a>
</p>

<p>
    <a href="index.php?page=prescriptions">
        Manage Prescriptions
    </a>
</p>

<form method="POST" action="index.php?page=logout">
    <button type="submit">
        Logout
    </button>
</form>

</body>
</html>