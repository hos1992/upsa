<?php

class User extends Model
{

    protected $table = 'users_accounts';

    public function get_all()
    {
        $query = $this->pdo->query("SELECT * FROM $this->table ORDER BY id DESC");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_one($id)
    {
        $query = $this->pdo->query("SELECT * FROM $this->table WHERE id = $id LIMIT 1");
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function check_email($email, $id = 0)
    {
        if ($id == 0) {
            $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE email = ? LIMIT 1");
            $query->execute([$email]);
        } else {
            $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE email = ? AND id <> ? LIMIT 1");
            $query->execute([$email, $id]);
        }

        if ($query->fetch(PDO::FETCH_OBJ)) {
            return true;
        } else {
            return false;
        }

    }

    public function insert($data)
    {
        $sql = "INSERT INTO $this->table (name, email, password, card_number, created_at, updated_at) VALUES (?,?,?,?, NOW(), NOW())";
        $query = $this->pdo->prepare($sql);
        $query->execute([$data['name'], $data['email'], $data['password'], $data['card_number']]);
    }

    public function update($data, $id)
    {
        $sql = "UPDATE $this->table SET name=?, email=?, password=?, card_number=?, updated_at=Now() WHERE id = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$data['name'], $data['email'], $data['password'], $data['card_number'], $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
    }


}