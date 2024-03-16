<h3> Giới thiệu</h3>
<?php

require_once '../Model/ModelUser.php'; // Đảm bảo đường dẫn đúng đến file ModelUser.php

$modelUser = new ModelUser();

$users = $modelUser->getAllUsers();
print($users);

?>
