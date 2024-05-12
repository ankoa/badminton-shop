<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm mã đơn hàng</title>
    <script> var username = "<?php echo $_SESSION['username']; ?>"; </script>
    <style>
      .combobox_right {
        background-color: #fff;
      }

      .order_container {
        background-color: white;
        padding-right: 15px;
      }

      .order-filter {
        background-color: #fff;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
        display: flex;
        margin-bottom: 12px;
        overflow: hidden;
      }

      .order-filter__item {
        align-items: center;
        background: #fff;
        border-bottom: 2px solid rgba(0, 0, 0, .09);
        color: rgba(0, 0, 0, .8);
        cursor: pointer;
        display: flex;
        flex: 1;
        font-size: 16px;
        justify-content: center;
        line-height: 19px;
        overflow: hidden;
        padding: 16px 0;
        text-align: center;
        transition: color .2s;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      .order-filter__item.active {
        border-color: var(--primary-color);
        color: var(--primary-color);
      }

      .order-filter__item:hover span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        border-bottom: 2px solid red;
      }
    </style>
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
            <input type="text" class="tra-cuu" name="tra-cuu" placeholder="Nhập vào đây"><br>
            <button class="btn-search" type="button">Tra cứu đơn hàng</button>
        </form>
        <div id="combobox_right"></div>
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
                <tbody id="showlist">
                    
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

    
  <!-- <script type="text/javascript" src="../js/Transaction.js"></script>
  <script type="text/javascript" src="../js/User.js"></script> -->
</body>
</html>
