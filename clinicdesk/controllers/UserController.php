<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../core/CSRF.php';
require_once __DIR__ . '/../core/Paginator.php';

class UserController
{
    public function index()
    {
        $userModel = new UserModel();

        $currentPage = $_GET['p'] ?? 1;
        $perPage = 5;

        $totalUsers = $userModel->countAll();

        $paginator = new Paginator($totalUsers, $perPage, $currentPage);

        $users = $userModel->getPaginated(
            $perPage,
            $paginator->offset()
        );

        require_once __DIR__ . '/../views/users/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/users/create.php';
    }

    public function store()
    {
        if (
            !isset($_POST['csrf_token']) ||
            !CSRF::validateToken($_POST['csrf_token'])
        ) {
            die('Invalid CSRF Token');
        }

        $userModel = new UserModel();

        $userModel->create([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'role' => $_POST['role'],
            'phone' => $_POST['phone']
        ]);

        header("Location: index.php?page=users");
        exit;
    }

    public function edit()
    {
        $userModel = new UserModel();

        $user = $userModel->findById($_GET['id']);

        require_once __DIR__ . '/../views/users/edit.php';
    }

    public function update()
    {
        if (
            !isset($_POST['csrf_token']) ||
            !CSRF::validateToken($_POST['csrf_token'])
        ) {
            die('Invalid CSRF Token');
        }

        $userModel = new UserModel();

        $userModel->update([
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'role' => $_POST['role'],
            'phone' => $_POST['phone']
        ]);

        header("Location: index.php?page=users");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;

        $userModel = new UserModel();

        $userModel->delete($id);

        header("Location: index.php?page=users");
        exit;
    }
}