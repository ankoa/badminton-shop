countFilter = 0;
filterArray = [];
selectedFilters = {};

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
                            <a class="product_overlay" href="product_detail.php?productID=`+ listVariantDetails[i].productID + `" title=""></a>
                            <a class="image_thumb" href="product_detail.php?productID=`+ listVariantDetails[i].productID + `" title="">
                                <img width="300" height="300" class="lazyload loaded" src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" data-src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" alt="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)" data-was-processed="true">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><a href="product_detail.php?productID=`+ listVariantDetails[i].productID + `" title="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)">` + listVariantDetails[i].name + `</a></h3>
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
            liElements.forEach(function (li) {
                li.classList.remove('active', 'current-page');
            });

            // Thêm class 'active' và 'current-page' vào thẻ li được click
            var currentLi = document.querySelector('.number-page li:nth-child(' + page + ')');
            currentLi.classList.add('active', 'current-page');

        }
    };

    xhttp.open("GET", "http://localhost/badminton-shop/Controllers/ProductNavController.php?page=" + parseInt(page) + "&productsPerPage=" + parseInt(productsPerPage) + "&id=" + parseInt(id), true);
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
                    htmlContent += '<li onclick="loadPage(' + i + ', ' + productsPerPage + ', ' + id + ')" class="current-page active" data-page="' + i + '" data-products-per-page="' + productsPerPage + '">';
                    htmlContent += '<a>' + i + '</a>';
                    htmlContent += '</li>';
                } else {
                    htmlContent += '<li onclick="loadPage(' + i + ', ' + productsPerPage + ', ' + id + ')" data-page="' + i + '" data-products-per-page="' + productsPerPage + '">';
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
    loadPage(1, productsPerPage, id);
    loadNav(productsPerPage, id);
}

function loadPerPageFilter() {
    var productsPerPage = document.getElementById("mySelect").value;

    loadPageFilter(1, productsPerPage);
    var totalPages = Math.ceil(filterArray.length / getProductPerPage());
    //console.log(filterArray.length);
    var htmlContent = '';

    for (var i = 1; i <= totalPages; i++) {
        if (i == 1) {
            htmlContent += '<li onclick="loadPageFilter(' + i + ', ' + getProductPerPage() + ')" class="current-page active" data-page="' + i + '" data-products-per-page="' + getProductPerPage() + '">';
            htmlContent += '<a>' + i + '</a>';
            htmlContent += '</li>';
        } else {
            htmlContent += '<li onclick="loadPageFilter(' + i + ', ' + getProductPerPage() + ')" data-page="' + i + '" data-products-per-page="' + getProductPerPage() + '">';
            htmlContent += '<a>' + i + '</a>';
            htmlContent += '</li>';
        }
    }

    document.getElementById("number-page").innerHTML = htmlContent;
}

function getProductPerPage() {
    var productsPerPage = document.getElementById("mySelect").value;
    return productsPerPage;
}

window.addEventListener("load", function () {
    // Lấy id từ đường dẫn URL
    var id = getIdFromUrl();

    // Gọi loadPage và loadNav với id và số 6
    loadNav(6, id);
    loadPage(1, 6, id);

    if (countFilter == 0) {
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
    console.log(selectedFilters.thuong_hieu);
    
    var filterItem = document.getElementById("filter-item-" + id);
    var filterItem2 = document.getElementById(id);

    // Nếu phần tử tồn tại, loại bỏ nó
    if (filterItem) {
        filterItem.parentNode.removeChild(filterItem);
        filterItem2.checked = false;
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
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = false;
    });

    var filterContainerElement = document.getElementById("filter-container");
    filterContainerElement.classList.add("hide");
}

function loadPageFilter(page, productsPerPage) {

    var offset = (page - 1) * productsPerPage;
    var productsOnCurrentPage = filterArray.slice(offset, offset + productsPerPage);

    var htmlContent = '';
    for (var i = 0; i < productsOnCurrentPage.length; i++) {
        htmlContent += `<div class="col-6 col-md-4">
                    <div class="item_product_main">
                        <div class="product-thumbnail">
                            <a class="product_overlay" href="product_detail.php?productID=`+ productsOnCurrentPage[i].productID + `" title=""></a>
                            <a class="image_thumb" href="product_detail.php?productID=`+ productsOnCurrentPage[i].productID + `" title="">
                                <img width="300" height="300" class="lazyload loaded" src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" data-src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" alt="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)" data-was-processed="true">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><a href="product_detail.php?productID=`+ productsOnCurrentPage[i].productID + `" title="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)">` + productsOnCurrentPage[i].name + `</a></h3>
                            <div class="price-box">
                                <span class="price">`+ formatPrice(productsOnCurrentPage[i].price) + ` ₫</span>
                            </div>
                        </div>
                    </div>
                </div>`;
    }
    document.getElementById("show-product").innerHTML = htmlContent;

    // Xóa class 'active' và 'current-page' khỏi tất cả các thẻ li
    var liElements = document.querySelectorAll('.number-page li');
    liElements.forEach(function (li) {
        li.classList.remove('active', 'current-page');
    });

    // Thêm class 'active' và 'current-page' vào thẻ li được click
    var currentLi = document.querySelector('.number-page li:nth-child(' + page + ')');
    currentLi.classList.add('active', 'current-page');
}

$(document).ready(function () {
    // Khởi tạo một object để lưu trữ các giá trị của các nhóm filter


    // Xử lý sự kiện khi các input checkbox thay đổi trạng thái
    $("input[type='checkbox']").change(function () {
        // Lấy data-group của checkbox được chọn
        var checkedCount = 0;
        var group = $(this).data('field');
        // Lấy giá trị của checkbox
        var value = $(this).val();

        $("input[type='checkbox']").each(function () {
            if ($(this).prop("checked")) {
                checkedCount++;
            }
        });
        // Kiểm tra nếu group đã tồn tại trong selectedFilters
        if (selectedFilters[group] === undefined) {
            // Nếu chưa tồn tại, tạo một mảng mới
            selectedFilters[group] = [];
        }
        // Nếu checkbox được chọn, thêm giá trị vào mảng của group tương ứng
        if ($(this).prop("checked")) {
            selectedFilters[group].push(value);
        } else {
            // Nếu checkbox được bỏ chọn, loại bỏ giá trị khỏi mảng của group tương ứng
            var index = selectedFilters[group].indexOf(value);
            if (index !== -1) {
                selectedFilters[group].splice(index, 1);
            }
        }


        if (checkedCount > 0) {
            // Gửi yêu cầu lọc đến máy chủ bằng AJAX
            $.ajax({
                url: "http://localhost/badminton-shop/Controllers/ProductNavController.php", // Đường dẫn tới file xử lý yêu cầu lọc trên máy chủ
                type: "GET",
                data: {
                    selectedFilters,
                    filter: true,
                    productsPerPage: getProductPerPage(),
                    id: getIdFromUrl()
                }, // Truyền object chứa thông tin các bộ lọc đã chọn
                success: function (response) {
                    filterArray = JSON.parse(response);
                    //console.log(response);
                    var totalPages = Math.ceil(filterArray.length / getProductPerPage());
                    //console.log(filterArray.length);
                    var htmlContent = '';

                    for (var i = 1; i <= totalPages; i++) {
                        if (i == 1) {
                            htmlContent += '<li onclick="loadPageFilter(' + i + ', ' + getProductPerPage() + ')" class="current-page active" data-page="' + i + '" data-products-per-page="' + getProductPerPage() + '">';
                            htmlContent += '<a>' + i + '</a>';
                            htmlContent += '</li>';
                        } else {
                            htmlContent += '<li onclick="loadPageFilter(' + i + ', ' + getProductPerPage() + ')" data-page="' + i + '" data-products-per-page="' + getProductPerPage() + '">';
                            htmlContent += '<a>' + i + '</a>';
                            htmlContent += '</li>';
                        }
                    }

                    document.getElementById("number-page").innerHTML = htmlContent;

                    //--------------------------//
                    var offset = (1 - 1) * getProductPerPage();
                    var productsOnCurrentPage = filterArray.slice(offset, offset + getProductPerPage());
                    var htmlContent = '';
                    for (var i = 0; i < productsOnCurrentPage.length; i++) {
                        htmlContent += `<div class="col-6 col-md-4">
                    <div class="item_product_main">
                        <div class="product-thumbnail">
                            <a class="product_overlay" href="product_detail.php?productID=`+ productsOnCurrentPage[i].productID + `" title=""></a>
                            <a class="image_thumb" href="product_detail.php?productID=`+ productsOnCurrentPage[i].productID + `" title="">
                                <img width="300" height="300" class="lazyload loaded" src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" data-src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" alt="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)" data-was-processed="true">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><a href="product_detail.php?productID=`+ productsOnCurrentPage[i].productID + `" title="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)">` + productsOnCurrentPage[i].name + `</a></h3>
                            <div class="price-box">
                                <span class="price">`+ formatPrice(productsOnCurrentPage[i].price) + ` ₫</span>
                            </div>
                        </div>
                    </div>
                </div>`;
                    }
                    document.getElementById("show-product").innerHTML = htmlContent;

                    // Xóa class 'active' và 'current-page' khỏi tất cả các thẻ li
                    var liElements = document.querySelectorAll('.number-page li');
                    liElements.forEach(function (li) {
                        li.classList.remove('active', 'current-page');
                    });

                    // Thêm class 'active' và 'current-page' vào thẻ li được click
                    var currentLi = document.querySelector('.number-page li:nth-child(' + 1 + ')');
                    currentLi.classList.add('active', 'current-page');


                    //--------------------------//
                    document.getElementById("page-config").innerHTML = '<label for="mySelect">Item per page: </label>' +
                        '<select name="mySelect" id="mySelect" onchange="loadPerPageFilter()">' +
                        '<option value="3">3</option>' +
                        '<option value="6" selected>6</option>' +
                        '<option value="9">9</option>' +
                        '<option value="12">12</option>' +
                        '</select>';

                }
            });
        } else {
            // Lấy id từ đường dẫn URL
            var id = getIdFromUrl();

            // Gọi loadPage và loadNav với id và số 6
            loadNav(6, id);
            loadPage(1, 6, id);

            if (countFilter == 0) {
                document.getElementById("filter-container").classList.add("hide");
            }

            document.getElementById("page-config").innerHTML = '<label for="mySelect">Item per page: </label>' +
                '<select name="mySelect" id="mySelect" onchange="loadPerPage()">' +
                '<option value="3">3</option>' +
                '<option value="6" selected>6</option>' +
                '<option value="9">9</option>' +
                '<option value="12">12</option>' +
                '</select>';
        }
    });
});



