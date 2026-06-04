<?php

require_once __DIR__ . '/../models/DoctorModel.php';

class DoctorController
{
    public function index()
    {
        $doctorModel = new DoctorModel();
        $doctors = $doctorModel->getAll();

        require_once __DIR__ . '/../views/doctors/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/doctors/create.php';
    }

    public function store()
    {
        $doctorModel = new DoctorModel();

        $doctorModel->create([
            'user_id' => $_POST['user_id'],
            'specialization_id' => $_POST['specialization_id'],
            'bio' => $_POST['bio'],
            'consultation_fee' => $_POST['consultation_fee'],
            'available_days' => $_POST['available_days']
        ]);

        header("Location: index.php?page=doctors");
        exit;
    }

    public function edit()
    {
        $doctorModel = new DoctorModel();

        $doctor = $doctorModel->findById($_GET['id']);

        require_once __DIR__ . '/../views/doctors/edit.php';
    }

    public function update()
    {
        $doctorModel = new DoctorModel();

        $doctorModel->update([
            'id' => $_POST['id'],
            'specialization_id' => $_POST['specialization_id'],
            'bio' => $_POST['bio'],
            'consultation_fee' => $_POST['consultation_fee'],
            'available_days' => $_POST['available_days']
        ]);

        header("Location: index.php?page=doctors");
        exit;
    }

    public function delete()
    {
        $doctorModel = new DoctorModel();

        $doctorModel->delete($_GET['id']);

        header("Location: index.php?page=doctors");
        exit;
    }
}