<?php
require_once 'database.php';
require_once '..\Model\Entity\User.php';
class ModelUser {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function getAllUsers() {
        $query = "SELECT * FROM user ";
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
    public function getUIDByUserName($username) {
        $query = "SELECT userID FROM user WHERE username = '$username' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['userID']; 
        } else {
            return false;
        }
    }
    public function getRoleUsetByID($userID) {
        $query = "SELECT roleID FROM user WHERE userID = '$userID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['roleID']; 
        } else {
            return false;
        }
    }
    

    

    public function addUser($username, $password, $roleID, $name, $mail, $phoneNumber, $point, $type, $status) {
        $query = "INSERT INTO user (username, password, roleID, name, mail, phoneNumber, point, type, status) 
                  VALUES ('$username', '$password', '$roleID', '$name', '$mail', '$phoneNumber', '$point', '$type', '$status')";
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
    public function checkExistingUsername($username) {
        $query = "SELECT COUNT(*) AS count FROM user WHERE username = '$username'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    
    public function checkExistingEmail($email) {
        $query = "SELECT COUNT(*) AS count FROM user WHERE mail = '$email'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    
    public function checkExistingPhoneNumber($phoneNumber) {
        $query = "SELECT COUNT(*) AS count FROM user WHERE phoneNumber = '$phoneNumber'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    public function checkPhoneNumberFormat($phoneNumber) {
        if(preg_match('/^0\d{9}$/', $phoneNumber) && is_numeric($phoneNumber) && strlen($phoneNumber) == 10) {
            return true;
        } else {
            return false;
        }
    }
    public function changeUserStatus($userID, $newStatus) {
        // Update the status of the user in the database
        $query = "UPDATE user SET status = '$newStatus' WHERE userID = '$userID'";
        return $this->db->update($query);
    }
}

?>
