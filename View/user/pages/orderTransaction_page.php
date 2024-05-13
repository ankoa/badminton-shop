<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm mã đơn hàng</title>
    <script> var username = "<?php echo $_SESSION['username']; ?>"; </script>
    <style>
      .combobox__right {
        background-color: #fff;
      }

      .order__container {
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

      .order-filter__item span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      .order-container1 { 
        max-width: 800px; 
        margin: 20px auto; 
        background: white; 
        border-radius: 8px; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
        padding: 20px; 
        background: linear-gradient(to right, #ff7e5f, #feb47b);
    }
    
    .header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 20px; 
    }

    .close-button { 
        background: none; 
        border: none; 
        font-size: 24px; 
        cursor: pointer; 
    } 

    .order-details {
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
    } 

    .product-info { 
        display: flex;
        align-items: center; 
    } 

    .product-info img { 
        margin-right: 15px; 
    } 

    .price-info { 
        font-size: 18px;
        font-weight: bold; 
    } 

    .total { 
        text-align: right; 
        margin-top: 20px; 
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
        <div id="combobox__right"></div>
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


<div class="order-container1">
    <div class="header">
        <h1>Đặt hàng thành công</h1>
        <button class="close-button">X</button>
    </div>
    <div id="order-detail-modal"></div>
</div>


</body>
</html>

<script>

</script>
