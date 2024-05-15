<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    /* Style for the modal form */
    #FormRole_edit {
        position: fixed;
        top: 50%;
        left: 50%;
        /* transform: translate(-50%, -40%);  */
        width: 100%;
        max-width: 100%;
        height: 95%;
    }
    #Role-background {
        display: flex;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(87, 84, 84, .4);
        z-index: 10005;
        align-items: center;
        justify-content: center;
    }
    .Role {
        background-color: #fff;
        border-radius: 10px;
        padding: 2.5rem; 
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 75%; 
        max-width: 50rem; 
        height: 75%;
    }
    .closeformrole {
        cursor: pointer;
        position: absolute;
        right: 4%;
        top: 4%;
        width: 48px;
        height: 48px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 35px;
        font-weight: 500;
    }
    .rowfunction{
        margin-bottom: 10px;
    }
    .long-label {
        min-width: 150px; /* Đặt kích thước tối thiểu cho nhãn */
        display: inline-block; /* Cho phép nhãn mở rộng theo nội dung */
        margin-right: 40px;
        margin-top: 2px;
    }
    .long-label1 {
        min-width: 150px; /* Đặt kích thước tối thiểu cho nhãn */
        display: inline-block; /* Cho phép nhãn mở rộng theo nội dung */
        margin-right: 15px;
        margin-top: 2px;
    }
    #FormRole_edit {
            display: none; /* Ẩn form ban đầu */
        }
    </style>
</head>
<body>
<div>
        <div class="col-md-4">
            <label style="margin-right: 10px;">Danh sách quyền</label>
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addModal" style="width: 100px; padding: 6px;">
                Thêm mới
            </button>
        </div>

        <div class="table-responsive" style="margin-top: 20px;">
            <table class="table table-striped" id="quanlyPQTable" style="text-align: center;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Mã vai trò</th>
                        <th scope="col" class="text-center">Tên vai trò</th>
                        <th scope="col" class="text-center">Số lượng người dùng</th>
                        <th scope="col" class="text-center">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once __DIR__ . '../../../../Model/ModelRole.php';
                    require_once __DIR__ . '../../../../Model/ModelUser.php';

                    $modelRole = new ModelRole();
                    $modelUser = new ModelUser();

                    $roles = $modelRole->getAllRoles();

                    if ($roles) {
                        foreach ($roles as $role) {
                            echo '<tr style="height: 50px;">';
                            echo "<td class=\"text-center\">" . $role['roleID'] . "</td>";
                            echo "<td class=\"text-center\">" . $role['roleName'] . "</td>";
                    
                            // Lấy số lượng người dùng cho từng nhóm quyền
                            $userCount = $modelUser->getUserCountByRoleID($role['roleID']);
                            echo "<td class=\"text-center\">" . $userCount . "</td>";
                    
                            echo '<td class="d-flex justify-content-evenly">';
                            echo '<i class="fas fa-wrench" style="font-size: 25px; color: orange; cursor: pointer" onclick="showEditFormRole(' . $role['roleID'] . ', \'' . $role['roleName'] . '\')"></i>';
                            echo '</td>';

                    
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>


    function showEditForm(roleID){
        var form = document.getElementById("FormRole_edit");
        form.style.display = "block";
       
    }

</script>


<div id="EditFormRole" style="display: none;">
    <form id="editRoleForm">
    <div class="Role">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center">
                <a class="closeformrole" onclick="closeEditFormRole()">
                <i class="fa-solid fa-xmark"></i></a>
                    <h3 class="mb-4">Nhóm quyền</h3>
                    <form id="Roleform" action="../../../../web_BadmintonStore/Controllers/roleController.php" method="post">
                        <div class="form-group">
                            <label for="roleID">Mã vai trò:</label>
                            <input type="text" class="form-control" name="roleIDtxt" id="roleID" readonly>
                        </div>
                        <div class="form-group">
                            <label for="roleName">Tên vai trò:</label>
                            <input type="text" class="form-control" name="roleNametxt" id="roleName">
                        </div>
                        <!-- Nút Lưu -->
                        <button id="saveRoleChangesBtn" type="submit" class="btn btn-primary mt-4">Lưu</button>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>   
        </div>
    </div>
</div>


<!-- Include jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Include additional JavaScript files -->
<script type="text/javascript" src="../js/jquery.validate.min.js" defer></script>
<script type="text/javascript" src="../../../../web_BadmintonStore/js/role.js" defer></script>

<script>
    function showEditFormRole(roleID, roleName) {
        // Đảm bảo dữ liệu được truyền đúng
        console.log("Role ID:", roleID);
        console.log("Role Name:", roleName);

        // Điền dữ liệu vào các trường của form
        document.getElementById('roleID').value = roleID;
        document.getElementById('roleName').value = roleName;

        // Hiển thị form chỉnh sửa
        document.getElementById('EditFormRole').style.display = 'block';
    }


    function closeEditFormRole() {
        var EditFormRole = document.getElementById("EditFormRole");
        EditFormRole.style.display = "none";
    }
    </script>

</body>
</html>
