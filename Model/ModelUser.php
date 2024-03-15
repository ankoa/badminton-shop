<?php

require_once 'Database.php';

class ModelUser {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
    // Phương thức để lấy tất cả người dùng từ cơ sở dữ liệu
    public function getAllUsers() {
        $query = "SELECT * FROM user";
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
    // Phương thức để lấy thông tin người dùng bằng ID
    public function getUserByID($userID) {
        $query = "SELECT * FROM user WHERE userID = '$userID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin người dùng bằng username
    public function getUserByUsername($username) {
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để thêm một người dùng mới vào cơ sở dữ liệu
    public function addUser($username, $password, $roleID, $name, $mail, $phoneNumber, $point, $type, $status) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO user (username, password, roleID, name, mail, phoneNumber, point, type, status) 
                  VALUES ('$username', '$hashedPassword', '$roleID', '$name', '$mail', '$phoneNumber', '$point', '$type', '$status')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin người dùng trong cơ sở dữ liệu
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

    // Phương thức để xóa một người dùng khỏi cơ sở dữ liệu
    public function deleteUser($userID) {
        $query = "DELETE FROM user WHERE userID = '$userID'";
        return $this->db->delete($query);
    }

    // Phương thức để kiểm tra đăng nhập
    public function authenticate($username, $password) {
        $user = $this->getUserByUsername($username);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }
}

?>
