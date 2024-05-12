<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Management</title>
  <link rel="stylesheet" href="../../bootstrap-5.3.2-dist//css/bootstrap.min.css">
</head>
<body>
  <div id="roleform">
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
        <!-- Form để chứa các thành phần quản lý tài khoản -->
        <form id="managementForm">
          <div class="form-row align-items-center">
            <div class="col-md-3">
              <!-- Nhãn quản lý sản phẩm -->
              <label class="form-check-label" for="productManagement">Sản phẩm:</label>
            </div>
            <div class="col-md-9">
              <!-- Các nút switch quản lý sản phẩm -->
              <div class="row">
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="addProductSwitch">
                    <label class="form-check-label" for="addProductSwitch">Thêm</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="editProductSwitch">
                    <label class="form-check-label" for="editProductSwitch">Sửa</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="deleteProductSwitch">
                    <label class="form-check-label" for="deleteProductSwitch">Xóa</label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Các thành phần quản lý loại sản phẩm -->
          <div class="form-row align-items-center mt-3">
            <div class="col-md-3">
              <label class="form-check-label" for="categoryManagement">Loại sản phẩm:</label>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="addCategorySwitch">
                    <label class="form-check-label" for="addCategorySwitch">Thêm</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="editCategorySwitch">
                    <label class="form-check-label" for="editCategorySwitch">Sửa</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="deleteCategorySwitch">
                    <label class="form-check-label" for="deleteCategorySwitch">Xóa</label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Các thành phần quản lý hóa đơn -->
          <div class="form-row align-items-center mt-3">
            <div class="col-md-3">
              <label class="form-check-label" for="invoiceManagement">Hóa đơn:</label>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="addInvoiceSwitch">
                    <label class="form-check-label" for="addInvoiceSwitch">Thêm</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="editInvoiceSwitch">
                    <label class="form-check-label" for="editInvoiceSwitch">Sửa</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="deleteInvoiceSwitch">
                    <label class="form-check-label" for="deleteInvoiceSwitch">Xóa</label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Các thành phần quản lý doanh thu -->
          <div class="form-row align-items-center mt-3">
            <div class="col-md-3">
              <label class="form-check-label" for="revenueManagement">Doanh thu:</label>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="viewRevenueSwitch">
                    <label class="form-check-label" for="viewRevenueSwitch">Xem</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="exportRevenueSwitch">
                    <label class="form-check-label" for="exportRevenueSwitch">Xuất</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="analyzeRevenueSwitch">
                    <label class="form-check-label" for="analyzeRevenueSwitch">Phân tích</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
        <!-- Kết thúc form -->
      </div>
    </div>
  </div>
  </div>
  <!-- Link JavaScript của Bootstrap 5 và jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
