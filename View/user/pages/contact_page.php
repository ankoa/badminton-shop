<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Contact Form</title>


    <link rel="stylesheet" href="../../css/contact.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCw5V6J4vTdATROsdwRAG2A84Z_2ErVTqw&callback=initMap" async defer></script>

</head>

<body>

    <div class="container">
        <div class="left-side">
            <h2>NƠI GIẢI ĐÁP TOÀN BỘ MỌI THẮC MẮC CỦA BẠN?</h2>
            <div class="contact-info">
                <p><span class="bold">Hotline:</span> 0123456789 | 0987654321</p>
                <p><span class="bold">Email:</span> info@shop.com</p>
            </div>
            <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
            <form id="contact-form">
                <div class="form-group">
                    <label for="fullname">Họ và tên:</label>
                    <input type="text" id="fullname" name="fullname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]+" required>
                </div>
                <div class="form-group">
                    <label for="message">Nội dung:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <input type="submit" value="Gửi thông tin" class="submit-btn">
            </form>
            <div id="map"></div>
        </div>
        <div class="right-side">
            <h2>THÔNG TIN CHI NHÁNH SHOP</h2>
            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB PREMIUM Quận 1</a></span> - <a href="tel:0931823614" style="color: black;"><span>0931823614</span></a><br>
                    <a href="#" style="color: black;"><span>20 Cao Bá Nhạ, Phường Nguyễn Cư Trinh, Quận 1, TPHCM</span></a>
                </p>
            </div>

            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB PREMIUM Bình Thạnh</a></span> - <a href="tel:0862527179" style="color: black;"><span>0862527179</span></a><br>
                    <a href="#" style="color: black;"><span>284 Xô Viết Nghệ Tĩnh, P21, Quận Bình Thạnh, Tp.HCM</span></a>
                </p>
            </div>

            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB Quận 1</a></span> - <a href="tel:0798684568" style="color: black;"><span>0798684568</span></a><br>
                    <a href="#" style="color: black;"><span>Số 6 Nguyễn Hữu Cầu Phường Tân Định Quận 1</span></a>
                </p>
            </div>

            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB Quận 2</a></span> - <a href="tel:0937441822" style="color: black;"><span>0937441822</span></a><br>
                    <a href="#" style="color: black;"><span>254 Nguyễn Hoàng, phường An Phú, quận 2, TP Hồ Chí Minh</span></a>
                </p>
            </div>

            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB Quận 3</a></span> - <a href="tel:0936914920" style="color: black;"><span>0936914920</span></a><br>
                    <a href="#" style="color: black;"><span>218 Lý Thái Tổ Phường 1, Quận 3</span></a>
                </p>
            </div>

            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB Quận 4</a></span> - <a href="tel:0707707886" style="color: black;"><span>070 770 7886</span></a><br>
                    <a href="#" style="color: black;"><span>Số 400 Đường Hoàng Diệu, Phường 2, Quận 4, Thành phố Hồ Chí Minh</span></a>
                </p>
            </div>

            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB Quận 5</a></span> - <a href="tel:0903178483" style="color: black;"><span>0903 178 483</span></a><br>
                    <a href="#" style="color: black;"><span>19 Tân Hưng, Phường 12, Quận 5, TPHCM</span></a>
                </p>
            </div>

            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB Quận 6</a></span> - <a href="tel:0935267926" style="color: black;"><span>0935267926</span></a><br>
                    <a href="#" style="color: black;"><span>165 Kinh Dương Vương Phường 12 Quận 6</span></a>
                </p>
            </div>

            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB Quận 7</a></span> - <a href="tel:0899793965" style="color: black;"><span>0899793965</span></a><br>
                    <a href="#" style="color: black;"><span>39 đường 65, Phường Tân Phong, Quận 7, TP. HCM</span></a>
                </p>
            </div>

            <div class="branch-info">
                <p><span class="bold"><a href="#">VNB Quận 8</a></span> - <a href="tel:0925888895" style="color: black;"><span>0925888895</span></a><br>
                    <a href="#" style="color: black;"><span>888 Tạ Quang Bửu, Phường 5, Quận 8, TP. HCM</span></a>
                </p>
            </div>


        </div>
    </div>

    <script>
        // function showMap(branchId) {
        //     var address = document.getElementById(branchId).innerText;
        //     var mapDiv = document.getElementById('map');
        //     var iframe = document.createElement('iframe');
        //     iframe.setAttribute('src', 'https://www.google.com/maps/embed/v1/place?q=' + encodeURIComponent(address));
        //     iframe.setAttribute('width', '100%');
        //     iframe.setAttribute('height', '400');
        //     iframe.setAttribute('frameborder', '0');
        //     iframe.setAttribute('style', 'border:0');
        //     mapDiv.innerHTML = ''; 
        //     mapDiv.appendChild(iframe);
        // }
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault();


            var name = document.getElementById('fullname').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var message = document.getElementById('message').value;

            if (name && email && phone && message) {
                alert('Thông tin liên hệ đã được gửi đi thành công');
            }
        });
    </script>
</body>

</html>