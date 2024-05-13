const backToTop = document.querySelector('.back-to-top');

window.addEventListener('scroll' , () => {
    if (window.scrollY > 500) {
        backToTop.classList.add("open");
    } else {
        backToTop.classList.remove("open");
    }
})
const header = document.getElementById('header');

function scrollToTop() {
    const header = document.getElementById('header');
    header.scrollIntoView({ behavior: 'smooth' });
}

function delProductCart(cartID, productID, variantID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var string= cartID+"_"+productID+"_"+variantID;
            document.getElementById(string).remove();
            var totalprice = document.querySelectorAll('.total-price');
            var mes = parseInt(JSON.parse(this.responseText));
            totalprice.forEach(function(element) {
                element.innerHTML=Math.floor(mes).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
            });
        }
    };

    // Gửi yêu cầu AJAX đến tệp PHP để xử lý
    xhttp.open("GET", "addCart.php?productID=" + productID + "&variantID=" + variantID + "&cartID=" + cartID + "&action=delete", true);
    xhttp.send();
}
