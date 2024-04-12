// Thêm sản phẩm vào giỏ hàng
$(".btn-add-cart").click((event) => {
    var qty = $(this).prev("input").val();
    var product_id = $(this).attr("product-id");
    $.ajax({
        url: 'index.php?c=cart&a=add',
        type: 'GET',
        data: {product_id: product_id, qty: qty}
    })
    .done(function(data) {
        displayCart(data);
    });
});

//Hiển thị cart khi load xong trang web
$.ajax({
    url: 'index.php?c=cart&a=display',
    type: 'GET'
})
.done(function(data) {
    displayCart(data);
    
});
