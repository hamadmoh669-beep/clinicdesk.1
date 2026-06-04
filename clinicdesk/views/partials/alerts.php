<?php if (!empty($_GET['success'])): ?>
    <p style="color:green">
        <?= htmlspecialchars($_GET['success']) ?>
    </p>
<?php endif; ?>

<?php if (!empty($_GET['error'])): ?>
    <p style="color:red">
        <?= htmlspecialchars($_GET['error']) ?>
    </p>
<?php endif; ?>