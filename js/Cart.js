// Thêm sản phẩm vào giỏ hàng
$(".btn-add-cart").click((event) => {
    var qty = $(this).prev("input").val();
    var product_id = $(this).attr("product-id");
    $.ajax({
        url: 'index.php?c=cart&a=add',
        type: 'GET',
        data: { product_id: product_id, qty: qty }
    })
        .done(function (data) {
            displayCart(data);
        });
});

//Hiển thị cart khi load xong trang web
$.ajax({
    url: 'index.php?c=cart&a=display',
    type: 'GET'
})
    .done(function (data) {
        displayCart(data);

    });

function delProductCart(cartID, productID, variantID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var string= cartID+"_"+productID+"_"+variantID;
            document.getElementById(string).remove();
        }
    };

    // Gửi yêu cầu AJAX đến tệp PHP để xử lý
    xhttp.open("GET", "addCart.php?productID=" + productID + "&variantID=" + variantID + "&cartID=" + cartID, true);
    xhttp.send();
}
