function loadPage(page, productsPerPage, id) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var listVariantDetails = JSON.parse(this.responseText);
            var htmlContent = '<div class="contentitem">';
            for (var i = 0; i < listVariantDetails.length; i++) {
                htmlContent += '<div class="item">' + listVariantDetails[i].name + '</div>';
            }
            htmlContent += '</div>';
            document.getElementById("product").innerHTML = htmlContent;
            // Xóa class 'active' và 'current-page' khỏi tất cả các thẻ li
            var liElements = document.querySelectorAll('.number-page li');
            liElements.forEach(function(li) {
                li.classList.remove('active', 'current-page');
            });

            // Thêm class 'active' và 'current-page' vào thẻ li được click
            var currentLi = document.querySelector('.number-page li:nth-child(' + page + ')');
            currentLi.classList.add('active', 'current-page');
            
        }
    };

    xhttp.open("GET", "http://localhost/badminton-shop/Controllers/ProductNavController.php?page=" + parseInt(page) + "&productsPerPage=" + parseInt(productsPerPage)+ "&id=" + parseInt(id), true);
    xhttp.send();
}

function loadNav(productsPerPage, id) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var totalPages = parseInt(this.responseText.trim()); // Trim whitespace before parsing
            var htmlContent = '';

            for (var i = 1; i <= totalPages; i++) {
                if (i == 1) {
                    htmlContent += '<li onclick="loadPage(' + i + ', ' + productsPerPage + ', ' +id+ ')" class="current-page active" data-page="' + i + '" data-products-per-page="' + productsPerPage + '">';
                    htmlContent += '<a>' + i + '</a>';
                    htmlContent += '</li>';
                } else {
                    htmlContent += '<li onclick="loadPage(' + i + ', ' + productsPerPage + ', ' +id+ ')" data-page="' + i + '" data-products-per-page="' + productsPerPage + '">';
                    htmlContent += '<a>' + i + '</a>';
                    htmlContent += '</li>';
                }
            }

            document.getElementById("number-page").innerHTML = htmlContent;
        }
    };

    xhttp.open("GET", "http://localhost/badminton-shop/Controllers/ProductNavController.php?id=" + id + "&productsPerPage=" + productsPerPage, true);
    xhttp.send();
}

function loadPerPage() {
    var productsPerPage = document.getElementById("mySelect").value;
    var id = getIdFromUrl();

    // Gọi loadPage và loadNav với id và số 6
    loadPage(1, productsPerPage,id);
    loadNav(productsPerPage, id);
}

window.addEventListener("load", function() {
    // Lấy id từ đường dẫn URL
    var id = getIdFromUrl();

    // Gọi loadPage và loadNav với id và số 6
    loadPage(1, 6,id);
    loadNav(6, id);
});

function getIdFromUrl() {
    // Lấy đường dẫn URL hiện tại
    var url = window.location.href;

    // Phân tích đường dẫn URL để lấy id mong muốn
    var parts = url.split('=');
    var id = parts[1]; // Giả sử id nằm sau dấu '=' trong đường dẫn URL

    return id;
}

