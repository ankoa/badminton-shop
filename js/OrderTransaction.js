// window.onload = function() {
//     renderCustomerOrderDetail();
// }

function getOrderTransaction(id_transaction) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/OrderTransactionController.php',
            method: 'POST',
            data: { action: 'get-cthd', id_transaction },
            dataType: 'JSON',
            success: cthd => resolve(cthd),
            error: (xhr, status, error) => reject(error)
        })
    })
}

// async function renderCustomerOrderDetail() {
//         try {
//             // const orderId = $(this).closest('tr').find('.order-item').data('transaction-id');
//             // console.log(orderId);
//             // const urlParams = new URLSearchParams(window.location.search);
//             const orderId = ID;
//             console.log(orderId);
//             const order = await getOrder(orderId);
//             // console.log(order);
//             const orderDetails = await getOrderTransaction(orderId);
//             console.log(orderDetails);
//             //const address = await getThongTinNhanHang(order.ma_ttnh)
//             let html = ''

//             // let html = `
//             //     <div class="order-detail_address">
//             //         <h3>Địa chỉ nhận hàng</h3>
//             //         <div class="order-detail__address-info">
//             //             <div class="order-detail__address-info-item">
//             //                 <label>Người nhận:</label>
//             //                 <span>${address.ho_ten}</span>
//             //             </div>
//             //             <div class="order-detail__address-info-item">
//             //                 <label>Số điện thoại:</label>
//             //                 <span>${address.so_dien_thoai}</span>
//             //             </div>
//             //             <div class="order-detail__address-info-item">
//             //                 <label>Ngày đặt hàng:</label>
//             //                 <span>${convertDate(order.ngay_tao)}</span>
//             //             </div>
//             //             <div class="order-detail__address-info-item">
//             //                 <label>Địa chỉ:</label>
//             //                 <span>${address.dia_chi}</span>
//             //             </div>
//             //             ${order.ghi_chu ? `
//             //                 <div class="order-detail__address-info-item">
//             //                     <label>Ghi chú:</label>
//             //                     <span>${order.ghi_chu}</span>
//             //                 </div>
//             //             ` : ''}
//             //         </div>
//             //     </div>
//             //     <div class="order-detail__products">
//             //         <h3>Sản phẩm</h3>
//             //         <div class="order-detail__product-list">
//             // `

//             orderDetails.forEach((orderDetail, index) => {
//                 //console.log(orderDetail)
//                 html += `
//                         <div class="order-details">
//                             <div class="product-info">
//                                 <img src="${orderDetail.url_image}">
//                             <div>
//                                 <h2>${orderDetail.name}</h2>
//                             </div>
//                             </div>
//                             <div class="price-info">
//                             <span>${orderDetail.quantity}</span>
//                             <span>${orderDetail.price}</span>
//                             </div>
//                         </div>
//                         <div class="total">
//                             <h3>Tổng tiền: ${orderDetail.total_amount}</h3>
//                         </div>
//                         `
//                 index !== orderDetails.length - 1 ? html += '<div class="line"></div>' : ''
//             })

//             $('#order-detail-modal').html(html);
//             // html += '</div></div>'

//             // $('#order-detail-modal .modal-title').html(`Chi tiết đơn hàng <b>${order.ma_hd}</b>`)
//             // $('#order-detail-modal .modal-body').html(html)
//             // $('#order-detail-modal .modal-footer').html(`
//             //     <div class="order-detail__total">
//             //         <div class="order-detail__total-row">
//             //             <div class="order-detail__total-label">
//             //                 <span>Tổng tiền sản phẩm</span>
//             //             </div>
//             //             <div class="order-detail__total-price">
//             //                 <span>₫${formatCurrency(order.tong_tien)}</span>
//             //             </div>
//             //         </div>
//             //         <div class="order-detail__total-row">
//             //             <div class="order-detail__total-label">
//             //                 <span>Giảm giá khuyến mãi</span>
//             //             </div>
//             //             <div class="order-detail__total-price">
//             //                 <span>${order.khuyen_mai > 0 ? `-₫${order.khuyen_mai}` : '₫0'}</span>
//             //             </div>
//             //         </div>
//             //         <div class="order-detail__total-row final">
//             //             <div class="order-detail__total-label">
//             //                 <span>Thành tiền</span>
//             //             </div>
//             //             <div class="order-detail__total-price">
//             //                 <span>₫${formatCurrency(order.thanh_tien)}</span>
//             //             </div>
//             //         </div>
//             //         <div class="order-detail__payment">
//             //             <div class="order-detail__total-label">
//             //                 <span>Phương thức thanh toán</span>
//             //             </div>
//             //             <div class="order-detail__total-price">
//             //                 <span>${order.hinh_thuc}</span>
//             //             </div>
//             //         </div>
//             //     </div>
//             // `)
//         } catch (error) {
//             console.log(error)
//             alert('Có lỗi xảy ra, vui lòng thử lại sau!')
//         }
// }