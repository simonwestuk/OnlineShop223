<?php

class MemberController
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function register(array $member) : bool
    {
        try {

            $member['password'] = password_hash($member['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(firstname, lastname, password, email)
                    VALUES (:firstname, :lastname, :password, :email);";
    
            $this->db->runSQL($sql, $member);

            return true;

        } catch (PDOException $e) {

            if ((int)$e->getCode() === 23000) { //Check for duplicates
                return false;
            }
            throw $e;
        }
       
    }

    public function get(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function getAll() : array
    {
        $sql = "SELECT * FROM users";
        return $this->db->runSQL($sql) -> fetchAll();
    }

    public function getByEmail(string $email) 
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $args = ['email' => $email];
        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function update(array $member) : bool
    {
        $sql = "UPDATE users 
                SET firstname = :firstname, 
                    lastname = :lastname, 
                    password = :password, 
                    email = :email
                WHERE id = :id;";
        
        return $this->db->runSQL($sql, $member)->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        return $this->db->runSQL($sql, ['id' => $id])->execute();
    }

    public function login(string $email, string $password)
    {
        $sql = "SELECT firstname, lastname, email, password
        FROM users
        WHERE email = :email;";

        $member = $this->db->runSQL($sql, ['email' => $email]) -> fetch();
        
        if (!$member) {
            return false;
        }

        $auth = password_verify($password, $member['password']);

        return $auth ? $member : false;
    }

}

?>