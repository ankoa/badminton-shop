window.onload = function() {
     renderCustomerOrderDetail();
    const urlParams = new URLSearchParams(window.location.search);
    if (window.location.pathname === '/badminton-shop/Controllers/index.php' && urlParams.get('control') === 'checkDonHang') {
        AllCustomerOrder();
        filterEndUserOrderStatus();
        handleCustomerOrder();
        handleAllCustomerOrder();
        //renderCustomerOrderDetail();
        loadMiniForm();
    }
    
};

function getOrder(id) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/TransactionController.php',
            method: 'POST',
            data: { action: 'get', id },
            dataType: 'JSON',
            success: order => resolve(order),
            error: (xhr, status, error) => reject(error)
        })
    })
}

function getAllCustomerOrder(ma_kh) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/TransactionController.php',
            method: 'GET',
            data: { action: 'get-all-customer-order', ma_kh },
            dataType: 'JSON',
            success: orders => resolve(orders),
            error: (xhr, status, error) => reject(error)
        })
    })
}

async function AllCustomerOrder() {
    const user = username;
    const customerId = await getUserID(user);
    const search = $('.order-filter__item.active').find('input').val();
    const orders = await getAllCustomerOrder(customerId);
    let olist = ''
    let filteredOrders = [];

    if (search === 'Đang vận chuyển') {
        filteredOrders = orders.filter(item => item.transport === 'Đang vận chuyển');
    } else if (search === 'Đã giao hàng') {
        filteredOrders = orders.filter(item => item.transport === 'Đã giao hàng');
    } else {
        filteredOrders = orders; // Hiển thị tất cả đơn hàng nếu không có tìm kiếm hoặc tìm kiếm không phù hợp
    }

    if (filteredOrders.length > 0) {
        filteredOrders.forEach((item) => {
            olist += `
                <tr class="order-item__product-list">
                <td class="order-item" data-transaction-id="${item.transactionID}">
                    <a href="#" class="order-link">${item.transactionID}</a>
                </td>
                <td>${item.time}</td>
                <td>${item.pay}</td>
                <td>${item.transport}</td>
                <td>${item.total}</td>
                </tr>
            ` 
        });
    } else {
        olist += `<div class="order-empty"><h3>Chưa có đơn hàng</h3><img src="server/src/assets/images/order-empty.png"></div>`
    }
    $('#showlist').html(olist);

    $('#combobox__right').html(`
        <div class="order__container">
            <div class="order-filter">
                <a class="order-filter__item ${search === '' ? 'active' : ''}">
                    <span>Tất cả</span>
                    <input type="hidden" value="" >
                </a>
                <a class="order-filter__item ${search === 'Đang vận chuyển' ? 'active' : ''}">
                    <span>Đang vận chuyển</span>
                    <input type="hidden" value="Đang vận chuyển" >
                </a>
                <a class="order-filter__item ${search === 'Đã giao hàng' ? 'active' : ''}">
                    <span>Đã giao hàng</span>
                    <input type="hidden" value="Đã giao hàng" >
                </a>
            </div>
        </div>
    `)
}

function filterEndUserOrderStatus() {
    $(document).on('click', '.order-filter__item', function() {
        $(this).siblings().removeClass('active')
        $(this).addClass('active')
        // $("#currentpage").val(1)
        AllCustomerOrder()
    })
}

function handleAllCustomerOrder() {
    $(document).on('keyup',function() {
        var traCuuValue = $('.tra-cuu').val().trim(); // Lấy giá trị của phần tử .tra-cuu và loại bỏ các khoảng trắng

        // Kiểm tra xem giá trị của phần tử .tra-cuu có trống không
        if (traCuuValue === '') {
            AllCustomerOrder(); // Nếu trống, gọi hàm AllCustomerOrder()
        }
    });
}

function getCustomerOrder(ma_kh, search) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/TransactionController.php',
            method: 'GET',
            data: { action: 'get-customer-order', ma_kh, search },
            dataType: 'JSON',
            success: orders => resolve(orders),
            error: (xhr, status, error) => reject(error)
        })
    })
}

async function CustomerOrder() {
    const user = username;
    //console.log(user);
    const customerId = await getUserID(user);
    console.log(customerId);
    const search = $('.tra-cuu').val();
    console.log(search);
    const orders = await getCustomerOrder(customerId, search);
    console.log(orders);
    let olist = ''

    if (orders && orders.length > 0) {
        orders.forEach((item) => {
            
            olist += `
                <tr>
                <td>
                    <span class="detail">
                    <a href="../View/user/pages/orderTransaction2_page.php?id=${item.transactionID}" title>${item.transactionID}</a>
                    </span>
                </td>
                <td>${item.time}</td>
                <td>${item.pay}</td>
                <td>${item.transport}</td>
                <td>${item.total}</td>
                </tr>
            `
    
            
        });
    } else {
        olist = '<div class="order-empty"><h3>Chưa có đơn hàng</h3><img src="server/src/assets/images/order-empty.png"></div>'
    }
    $('#showlist').html(olist);
}

function handleCustomerOrder() {
    $('.btn-search').on('click', function() {
        $(this).siblings().not($(this)).removeClass('active')
        $(this).addClass('active')
        CustomerOrder()
    })
}

function renderCustomerOrderDetail() {
    $(document).on('click', '.order-item__product-list', async function() {
        try {
            const orderId = $(this).closest('tr').find('.order-item').data('transaction-id');
            console.log(orderId);
            const order = await getOrder(orderId);
            // console.log(order);
            const orderDetails = await getOrderTransaction(orderId);
            console.log(orderDetails);
            //const address = await getThongTinNhanHang(order.ma_ttnh)
            let html = ''

            // let html = `
            //     <div class="order-detail_address">
            //         <h3>Địa chỉ nhận hàng</h3>
            //         <div class="order-detail__address-info">
            //             <div class="order-detail__address-info-item">
            //                 <label>Người nhận:</label>
            //                 <span>${address.ho_ten}</span>
            //             </div>
            //             <div class="order-detail__address-info-item">
            //                 <label>Số điện thoại:</label>
            //                 <span>${address.so_dien_thoai}</span>
            //             </div>
            //             <div class="order-detail__address-info-item">
            //                 <label>Ngày đặt hàng:</label>
            //                 <span>${convertDate(order.ngay_tao)}</span>
            //             </div>
            //             <div class="order-detail__address-info-item">
            //                 <label>Địa chỉ:</label>
            //                 <span>${address.dia_chi}</span>
            //             </div>
            //             ${order.ghi_chu ? `
            //                 <div class="order-detail__address-info-item">
            //                     <label>Ghi chú:</label>
            //                     <span>${order.ghi_chu}</span>
            //                 </div>
            //             ` : ''}
            //         </div>
            //     </div>
            //     <div class="order-detail__products">
            //         <h3>Sản phẩm</h3>
            //         <div class="order-detail__product-list">
            // `

            orderDetails.forEach((orderDetail, index) => {
                //console.log(orderDetail)
                html += `
                        <div class="order-details">
                            <div class="product-info">
                                <img src="${orderDetail.url_image}">
                            <div>
                                <h2>${orderDetail.name}</h2>
                            </div>
                            </div>
                            <div class="price-info">
                            <span>${orderDetail.quantity}</span>
                            <span>${orderDetail.price}</span>
                            </div>
                        </div>
                        <div class="total">
                            <h3>Tổng tiền: ${orderDetail.total_amount}</h3>
                        </div>
                        `
                index !== orderDetails.length - 1 ? html += '<div class="line"></div>' : ''
            })

            $('#order-detail-modal').html(html);
            // html += '</div></div>'

            // $('#order-detail-modal .modal-title').html(`Chi tiết đơn hàng <b>${order.ma_hd}</b>`)
            // $('#order-detail-modal .modal-body').html(html)
            // $('#order-detail-modal .modal-footer').html(`
            //     <div class="order-detail__total">
            //         <div class="order-detail__total-row">
            //             <div class="order-detail__total-label">
            //                 <span>Tổng tiền sản phẩm</span>
            //             </div>
            //             <div class="order-detail__total-price">
            //                 <span>₫${formatCurrency(order.tong_tien)}</span>
            //             </div>
            //         </div>
            //         <div class="order-detail__total-row">
            //             <div class="order-detail__total-label">
            //                 <span>Giảm giá khuyến mãi</span>
            //             </div>
            //             <div class="order-detail__total-price">
            //                 <span>${order.khuyen_mai > 0 ? `-₫${order.khuyen_mai}` : '₫0'}</span>
            //             </div>
            //         </div>
            //         <div class="order-detail__total-row final">
            //             <div class="order-detail__total-label">
            //                 <span>Thành tiền</span>
            //             </div>
            //             <div class="order-detail__total-price">
            //                 <span>₫${formatCurrency(order.thanh_tien)}</span>
            //             </div>
            //         </div>
            //         <div class="order-detail__payment">
            //             <div class="order-detail__total-label">
            //                 <span>Phương thức thanh toán</span>
            //             </div>
            //             <div class="order-detail__total-price">
            //                 <span>${order.hinh_thuc}</span>
            //             </div>
            //         </div>
            //     </div>
            // `)
        } catch (error) {
            console.log(error)
            alert('Có lỗi xảy ra, vui lòng thử lại sau!')
        }
    })
}

function loadMiniForm(){
    $(document).ready(function() {
        $(document).on('click', '.order-link', function(e) {
            e.preventDefault();
            $('.order-container1').show();
        });
    
        $('.close-button').click(function() {
            $('.order-container1').hide();
        });
    });
}

