const initSlider = () => {
    const imageList = document.querySelector(".slider-wrapper .image-list");
    const slideButtons = document.querySelectorAll(".slider-wrapper .slide-button");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
    const imageWidth = imageList.children[0].clientWidth; // Assuming all images have the same width
    const bigImageContainer = document.querySelector('.big-img');

    // Function to slide images
    const slideImages = (direction) => {
        const scrollAmount = direction === -1 ? -imageWidth - 18 : imageWidth + 18;
        imageList.scrollBy({ left: scrollAmount, behavior: "smooth" });
    };

    // Slide images according to the slide button clicks
    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            slideImages(direction);
        });
    });

    // Show or hide slide buttons based on scroll position
    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "flex";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "flex";
    };

    // Call handleSlideButtons function initially
    handleSlideButtons();

    // Call handleSlideButtons function when image list scrolls
    imageList.addEventListener("scroll", handleSlideButtons);

    // Function to display the clicked image in the big-img container
    const displayBigImage = (src) => {
        const bigImage = document.createElement('img');
        bigImage.src = src;
        bigImage.style.maxWidth = '100%';
        bigImage.style.maxHeight = '100%';
        bigImage.style.objectFit = 'cover';
        // Clear previous big image
        bigImageContainer.innerHTML = '';
        // Append new big image
        bigImageContainer.appendChild(bigImage);
    };

    const handleClickOnImage = (event) => {
        // Remove class .img-chosen-border from all images in the slider
        imageList.querySelectorAll('.image-item').forEach(image => {
            image.classList.remove('img-chosen-border');
        });
    
        // Add class .img-chosen-border to the clicked image
        event.target.classList.add('img-chosen-border');
    
        const clickedImageSrc = event.target.src;
        displayBigImage(clickedImageSrc);
    };

    // Add event listener to images in the slider
    imageList.querySelectorAll('.image-item').forEach(image => {
        image.addEventListener('click', handleClickOnImage);
    });

    // Display the first image in the big-img container on page load
    const firstImageSrc = imageList.querySelector('.image-item').src;
    displayBigImage(firstImageSrc);

    // Select the first image in the slider
    const firstImage = imageList.querySelector('.image-item');

    // Add class .img-chosen-border to the first image
    firstImage.classList.add('img-chosen-border');
};

// Call initSlider function on window resize and page load
window.addEventListener("resize", initSlider);

window.addEventListener("load", function () {
    initSlider();
    document.getElementById("tab1").click();
    document.getElementById("tab1").style.display = 'block';
});

function addCart() {
    document.getElementById('popup-cart-mobile').classList.add('active');
    document.getElementById('full-cover').style.opacity = "0.5";

}

// Function to load version by color using AJAX
function loadVersion(productID, color) {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var listVariantDetails = JSON.parse(this.responseText);
            var existingVersion = document.getElementById('version');
            if (existingVersion !== null) {
                // Nếu phần tử đã tồn tại, có thể xóa nếu cần
                existingVersion.parentNode.removeChild(existingVersion);
            }
            var htmlContent = '<div class="select-swatch"><div class="swatch clearfix"><div class="header">Chọn phiên bản: </div>';
            console.log(listVariantDetails);
            for (var i = 0; i < listVariantDetails.length; i++) {
                if (listVariantDetails[i].color == color) {
                    if (listVariantDetails[i].quantity >= 1) {
                        // Thêm mã HTML cho phần tử mới vào chuỗi htmlContent
                        htmlContent += '<div class="swatch-element version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '" data-value="1" data-value_2="1">' +
                            '<input id="version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '" type="radio" name="1" value="1">' +
                            '<label for="version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '">' +
                            listVariantDetails[i].weight + listVariantDetails[i].grip +
                            '<img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="'+listVariantDetails[i].weight + listVariantDetails[i].grip+'">' +
                            '</label>' +
                            '</div>';
                    } else if (listVariantDetails[i].quantity <=0 ) {
                        htmlContent += '<div class="swatch-element soldout version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '" data-value="1" data-value_2="1">' +
                            '<input disabled id="version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '" type="radio" name="1" value="1">' +
                            '<label for="version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '">' +
                            listVariantDetails[i].weight + listVariantDetails[i].grip +
                            '<img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="'+listVariantDetails[i].weight + listVariantDetails[i].grip+'">' +
                            '</label>' +
                            '</div>';
                    }
                }
            }
            htmlContent += '</div></div>';
            // Thêm chuỗi HTML vào phần tử có id là "hidden"
            document.getElementById("hidden").innerHTML = htmlContent;
        }
    };
    
    // Gửi yêu cầu AJAX đến tệp PHP để xử lý
    xhttp.open("GET", "http://localhost/badminton-shop/Controllers/ProductDetailController.php?productID=" + productID + "&color=" + color + "&type=racket", true);
    xhttp.send();
}

function loadSize(productID, color) {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var listVariantDetails = JSON.parse(this.responseText);
            var existingVersion = document.getElementById('version');
            if (existingVersion !== null) {
                // Nếu phần tử đã tồn tại, có thể xóa nếu cần
                existingVersion.parentNode.removeChild(existingVersion);
            }
            var htmlContent = '<div class="select-swatch"><div class="swatch clearfix"><div class="header">Chọn size: </div>';
            //console.log(listVariantDetails);
            for (var i = 0; i < listVariantDetails.length; i++) {
                if (listVariantDetails[i].color == color) {
                    if (listVariantDetails[i].quantity >= 1) {
                        // Thêm mã HTML cho phần tử mới vào chuỗi htmlContent
                        htmlContent += '<div class="swatch-element version-' + listVariantDetails[i].size+ '" data-value="1" data-value_2="1">' +
                            '<input id="version-' + listVariantDetails[i].size + '" type="radio" name="1" value="1">' +
                            '<label for="version-' + listVariantDetails[i].size + '">' +
                            listVariantDetails[i].size +
                            '<img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="'+listVariantDetails[i].size+'">' +
                            '</label>' +
                            '</div>';
                    } else if (listVariantDetails[i].quantity <=0 ) {
                        htmlContent += '<div class="swatch-element soldout version-' + listVariantDetails[i].size + '" data-value="1" data-value_2="1">' +
                            '<input disabled id="version-' + listVariantDetails[i].size + '" type="radio" name="1" value="1">' +
                            '<label for="version-' + listVariantDetails[i].size + '">' +
                            listVariantDetails[i].size +
                            '<img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="'+listVariantDetails[i].size+'">' +
                            '</label>' +
                            '</div>';
                    }
                }
            }
            htmlContent += '</div></div>';
            // Thêm chuỗi HTML vào phần tử có id là "hidden"
            document.getElementById("hidden").innerHTML = htmlContent;
        }
    };
    
    // Gửi yêu cầu AJAX đến tệp PHP để xử lý
    xhttp.open("GET", "http://localhost/badminton-shop/Controllers/ProductDetailController.php?productID=" + productID + "&color=" + color + "&type=shoes", true);
    xhttp.send();
}

// Lấy tất cả các nút tab
const tabButtons = document.querySelectorAll('.tab-button');

// Lặp qua từng nút tab và thêm sự kiện click
tabButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Lấy id của tab được nhấn
        const tabId = button.getAttribute('data-tab');

        // Lấy tất cả các nội dung tab
        const tabContents = document.querySelectorAll('.tab-content');

        // Ẩn tất cả các tab content và loại bỏ class "active" khỏi các nút tab
        tabContents.forEach(content => {
            content.style.display = 'none';
        });
        tabButtons.forEach(tabButton => {
            tabButton.classList.remove('active');
        });

        // Hiển thị tab content tương ứng với tab được nhấn và thêm class "active" cho nút tab đó
        const selectedTabContent = document.getElementById(tabId);
        if (selectedTabContent) {
            selectedTabContent.style.display = 'block';
            button.classList.add('active');
        }
    });
});


