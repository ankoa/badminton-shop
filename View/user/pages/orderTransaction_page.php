<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm mã đơn hàng</title>
    <link rel="stylesheet" href="../View/css/checktransaction.css">

</head>
<body>
<section class="layout-info-find">
    <div class="container">
        <main>
        <div class="col-xs-12">
            <h1>Kiểm tra trạng thái đơn hàng</h1>
            <a class="logout" href="">
                <span class="fa fa-sign-out"></span>
                "Thoát"
            </a>
        </div>
            <form>
                <label class="custom1" for="tra-cuu">Mã đơn hàng/Số điện thoại*</label><br>
                <input type="text" id="tra-cuu" name="tra-cuu" placeholder="Nhập vào đây"><br>
                <button class="btn-search" type="button">Tra cứu đơn hàng</button>
            </form>
            <div class="col-md-8 col-xs-12">
              <div class="userbox">
                  <table class="table table-striped table-hover">
                    <thead>
                        <tr style="background-color: orange;">
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái thanh toán</th>
                        <th>Trạng thái vận chuyển</th>
                        <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody id="show-listHoaDon">

                    </tbody>
                </table>

              </div>

                <div class="clearfix">
                  <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                      <li class="page-item disabled">
                        <a href="#">Previous</a>
                      </li>
                      <li class="page-item active">
                        <a href="#" class="page-link">1</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">2</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">3</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">4</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">5</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">Next</a>
                      </li>
                    </ul>
                  </div>
                </div>
        </main>
    </div>
</section>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>
