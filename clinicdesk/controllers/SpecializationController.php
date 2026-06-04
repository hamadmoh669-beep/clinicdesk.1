<?php

require_once __DIR__ . '/../models/SpecializationModel.php';
require_once __DIR__ . '/../core/CSRF.php';

class SpecializationController
{
    public function index()
    {
        $specializationModel = new SpecializationModel();

        $specializations = $specializationModel->getAll();

        require_once __DIR__ . '/../views/specializations/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/specializations/create.php';
    }

    public function store()
    {
        if (
            !isset($_POST['csrf_token']) ||
            !CSRF::validateToken($_POST['csrf_token'])
        ) {
            die('Invalid CSRF Token');
        }

        $specializationModel = new SpecializationModel();

        $specializationModel->create([
            'name' => $_POST['name']
        ]);

        header("Location: index.php?page=specializations");
        exit;
    }

    public function edit()
    {
        $specializationModel = new SpecializationModel();

        $specialization = $specializationModel->findById($_GET['id']);

        require_once __DIR__ . '/../views/specializations/edit.php';
    }

    public function update()
    {
        if (
            !isset($_POST['csrf_token']) ||
            !CSRF::validateToken($_POST['csrf_token'])
        ) {
            die('Invalid CSRF Token');
        }

        $specializationModel = new SpecializationModel();

        $specializationModel->update([
            'id' => $_POST['id'],
            'name' => $_POST['name']
        ]);

        header("Location: index.php?page=specializations");
        exit;
    }

    public function delete()
    {
        $specializationModel = new SpecializationModel();

        $specializationModel->delete($_GET['id']);

        header("Location: index.php?page=specializations");
        exit;
    }
}