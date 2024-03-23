<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="sigin-background">
     <div class="signin" id="login">
        <a class="signin-icon" onclick="displaySignMenu('none')">
          <i class="fa-solid fa-xmark"></i></a>
        <h2 class="signin-heading">Đăng nhập</h2>
        <p class="signin-already" id="signin-already">
          Bạn chưa có tài khoản?
          <a href="#" class="signin-link-underline" onclick="">Hãy tạo ngay</a>
        </p>
        <form id="signin-form" action="../Controllers/Signin-upController.php" method="post" >
          <div class="form-user-name">
            <input type="text" class="form-input" placeholder="Name" id="name" name="username" />
          </div>
          <div class="form-password">
            <input type="password" class="form-input" placeholder="Password" id="pass" name="password"/>
          </div>
          <div>
            <button type="submit" class="form-submit">
              <span class="form-submit-text">Đăng nhập</span>
              <i class="fa fa-long-arrow-right form-submit-icon"></i>
            </button>
          </div>
        </form>
    </div>    
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
 /*   $( "#signin-form" ).on( "submit", function( event ) {
      event.preventDefault();
      console.log( $( this ).serialize() );

      $.ajax({
        type: "POST",
        url: '../Controllers/Signin-upController.php',
        data: $(this).serializeArray(),
        success: function(response){
          /*console.log("respone",response);
        }
      });

    });
*/
</script>
</body>
</html>

 