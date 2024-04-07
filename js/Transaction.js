$(document).ready(() => {
    handleSearch()
})

function searchTransactionsByPhone(phoneNumber) {   
    // Gửi yêu cầu AJAX đến tệp PHP xử lý
    $.ajax({
        url: '../Controllers/TransactionController.php', // Đặt đường dẫn tới tệp PHP xử lý
        method: 'POST',
        data: { action: 'findPhone', phoneNumber }, // Dữ liệu gửi đi, trong trường này là số điện thoại
        dataType: 'json', // Định dạng dữ liệu trả về là JSON
        success: data => {
            //var transac = JSON.parse(data);
             
             var html="";
            // //Xử lý kết quả thành công
            if (data && data.length > 0) {
                data.forEach((item,index) => {
                    html+=`<tr>
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
    $(document).on('click', '.detail', function(e) {
        var url = $(this).find('a').attr('href');
        var transaction = url.split('=')[1];
        console.log(transaction);
        searchTransactionsByCode(transaction);
    });
}  

function getProductByCode(ProductID,index) {
    
    $.ajax({
        url: "../Controllers/ProductController.php",
        method: 'POST',
        data: { action: "findProCode", ProductID },
        success: data => {
            var product = JSON.parse(data);
            // $("#proID1" + index + "").text(product['name']);
            // $("#proID2" + index + "").text(product['price']);
            // $("#proID3" + index + "").text(product['description']);
            $(`#proID1_${index}`).text(product['name']);
            $(`#proID2_${index}`).text(product['price']);
            $(`#proID3_${index}`).text(product['description']);
        }
        
    });
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
                data.forEach((item,index) => {
                    html+=`
                        <div>
                            <div class="order-status">
                                <div class="order-status-ordered_status">
                                    <p>Đặt hàng thành công</p>
                                </div>
                                <div class="order-status-ordered_datetime">
                                    <p> ${item.time}</p>
                                </div>
                            </div>
                            <div class="order-products-item">
                                <div class="order-products-item-info">
                                <img src="https://imgs.search.brave.com/forVe7WQ1akzzX8Rqo_MRV_kQA3kVJ8FTLlYe4UG04c/rs:fit:500:0:0/g:ce/aHR0cHM6Ly90My5m/dGNkbi5uZXQvanBn/LzAwLzc5LzMxLzQ2/LzM2MF9GXzc5MzE0/NjM5X0NDOUF6VkZP/SmU2R0tKaG5admhL/NmwzV0lCMEdHdTZK/LmpwZw" width="100px" alt="">
                                    <div>
                                        <span><p id="proID1_${index}"></p></span> <!-- Thẻ p để hiển thị tên sản phẩm -->
                                        <span><p id="proID3_${index}"></p></span> <!-- Thẻ p để hiển thị mô tả -->
                                    </div>
                                </div>
                                <div class="order-product-item-quantity_price">
                                    <span><p> ${item.amount}</p></span>
                                    <span><p id="proID2_${index}"></p></span> <!-- Thẻ p để hiển thị giá sản phẩm -->
                                </div>
                            </div>
                        </div>
                    `;
                    getProductByCode(item['productID'],index); // Gọi hàm lấy thông tin sản phẩm dựa trên ProductID
                    $('#Total').text(item.total);
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
  
  var modal = document.getElementById('id01');
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
