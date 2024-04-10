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
<?php
require_once __DIR__ . '/../../../Model/ModelProduct.php';
require_once __DIR__ . '/../../../Model/ModelRacket.php';
// Tạo một đối tượng ModelRacket
$modelRacket = new ModelRacket();

// Lấy danh sách tất cả các vợt
$rackets = $modelRacket->getAllRackets();

// Kiểm tra nếu danh sách không rỗng
if ($rackets) {
    // Hiển thị tiêu đề của danh sách
    echo "<h2>Danh sách các vợt</h2>";

    // Bắt đầu bảng để hiển thị danh sách
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Product ID</th>";
    echo "<th>Color</th>";
    echo "<th>Price</th>";
    echo "<th>Discount</th>";
    echo "<th>Flex</th>";
    echo "<th>Tension Max</th>";
    echo "<th>Grip</th>";
    echo "<th>Frame Build</th>";
    echo "<th>Shaft Build</th>";
    echo "<th>Weight</th>";
    echo "<th>Status</th>";
    echo "<th>Quantity</th>";
    echo "<th>Swing Weight</th>";
    echo "<th>Balance Point</th>";
    echo "<th>Note</th>";
    echo "<th>List Image</th>";
    echo "</tr>";

    // Duyệt qua từng vợt và xuất thông tin của chúng
    foreach ($rackets as $racket) {
        echo "<tr>";
        echo "<td>" . $racket->getProductID() . "</td>";
        echo "<td>" . $racket->getColor() . "</td>";
        echo "<td>" . $racket->getPrice() . "</td>";
        echo "<td>" . $racket->getDiscount() . "</td>";
        echo "<td>" . $racket->getFlex() . "</td>";
        echo "<td>" . $racket->getTensionMax() . "</td>";
        echo "<td>" . $racket->getGrip() . "</td>";
        echo "<td>" . $racket->getFrameBuild() . "</td>";
        echo "<td>" . $racket->getShaftBuild() . "</td>";
        echo "<td>" . $racket->getWeight() . "</td>";
        echo "<td>" . $racket->getStatus() . "</td>";
        echo "<td>" . $racket->getQuantity() . "</td>";
        echo "<td>" . $racket->getSwingWeight() . "</td>";
        echo "<td>" . $racket->getBalancePoint() . "</td>";
        echo "<td>" . $racket->getNote() . "</td>";
        echo "<td>" . $racket->getListImage() . "</td>";
        echo "</tr>";
    }

    // Kết thúc bảng
    echo "</table>";
} else {
    // Hiển thị thông báo nếu không có vợt nào được tìm thấy
    echo "<p>Không có vợt nào được tìm thấy.</p>";
}
?>

