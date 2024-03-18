<h3> Giới thiệu</h3>
<?php

require_once '../Model/ModelUser.php'; // Đảm bảo đường dẫn đúng đến file ModelUser.php

$modelUser = new ModelUser();

$users = $modelUser->getAllUsers();

if ($users) {
    foreach ($users as $user) {
        echo "User ID: " . $user['userID'] . "<br>";
        echo "Username: " . $user['username'] . "<br>";
        echo "Role ID: " . $user['roleID'] . "<br>";
        echo "Name: " . $user['name'] . "<br>";
        echo "Email: " . $user['mail'] . "<br>";
        echo "Phone Number: " . $user['phoneNumber'] . "<br>";
        echo "Point: " . $user['point'] . "<br>";
        echo "Type: " . $user['type'] . "<br>";
        echo "Status: " . $user['status'] . "<br>";
        echo "<hr>";
    }
} else {
    echo "No users found.";
}

?>
<?php
require_once '../Model/ModelRole.php';

$modelRole = new ModelRole();
$roles = $modelRole->getAllRoles();

// Xử lý kết quả, ví dụ:
if ($roles !== false) {
    foreach ($roles as $role) {
        echo "Role ID: " . $role['roleID'] . ", Role Name: " . $role['roleName'] . "<br>";
    }
} else {
    echo "Không có vai trò nào trong cơ sở dữ liệu.";
}
?>