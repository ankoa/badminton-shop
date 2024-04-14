<style>
.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    padding-left: 10px;
    padding-right: 10px;
}

.bread-crumb{
    background: #f5f5f5;
    margin-bottom: 20px;
}

ul.breadcrumb{
    margin: 0;
    font-size: 14px;
    padding: 15px 0px;
    border-radius: 0;
    font-weight: 400;
    line-height: 24px;
    background-color: transparent;
    width: 100%;
    text-align: left;
}

.breadcrumb li.home {
    float: left;
}

.svg-inline{
    width: 15px;
    height: 15px;
    margin-top: -5px;
    padding-top: 5px;
    margin-right: 2px;
}

.breadcrumb li .mr_lr {
    padding: 0px 3px;
    color: #333;
}

.breadcrumb li span {
    display: inline;
}

.container {
    padding-left: 10px;
    padding-right: 10px;
    width: 100%;
    max-width: 100%;
    margin-right: auto;
    margin-left: auto;
}

.main-cart-page{
    
}

.background-aside{
    margin-bottom: 40px !important;
    width: 100%;
}

.title_cart {
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold;
    background: #f7f8f9;
    border-radius: 5px;
    padding: 10px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.08);
    margin-bottom: 0px;
}

/* .d-none {
    display: none;
} */

.cartheader {
    margin-bottom: 0;
}

.title-cart-head {
    width: 100% !important;
    height: auto !important;
    text-align: center;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 14px;
    border-bottom: 1px solid #ddd;
    padding: 0 0 5px;
    margin-bottom: 0px;
    display: flex;
    align-items: center;
    color: #fff;
    background: #e95221;
    padding: 7px 10px;
    cursor: pointer;
}

.cart-body {
    padding: 10px;
    max-height: 360px;
    overflow-y: auto;
}

.cartheader .cart-body .ajaxcart-row {
    position: relative;
    padding: 10px 0;
}

.cart-page .cart-body .ajaxcart-row .cart-product {
    width: 100%;
    height: 120px;
    display: flex;
    align-items: center;
}

.cartheader .cart-body .cart-product {
    margin-bottom: 10px;
    padding-bottom: 10px;
    display: table;
    width: 100%;
    border-bottom: solid 1px #ebebeb;
}

.cartheader .cart-body .cart-image {
    display: table-cell;
    width: 20%;
    vertical-align: top;
    position: relative;
}

img {
    border: 0 none;
    max-width: 100%;
    height: auto;
}

.cartheader .cart-body .cart-info {
    padding-left: 15px;
    vertical-align: top;
}

.cartheader .cart-body .cart-info .cart-name {
    margin-bottom: 5px;
}

.cartheader .cart-body .cart-info .cart-name a {
    margin-bottom: 4px;
    font-size: 13px;
    font-weight: 500;
    line-height: 1.3;
    display: block;
    padding-right: 25px;
}

.cartheader .cart-body .cart-info .variant-title {
    display: block;
    font-size: 12px;
    color: #9e9e9e;
}

.cart-page .cart-body .cart-info .cart-name .remove-item-cart {
    display: block;
    color: #e95221;
    font-weight: 300;
}

.cartheader .cart_body .grid {
    display: flex;
}

.cartheader .cart-body .grid .cart-item-name {
    width: 50%;
}

.input-group-btn {
    position: relative;
    white-space: nowrap;
    width: 1%;
    padding: 0;
}

.cartheader .cart-body .cart-select button.ajaxcart-qty--minus {
    border-radius: 15px 0 0 15px;
}

.cartheader .cart_body .cart-select input {
    display: inline-block;
    padding: 0;
    text-align: center;
    border-radius: 0;
    width: 35px;
    min-height: 28px;
    border: 1px solid #e5e5e5;
    color: #222;
    height: 28px;
    font-size: 14px;
    margin: 0;
    border-left: none;
    border-right: none;
}

.cartheader .cart-body .cart-select button.ajaxcart-qty--plus {
    border-radius: 0 15px 15px 0;
}

.cartheader .cart-body .grid .cart-prices {
    width: 50%;
    text-align: right;
}

.cartheader .cart-body .grid .cart-prices .cart-price {
    font-weight: 500;
    display: block;
    font-size: 14px;
    color: #e95221;
    line-height: 28px;
}
/* Đặt hàng */
.cartheader .ajaxcart-footer {
    padding: 5px 10px 10px;
    border-top: solid 1px #ebebeb;
}

.cartheader .ajaxcart-footer .cart-subtotal {
    font-size: 15px;
    font-weight: 500;
    margin-bottom: 12px;
    display: flex;
}

.cartheader .ajaxcart-footer .cart-subtotal .cart-col-6 {
    width: 50%;
    float: left;
}

.cartheader .ajaxcart-footer .cart-subtotal .cart-totle {
    width: 50%;
    float: left;
    text-align: right;
}

.cartheader .ajaxcart-footer .cart-subtotal .cart-totle .total-price {
    font-weight: bold;
    color: #ef1104;
}

.cartheader .ajaxcart-footer .cart-btn-proceed-checkout-dt {
    display: block;
    position: relative;
}

.cartheader .ajaxcart-footer .cart-btn-proceed-checkout-dt button {
    width: 100%;
    background: #e95221;
    color: #fff;
    padding: 0px 10px;
    border-radius: 4px;
    font-size: 12px;
    transition: .3s;
    -webkit-transition: .3s;
    text-transform: uppercase;
    border: 1px solid #e95221;
    height: 40px;
    line-height: 40px;
}
</style>

<div class="bodywrap">
    <section class="bread-crumb">
        <div class="container">
            <ul class="breadcrumb">
                <li class="home">
                    <a href="#" title="Trang chủ" itemprop="item" >
                        <span itemprop="name">Trang chủ</span>
                    </a>
                    <meta itemprop="position" content="0"/>
                    <span class="icon">
                        &nbsp;
                        <img class="svg-inline" src="../View/images/arrow.png" data-src="../View/images/arrow.png">
                        &nbsp;
                    </span>
                </li>
                <li>
                    <strong itemprop="name">Giỏ hàng</strong>
                    <meta itemprop="position" content="1"/>
                </li>
            </ul>
        </div>
    </section>
    <section class="main-cart-page">
        <div class="container">
            <div class="background-aside">
                <div class="title-block-page">
                    <h1 class="title_cart">
                        <span>Giỏ hàng của bạn</span>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                        <!-- <div class="clearfix">
                            
                        </div> -->
                        <div class="cart-page d-xl-block d-none">
                            <div class="drawer__inner">
                                <div class="CartPageContainer">

                                    <form action class="cartheader">
                                        <div class="title-cart-head">Giỏ hàng</div>
                                            <div class="cart-body">
                                                <div class="ajaxcart-row">
                                                    <div class="cart-product">
                                                        <a href="#" class="cart-image" title="Giày cầu lông Yonex SHB CFT2EX - 
                                                        Hồng (Nội địa Trung)"><img width="80" height="80" src="../View/images/product/GiayNam.png" 
                                                        alt="Giày cầu lông Yonex SHB CFT2EX - Hồng (Nội địa Trung)"></a>
                                                        <div class="cart-info">
                                                            <div class="cart-name">
                                                                <a href="#" class="" title="Giày cầu lông Yonex SHB CFT2EX
                                                                - Hồng (Nội địa Trung)">Giày cầu lông Yonex SHB CFT2EX - Hồng (Nội địa Trung)</a>
                                                                <span class="variant-title">Size: 40</span>
                                                                <a title="Xóa" class="remove-item-cart" href="javascript:;"></a>
                                                            </div>
                                                            <div class="grid">
                                                                <div class="cart-item-name">
                                                                    <div class="input-group-btn">
                                                                        <button type="button" class="ajaxcart-qty--minus items-count" 
                                                                        data-id="" data-qty="0" aria-label="-"> - </button>
                                                                        <input type="text" name="updates[]" class="ajaxcart__qty-num number-sidebar" maxlength="3" value="1" min="0" data-id="" aria-label="quantity" pattern="[0-9]*">
                                                                        <button type="button" class="ajaxcart-qty--plus items-count" 
                                                                        data-id="" data-qty="2" aria-label="+"> + </button>
                                                                    </div>
                                                            </div>
                                                            <div class="cart-prices">
                                                                <span class="cart-price">1.590.000 ₫</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ajaxcart-footer">
                                            <div class="ajaxcart-subtotal">
                                                <div class="cart-subtotal">
                                                    <div class="cart-col-6">Tổng tiền:</div>
                                                    <div class="text-right cart-totle"><span class="total-price">3.390.000 ₫</span></div>
                                                </div>
                                            </div>
                                            <div class="cart-btn-proceed-checkout-dt ">
                                                <button onclick="location.href='/gio-hang/thanh-toan'" type="button" class="button btn btn-default cart-btn-proceed-checkout" id="btn-proceed-checkout" title="Thanh toán">Đặt hàng</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="cart-mobile-page d-block d-xl-none">
                            <div class="CartMobileContainer" style="padding-top:20px ;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>