<?php
require_once 'database.php';
require_once '..\Model\Entity\User.php';
class ModelUser {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function getAllUsers() {
        $query = "SELECT * FROM user WHERE status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            return false;
        }
    }
    
    public function getUserByID($userID) {
        $query = "SELECT * FROM user WHERE userID = '$userID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    

    

    public function addUser($username, $password, $roleID, $name, $mail, $phoneNumber, $point, $type, $status) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO user (username, password, roleID, name, mail, phoneNumber, point, type, status) 
                  VALUES ('$username', '$hashedPassword', '$roleID', '$name', '$mail', '$phoneNumber', '$point', '$type', '$status')";
        return $this->db->insert($query);
    }

    public function updateUser($userID, $username, $password, $roleID, $name, $mail, $phoneNumber, $point, $type, $status) {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE user 
                      SET username = '$username', 
                          password = '$hashedPassword', 
                          roleID = '$roleID', 
                          name = '$name', 
                          mail = '$mail', 
                          phoneNumber = '$phoneNumber', 
                          point = '$point', 
                          type = '$type', 
                          status = '$status' 
                      WHERE userID = '$userID'";
        } else {
            $query = "UPDATE user 
                      SET username = '$username', 
                          roleID = '$roleID', 
                          name = '$name', 
                          mail = '$mail', 
                          phoneNumber = '$phoneNumber', 
                          point = '$point', 
                          type = '$type', 
                          status = '$status' 
                      WHERE userID = '$userID'";
        }
        return $this->db->update($query);
    }

    public function deleteUser($userID) {
        $query = "UPDATE FROM user SET status=0 WHERE userID = '$userID'";
        return $this->db->delete($query);
    }

    public function authenticate($username, $password) {
        $user = $this->getUserByUsername($username);
        if ($user instanceof User) {
            if ($password ==$user->getPassword()) {
                return true;
            }
        }
        return false;
    }
    public function getUserByUsername($username) {
        $query = "SELECT * FROM user WHERE username = '$username' AND status != 0";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new User(
                $row['userID'],
                $row['username'],
                $row['password'],
                $row['timeCreated'],
                $row['roleID'],
                $row['name'],
                $row['mail'],
                $row['phoneNumber'],
                $row['point'],
                $row['type'],
                $row['status']
            );
        } else {
            return null;
        }
    }
    

}

?>
