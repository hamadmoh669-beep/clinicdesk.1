<?php

require_once __DIR__ . '/../models/PrescriptionModel.php';
require_once __DIR__ . '/../core/CSRF.php';

class PrescriptionController
{
    public function index()
    {
        $prescriptionModel = new PrescriptionModel();

        $prescriptions = $prescriptionModel->getAll();

        require_once __DIR__ . '/../views/prescriptions/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/prescriptions/create.php';
    }

    public function store()
    {
        if (
            !isset($_POST['csrf_token']) ||
            !CSRF::validateToken($_POST['csrf_token'])
        ) {
            die('Invalid CSRF Token');
        }

        $filePath = null;

        if (
            isset($_FILES['prescription_file']) &&
            $_FILES['prescription_file']['error'] === UPLOAD_ERR_OK
        ) {
            $file = $_FILES['prescription_file'];

            if ($file['size'] > 3 * 1024 * 1024) {
                die('PDF file is too large. Max size is 3MB.');
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            if ($mimeType !== 'application/pdf') {
                die('Only PDF files are allowed.');
            }

            $uploadDir = __DIR__ . '/../public/uploads/prescriptions/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = 'prescription_' . $_POST['appointment_id'] . '_' . time() . '.pdf';

            $targetPath = $uploadDir . $fileName;

            if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                die('Failed to upload prescription file.');
            }

            $filePath = 'public/uploads/prescriptions/' . $fileName;
        }

        $prescriptionModel = new PrescriptionModel();

        $prescriptionModel->create([
            'appointment_id' => $_POST['appointment_id'],
            'diagnosis' => $_POST['diagnosis'],
            'medications' => $_POST['medications'],
            'notes' => $_POST['notes'],
            'file_path' => $filePath
        ]);

        header("Location: index.php?page=prescriptions");
        exit;
    }

    public function download()
    {
        $id = $_GET['id'] ?? 0;

        $prescriptionModel = new PrescriptionModel();

        $prescription = $prescriptionModel->findById($id);

        if (!$prescription || empty($prescription['file_path'])) {
            die('File not found.');
        }

        $file = __DIR__ . '/../' . $prescription['file_path'];

        if (!file_exists($file)) {
            die('File not found on server.');
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="prescription.pdf"');
        readfile($file);
        exit;
    }

    public function delete()
    {
        $prescriptionModel = new PrescriptionModel();

        $prescriptionModel->delete($_GET['id']);

        header("Location: index.php?page=prescriptions");
        exit;
    }
}