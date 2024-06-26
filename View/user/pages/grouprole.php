<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    /* Style for the modal form */
    #editRoleGroupForm {
        position: fixed;
        top: 50%;
        left: 50%;
        /* transform: translate(-50%, -40%);  */
        width: 100%;
        max-width: 100%;
        height: 95%;
    }
    #RoleGroup-background {
        display: flex;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(87, 84, 84, .4);
        z-index: 100055555;
        align-items: center;
        justify-content: center;
    }
    .RoleGroup {
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
    </style>
</head>
<body>
<div>
        <div class="col-md-4">
            <label style="margin-right: 10px;">Danh sách nhóm quyền</label>
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addModal" style="width: 100px; padding: 6px;">
                Thêm mới
            </button>
        </div>

        <div class="table-responsive" style="margin-top: 20px;">
            <table class="table table-striped" id="quanlyPQTable" style="text-align: center;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Mã nhóm quyền</th>
                        <th scope="col" class="text-center">Tên nhóm quyền</th>
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
                            echo '<i class="fas fa-wrench" style="font-size: 25px; color: orange;" onclick="showEditForm(' . $role['roleID'] . ')"></i>';
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
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function clearAllSwitches() {
    var switches = document.querySelectorAll('.form-check-input');
    switches.forEach(function(switchElement) {
        switchElement.checked = false;
    });
}


    function showEditForm(roleID){
        var form = document.getElementById("editRoleGroupForm");
        form.style.display = "block";
        $.ajax({
            url: '../Controllers/process_edit_form.php',
            type: 'GET',
            data: $(this).serializeArray(),
            success: function(response) {
                clearAllSwitches();
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    var item = data[i];
                    if (item.roleID.trim()+"" == roleID+"" && item.functionID.trim()+"" == 1) {
                        
                        console.log("Matching roleID and functionID found.");
                        console.log(item.permissionName);
                        switch (item.permissionName) {
                            case "show":
                                console.log("Setting showAccountSwitch to default checked.");
                                setDefaultCheckedStatus("showAccountSwitch");
                                break;
                            case "add":
                                console.log("Setting addAccountSwitch to default checked.");
                                setDefaultCheckedStatus("addAccountSwitch");
                                break;
                            case "update":
                                console.log("Setting updateAccountSwitch to default checked.");
                                setDefaultCheckedStatus("updateAccountSwitch");
                                break;
                            case "delete":
                                console.log("Setting deleteAccountSwitch to default checked.");
                                setDefaultCheckedStatus("deleteAccountSwitch");
                                break;
                            default:
                                console.log("No matching permission found.");
                                break;
                        }
                    }
                    if (item.roleID.trim()+"" == roleID+"" && item.functionID.trim()+"" == 2) {
                        console.log("Matching roleID and functionID found.");
                        console.log(item.permissionName);
                        switch (item.permissionName) {
                            case "show":
                                setDefaultCheckedStatus("showProductSwitch");
                                break;
                            case "add":
                                setDefaultCheckedStatus("addProductSwitch");
                                break;
                            case "update":
                                setDefaultCheckedStatus("updateProductSwitch");
                                break;
                            case "delete":
                                setDefaultCheckedStatus("deleteProductSwitch");
                                break;
                            default:
                                console.log("No matching permission found.");
                                break;
                        }
                    }
                    if (item.roleID.trim()+"" == roleID+"" && item.functionID.trim()+"" == 3) {
                        console.log("Matching roleID and functionID found.");
                        console.log(item.permissionName);
                        switch (item.permissionName) {
                            case "show":
                                console.log("Setting showAccountSwitch to default checked.");
                                setDefaultCheckedStatus("showInvoiceSwitch");
                                break;
                            case "add":
                                console.log("Setting addInvoiceSwitch to default checked.");
                                setDefaultCheckedStatus("addInvoiceSwitch");
                                break;
                            case "update":
                                console.log("Setting updateInvoiceSwitch to default checked.");
                                setDefaultCheckedStatus("updateInvoiceSwitch");
                                break;
                            case "delete":
                                console.log("Setting deleteInvoiceSwitch to default checked.");
                                setDefaultCheckedStatus("deleteInvoiceSwitch");
                                break;
                            default:
                                console.log("No matching permission found.");
                                break;
                        }
                    } else {
                        console.log("No matching roleID and functionID.");
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(error); // Xử lý lỗi nếu có
            }
        });
    }
    function setDefaultCheckedStatus(checkboxId) {
        var checkbox = document.getElementById(checkboxId);
        if (checkbox) {
            checkbox.checked = true; // Đặt trạng thái checked cho checkbox
        }
    }
</script>

<script>
    function closeEditRoleGroupForm() {
        var editRoleGroupForm = document.getElementById("editRoleGroupForm");
        editRoleGroupForm.style.display = "none";
    }
</script>

<div id="editRoleGroupForm" style="display: none;">
    <div id="RoleGroup-background">
    <div class="RoleGroup">
    <a class="closeformrole" onclick="closeEditRoleGroupForm()">
          <i class="fa-solid fa-xmark"></i></a>
  <div class="container mt-5">
  <div class="row">
      <div class="col-md-3"></div> <!-- Thêm cột trống ở bên trái -->
      <div class="col-md-6 text-center"> <!-- Cột chứa nhãn "Nhóm quyền" -->
        <h3 class="mb-4">Nhóm quyền</h3>
      </div>
      <div class="col-md-3"></div> <!-- Thêm cột trống ở bên phải -->
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- Form để chứa các thành phần quản lý -->
        <form id="managementForm">
    <div class="form-row align-items-center">
        <!-- Quản lý Quyền -->
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="RoleManagement">Quyền:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="showRoleSwitch">
                <label class="form-check-label" for="showRoleSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addRoleSwitch">
                <label class="form-check-label" for="addRoleSwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateRoleSwitch">
                <label class="form-check-label" for="updateRoleSwitch">Sửa</label>
            </div>
        </div>
            <div class="col-md-2">
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="deleteRoleSwitch">
                    <label class="form-check-label" for="deleteRoleSwitch">Xóa</label>
                </div>
            </div>
    </div>

    <!-- Quản lý Tài khoản -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="AccountManagement">Tài khoản:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="showAccountSwitch">
                <label class="form-check-label" for="showAccountSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addAccountSwitch">
                <label class="form-check-label" for="addAccountSwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateAccountSwitch">
                <label class="form-check-label" for="updateAccountSwitch">Sửa</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="deleteAccountSwitch">
                <label class="form-check-label" for="deleteAccountSwitch">Xóa</label>
            </div>
        </div>
    </div>

    <!-- Các thành phần quản lý sản phẩm -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="productManagement">Sản phẩm:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3" >
                <input class="form-check-input" type="checkbox" id="showProductSwitch">
                <label class="form-check-label" for="showProductSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addProductSwitch">
                <label class="form-check-label" for="addProductSwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateProductSwitch">
                <label class="form-check-label" for="updateProductSwitch">Sửa</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="deleteProductSwitch">
                <label class="form-check-label" for="deleteProductSwitch">Xóa</label>
            </div>
        </div>
    </div>

    <!-- Các thành phần quản lý loại sản phẩm -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3.1">
            <label class="form-check-label text-left long-label1" for="categoryManagement">Loại sản phẩm:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="showCategorySwitch">
                <label class="form-check-label" for="showCategorySwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addCategorySwitch">
                <label class="form-check-label" for="addCategorySwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateCategorySwitch">
                <label class="form-check-label" for="updateCategorySwitch">Sửa</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="deleteCategorySwitch">
                <label class="form-check-label" for="deleteCategorySwitch">Xóa</label>
            </div>
        </div>
    </div>

    <!-- Các thành phần quản lý hóa đơn -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="invoiceManagement">Hóa đơn:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="showInvoiceSwitch">
                <label class="form-check-label" for="showInvoiceSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addInvoiceSwitch">
                <label class="form-check-label" for="addInvoiceSwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateInvoiceSwitch">
                <label class="form-check-label" for="updateInvoiceSwitch">Sửa</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="deleteInvoiceSwitch">
                <label class="form-check-label" for="deleteInvoiceSwitch">Xóa</label>
            </div>
        </div>
    </div>

    <!-- Các thành phần quản lý doanh thu -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="revenueManagement">Doanh thu:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="viewRevenueSwitch">
                <label class="form-check-label" for="viewRevenueSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="exportRevenueSwitch">
                <label class="form-check-label" for="exportRevenueSwitch">Xuất</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="analyzeRevenueSwitch">
                <label class="form-check-label" for="analyzeRevenueSwitch">Phân tích</label>
            </div>
        </div>
        <div class="col-md-2"></div> <!-- Ô trống -->
    </div>

    <!-- Nút Lưu -->
    <button type="submit" class="btn btn-primary mt-4">Lưu</button>
</form>


        <!-- Kết thúc form -->
      </div>
    </div>
    </div>
  </div>
  </div>
  </div>
</body>
</html>
