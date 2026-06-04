<?php

require_once __DIR__ . '/BaseModel.php';

class SpecializationModel extends BaseModel
{
    public function getAll()
    {
        $result = $this->execute("SELECT * FROM specializations ORDER BY id DESC");

        $specializations = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $specializations[] = $row;
            }
        }

        return $specializations;
    }

    public function findById($id)
    {
        $result = $this->execute(
            "SELECT * FROM specializations WHERE id = ? LIMIT 1",
            "i",
            [$id]
        );

        return $result && $result->num_rows > 0
            ? $result->fetch_assoc()
            : null;
    }

    public function create($data)
    {
        return $this->execute(
            "INSERT INTO specializations (name) VALUES (?)",
            "s",
            [$data['name']]
        );
    }

    public function update($data)
    {
        return $this->execute(
            "UPDATE specializations SET name = ? WHERE id = ?",
            "si",
            [
                $data['name'],
                $data['id']
            ]
        );
    }

    public function delete($id)
    {
        return $this->execute(
            "DELETE FROM specializations WHERE id = ?",
            "i",
            [$id]
        );
    }
}