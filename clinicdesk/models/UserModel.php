<?php

require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel
{
    public function findByEmail($email)
    {
        $result = $this->execute(
            "SELECT * FROM users WHERE email = ? LIMIT 1",
            "s",
            [$email]
        );

        return $result && $result->num_rows > 0
            ? $result->fetch_assoc()
            : null;
    }

    public function findById($id)
    {
        $result = $this->execute(
            "SELECT * FROM users WHERE id = ? LIMIT 1",
            "i",
            [$id]
        );

        return $result && $result->num_rows > 0
            ? $result->fetch_assoc()
            : null;
    }

    public function getAll()
    {
        $result = $this->execute("SELECT * FROM users ORDER BY id DESC");

        $users = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }

    public function getPaginated($limit, $offset)
    {
        $result = $this->execute(
            "SELECT * FROM users ORDER BY id DESC LIMIT ? OFFSET ?",
            "ii",
            [$limit, $offset]
        );

        $users = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }

    public function countAll()
    {
        $result = $this->execute("SELECT COUNT(*) AS total FROM users");

        if ($result && $row = $result->fetch_assoc()) {
            return $row['total'];
        }

        return 0;
    }

    public function create($data)
    {
        $sql = "INSERT INTO users
                (name, email, password, role, phone)
                VALUES (?, ?, ?, ?, ?)";

        return $this->execute(
            $sql,
            "sssss",
            [
                $data['name'],
                $data['email'],
                $data['password'],
                $data['role'],
                $data['phone']
            ]
        );
    }

    public function update($data)
    {
        return $this->execute(
            "UPDATE users
             SET name=?, email=?, role=?, phone=?
             WHERE id=?",
            "ssssi",
            [
                $data['name'],
                $data['email'],
                $data['role'],
                $data['phone'],
                $data['id']
            ]
        );
    }

    public function delete($id)
    {
        return $this->execute(
            "DELETE FROM users WHERE id = ?",
            "i",
            [$id]
        );
    }
}