window.onload = function() {
    //handleSearch();
    handleCustomerOrder();
    handleAllCustomerOrder();
    const urlParams = new URLSearchParams(window.location.search);
    if (window.location.pathname === '/badminton-shop/Controllers/index.php' && urlParams.get('control') === 'checkDonHang') {
        AllCustomerOrder();
    }
    
};

function searchTransactionsByPhone(phoneNumber) {   
    // Gửi yêu cầu AJAX đến tệp PHP xử lý
    $.ajax({
        url: '../Controllers/TransactionController.php', // Đặt đường dẫn tới tệp PHP xử lý
        method: 'POST',
        data: { action: 'findPhone', phoneNumber }, // Dữ liệu gửi đi, trong trường này là số điện thoại
        dataType: 'json', // Định dạng dữ liệu trả về là JSON
        success: data => {
            console.log(data)
             var html="";
            // //Xử lý kết quả thành công
            if (data && data.length > 0) {
                data.forEach((item,index) => {
                    html+=`
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
                    </tr>`
                });      
            }       
            $('#show-listHoaDon').html(html);
        },
    })
}  

function searchTransactionsByCode(TransactionID) {
    $.ajax({
        url: '../Controllers/TransactionController.php',
        method: 'POST',
        data: { action: 'findTranCode', TransactionID },
        dataType: 'json',
        success: data => {
            var html="";
            if (data.length > 0) {
                data.forEach((order,index) => {
                    html+=`
                        <tr>
                        <td>
                            <span class="detail">
                            <a href="../View/user/pages/orderTransaction2_page.php?id=${order.transactionID}" title>${order.transactionID}</a>
                            </span>
                        </td>
                        <td>${order.time}</td>
                        <td>${order.pay}</td>
                        <td>${order.transport}</td>
                        <td>${order.total}</td>
                        </tr>

                    `;
                    // getProductByCode(item['productID'],index); // Gọi hàm lấy thông tin sản phẩm dựa trên ProductID
                    // $('#Total').text(item.total);
                    const orderDetails = getChiTietHoaDon(order.transactionID)
                    orderDetails.forEach(product => {
                        html += `
                            <div class="order-container">
                                <div class="header">
                                    <h1>Đặt hàng thành công</h1>
                                    <button class="close-button">X</button>
                                </div>
                                <div class="order-details">
                                    <div class="product-info">
                                        <img src="${product.url_image}">
                                    <div>
                                        <h2>${product.name}</h2>
                                        <p>${product.description}</p>
                                    </div>
                                    </div>
                                    <div class="price-info">
                                    <span>${product.quantity}</span>
                                    <span>${product.price}</span>
                                    </div>
                                </div>
                                <div class="total">
                                    <h3>Tổng tiền: ${product.total_amount}</h3>
                                </div>
                            </div>
                        `
                    })
                });   
            } 
            $('#show-list2').html(html);
        }
    });
} 

function handleSearch(){
    // Sử dụng hàm khi cần tìm kiếm
    $(document).on('click', '.btn-search', e=>{
        // Lấy số điện thoại từ trường nhập
        var TransactionID = $('#tra-cuu').val();

        // Kiểm tra nếu số điện thoại không rỗng
        if (TransactionID.trim() !== '') {
            // Gọi hàm searchTransactionsByPhone để tìm kiếm
            searchTransactionsByPhone(TransactionID);
        }
    }) 
}
  
// var modal = document.getElementById('id01');

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }

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
    //console.log(user);
    const customerId = await getUserID(user);
    console.log(customerId);
    const status = $('.order-filter__item.active').find('input').val();
    const orders = await getAllCustomerOrder(customerId);
    console.log(orders);
    let olist = ''

    $('#combobox_right').html(`
        <div class="order_container">
            <div class="order-filter">
                <a class="order-filter__item ${status === '' ? 'active' : ''}">
                    <span>Tất cả</span>
                    <input type="hidden" value="" >
                </a>
                <a class="order-filter__item ${status === 'Đang vận chuyển' ? 'active' : ''}">
                    <span>Đang vận chuyển</span>
                    <input type="hidden" value="Đang vận chuyển" >
                </a>
                <a class="order-filter__item ${status === 'Đang đóng gói' ? 'active' : ''}">
                    <span>Đang đóng gói</span>
                    <input type="hidden" value="Đang đóng gói" >
                </a>
            </div>
        </div>
    `)

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
        olist += `<div class="order-empty"><h3>Chưa có đơn hàng</h3><img src="server/src/assets/images/order-empty.png"></div>`
    }
    $('#showlist').html(olist);
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