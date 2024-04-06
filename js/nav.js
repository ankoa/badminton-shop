countFilter = 0;
filterArray = [];
selectedFilters = {};

function uncheckAllInputs() {
    // Lấy tất cả các phần tử input trên trang
    var inputs = document.querySelectorAll('input[type="checkbox"]');
    
    // Lặp qua mỗi phần tử và bỏ chọn (unchecked) nó
    inputs.forEach(function(input) {
        input.checked = false;
    });
}

function getAllByCatalogAndBrand() {
    return new Promise(function(resolve, reject) {
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    var listVariantDetails = JSON.parse(this.responseText);
                    resolve(listVariantDetails); // Trả về dữ liệu khi hoàn thành
                } else {
                    reject(new Error("Yêu cầu thất bại")); // Báo lỗi nếu yêu cầu không thành công
                }
            }
        };

        xhttp.open("GET", "http://localhost/badminton-shop/Controllers/ProductNavController.php?getAll=true&id="+getIdFromUrl(), true);
        xhttp.send();
    });
}

// Sử dụng promise
getAllByCatalogAndBrand()
    .then(function(data) {
        filterArray = data;
    })
    .catch(function(error) {
        console.error("Lỗi:", error);
    });



function loadPage(page, productsPerPage, id) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var listVariantDetails = JSON.parse(this.responseText);
            var htmlContent = '';
            for (var i = 0; i < listVariantDetails.length; i++) {
                htmlContent += `<div class="col-6 col-md-3">
                    <div class="item_product_main">
                        <div class="product-thumbnail">
                            <a class="product_overlay" href="index.php?control=ProductDetail&productID=`+ listVariantDetails[i].productID + `" title=""></a>
                            <a class="image_thumb" href="index.php?control=ProductDetail&productID=`+ listVariantDetails[i].productID + `" title="">
                                <img width="300" height="300" class="lazyload loaded" src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" data-src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" alt="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)" data-was-processed="true">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><a href="index.php?control=ProductDetail&productID=`+ listVariantDetails[i].productID + `" title="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)">` + listVariantDetails[i].name + `</a></h3>
                            <div class="price-box-nav">
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

function loadPageFilter(page, productsPerPage) {

    var offset = (page - 1) * productsPerPage;
    var productsOnCurrentPage = filterArray.slice(offset, offset + productsPerPage);

    var htmlContent = '';
    for (var i = 0; i < productsOnCurrentPage.length; i++) {
        htmlContent += `<div class="col-6 col-md-3">
                    <div class="item_product_main">
                        <div class="product-thumbnail">
                            <a class="product_overlay" href="index.php?control=ProductDetail&productID=`+ productsOnCurrentPage[i].productID + `" title=""></a>
                            <a class="image_thumb" href="index.php?control=ProductDetail&productID=`+ productsOnCurrentPage[i].productID + `" title="">
                                <img width="300" height="300" class="lazyload loaded" src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" data-src="https://cdn.shopvnb.com/img/300x300/uploads/gallery/vot-cau-long-victor-brave-sword-ltd-pro-noi-dia-taiwan-jpg-4_1711143954.webp" alt="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)" data-was-processed="true">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><a href="index.php?control=ProductDetail&productID=`+ productsOnCurrentPage[i].productID + `" title="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)">` + productsOnCurrentPage[i].name + `</a></h3>
                            <div class="price-box-nav">
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

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function loadNavFilter() {
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

    loadPage(1, productsPerPage, id);
    loadNav(productsPerPage, id);
}

function loadPerPageFilter() {
    var productsPerPage = document.getElementById("mySelect").value;

    loadPageFilter(1, productsPerPage);
    loadNavFilter();
}

function getProductPerPage() {
    var productsPerPage = document.getElementById("mySelect").value;
    return productsPerPage;
}

window.addEventListener("load", function () {
    // Lấy id từ đường dẫn URL
    var id = getIdFromUrl();

    // Gọi loadPage và loadNav với id và số 6
    loadNav(8, id);
    loadPage(1, 8, id);

    if (countFilter == 0) {
        document.getElementById("filter-container").classList.add("hide");
    }

    uncheckAllInputs()
});

function getIdFromUrl() {
    // Lấy đường dẫn URL hiện tại
    var url = window.location.href;

    // Phân tích đường dẫn URL để lấy tham số id
    var urlParams = new URLSearchParams(new URL(url).search);
    var id = urlParams.get('id');

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

    loadNav(getProductPerPage(),getIdFromUrl());
    loadPage(1,getProductPerPage(),getIdFromUrl());
}

function sapXep(arr, key) {
    if (key == 'alpha-asc') {
        return arr.sort(function (a, b) {
            return a.name.localeCompare(b.name);
        });
    } else if (key == 'alpha-desc') {
        return arr.sort(function (a, b) {
            return b.name.localeCompare(a.name);
        });
    } else if (key == 'price-asc') {
        return arr.sort(function (a, b) {
            return a.price - b.price;
        });
    } else if (key == 'price-desc') {
        return arr.sort(function (a, b) {
            return b.price - a.price;
        });
    } else if (key == 'created-desc') {

    } else if (key == 'created-asc') {

    }
}

function sortby(key) {
    if (filterArray.length <= 0) {
        getAllByCatalogAndBrand()
    }
    sapXep(filterArray, key);
    console.log(filterArray);
    loadNavFilter();
    loadPageFilter(1,getProductPerPage());

    document.getElementById("page-config").innerHTML = '<label for="mySelect">Item per page: </label>' +
                        '<select name="mySelect" id="mySelect" onchange="loadPerPageFilter()">' +
                        '<option value="4">4</option>' +
                        '<option value="8" selected>8</option>' +
                        '<option value="12">12</option>' +
                        '<option value="16">16</option>' +
                        '</select>';
                        if (key == 'alpha-asc') {
                            document.getElementById('keysort').innerHTML='A → Z';
                        } else if (key == 'alpha-desc') {
                            document.getElementById('keysort').innerHTML='Z → A';
                        } else if (key == 'price-asc') {
                            document.getElementById('keysort').innerHTML='Giá tăng dần';
                        } else if (key == 'price-desc') {
                            document.getElementById('keysort').innerHTML='Giá giảm dần';
                        } else if (key == 'created-desc') {
                    
                        } else if (key == 'created-asc') {
                    
                        }
    
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

        console.log(selectedFilters);


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
                    loadPageFilter(1, getProductPerPage());

                    //--------------------------//
                    document.getElementById("page-config").innerHTML = '<label for="mySelect">Item per page: </label>' +
                        '<select name="mySelect" id="mySelect" onchange="loadPerPageFilter()">' +
                        '<option value="4">4</option>' +
                        '<option value="8" selected>8</option>' +
                        '<option value="12">12</option>' +
                        '<option value="16">16</option>' +
                        '</select>';

                }
            });
        } else {
            // Lấy id từ đường dẫn URL
            var id = getIdFromUrl();

            // Gọi loadPage và loadNav với id và số 6
            loadNav(8, id);
            loadPage(1, 8, id);

            if (countFilter == 0) {
                document.getElementById("filter-container").classList.add("hide");
            }

            document.getElementById("page-config").innerHTML = '<label for="mySelect">Item per page: </label>' +
                '<select name="mySelect" id="mySelect" onchange="loadPerPage()">' +
                '<option value="4">4</option>' +
                '<option value="8" selected>8</option>' +
                '<option value="12">12</option>' +
                '<option value="16">16</option>' +
                '</select>';
        }
    });
});



