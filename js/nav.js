countFilter=0;

function loadPage(page, productsPerPage, id) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var listVariantDetails = JSON.parse(this.responseText);
            var htmlContent = '';
            for (var i = 0; i < listVariantDetails.length; i++) {
                htmlContent += `<div class="col-6 col-md-4">
                    <div class="item_product_main">
                        <div class="product-thumbnail">
                            <a class="product_overlay" href="product_detail.php?productID=`+listVariantDetails[i].productID+`" title=""></a>
                            <a class="image_thumb" href="product_detail.php?productID=`+listVariantDetails[i].productID+`" title="">
                                <img width="300" height="300" class="lazyload loaded" src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" data-src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" alt="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)" data-was-processed="true">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><a href="product_detail.php?productID=`+listVariantDetails[i].productID+`" title="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)">`+listVariantDetails[i].name+`</a></h3>
                            <div class="price-box">
                                <span class="price">`+ formatPrice(listVariantDetails[i].price) + ` ₫</span>
                            </div>
                        </div>
                    </div>
                </div>`;
            }
            document.getElementById("show-product").innerHTML = htmlContent;

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

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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

function searchFilter(type, key) {
    var id = getIdFromUrl(); // Lấy id từ đường dẫn URL
    var productsPerPage = document.getElementById("mySelect").value;

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var listVariantDetails = JSON.parse(this.responseText);
            var htmlContent = '';

            for (var i = 0; i < listVariantDetails.length; i++) {
                htmlContent += `<div class="col-6 col-md-4">
                    <div class="item_product_main">
                        <div class="product-thumbnail">
                            <a class="product_overlay" href="product_detail.php?productID=`+listVariantDetails[i].productID+`" title=""></a>
                            <a class="image_thumb" href="product_detail.php?productID=`+listVariantDetails[i].productID+`" title="">
                                <img width="300" height="300" class="lazyload loaded" src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" data-src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" alt="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)" data-was-processed="true">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><a href="product_detail.php?productID=`+listVariantDetails[i].productID+`" title="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)">`+listVariantDetails[i].name+`</a></h3>
                            <div class="price-box">
                                <span class="price">`+ formatPrice(listVariantDetails[i].price) + ` ₫</span>
                            </div>
                        </div>
                    </div>
                </div>`;
            }
            document.getElementById("show-product").innerHTML = htmlContent;

            // Reset lại pagination về trang đầu tiên khi thực hiện lọc
            loadNav(productsPerPage, id);
        }
    };

    // Gửi yêu cầu lọc đến server
    xhttp.open("GET", "http://localhost/badminton-shop/Controllers/ProductFilterController.php?type=" + type + "&key=" + key + "&id=" + id + "&productsPerPage=" + productsPerPage, true);
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
    loadPage(1, 6, id);
    loadNav(6, id);
    if(countFilter==0) {
        document.getElementById("filter-container").classList.add("hide");
    }
});

function getIdFromUrl() {
    // Lấy đường dẫn URL hiện tại
    var url = window.location.href;

    // Phân tích đường dẫn URL để lấy id mong muốn
    var parts = url.split('=');
    var id = parts[1]; // Giả sử id nằm sau dấu '=' trong đường dẫn URL

    return id;
}

function toggleFilter(checkbox) {
    var filterId = checkbox.id;
    var filterItem = document.getElementById("filter-item-" + filterId);

    if (checkbox.checked) {
        countFilter += 1;
        var dataText = checkbox.dataset.text;

        // Tạo một phần tử mới nếu nó chưa tồn tại
        if (!filterItem) {
            filterItem = document.createElement("li");
            filterItem.id = "filter-item-" + filterId;
            filterItem.classList.add("filter-container__selected-filter-item");
            filterItem.innerHTML = `
                <a href="javascript:void(0)" onclick="removeFilteredItem('${filterId}')">
                    <i class="fa fa-close"></i>
                    ${dataText}
                </a>
            `;
            document.getElementById("filter").appendChild(filterItem);
        }

        document.getElementById("filter-container").classList.remove("hide");
        
    } else {
        if (filterItem) {
            countFilter -= 1;
            document.getElementById("filter").removeChild(filterItem);
        }

        if (countFilter == 0) {
            document.getElementById("filter-container").classList.add("hide");
        }
    }
}

function removeFilteredItem(id) {
    var filterItem = document.getElementById("filter-item-" + id);
    var filterItem2 = document.getElementById(id);
    
    // Nếu phần tử tồn tại, loại bỏ nó
    if (filterItem) {
        filterItem.parentNode.removeChild(filterItem);
        filterItem2.checked=false;
        countFilter -= 1;

        // Cập nhật trạng thái của filter-container
        if (countFilter == 0) {
            document.getElementById("filter-container").classList.add("hide");
        } else {
            document.getElementById("filter-container").classList.remove("hide");
        }
    }
}

function clearAllFiltered() {
    var filterContainer = document.getElementById("filter");
    filterContainer.innerHTML = "";

    var checkboxes = document.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });

    var filterContainerElement = document.getElementById("filter-container");
    filterContainerElement.classList.add("hide");
}



