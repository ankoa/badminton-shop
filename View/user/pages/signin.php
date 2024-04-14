<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
      .signin {
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45%; 
            max-width: 35rem; 
            height: 70%;
        }
        
        .form-input {
            font-family: 'Poppins', sans-serif;
            color: black;
            padding: 1.5rem;
            border-radius: 1rem;
            outline: none;
            font-size: 1.6rem;
            font-weight: 500;
            border: 1px solid #eee; 
            background-color: #eee;
            transition: .25s linear;
            width: 100%;
            height: 10%;
        }
        .error-signup{
            height: 2rem;
        }
        .signin-heading {
            font-size: 3rem;
            text-align: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .form-submit {
          border-radius: 10px;
          color: white;
          outline: none;
          padding: 1.5rem;
          font-family: 'Poppins', sans-serif;
          font-size: 1.5rem;
          text-align: center;
          cursor: pointer;
          border: 0;
          width: 80%;
          background-color: #ed673a;
          margin-top: 1rem;
      }
      /*.form-password input{
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
      }*/
      form label.error{
    height: 2rem;
    margin-bottom: 2rem;        
}
</style>
<body>
<div id="sigin-background">
     <div class="signin" id="login">
        <a class="signin-icon" onclick="displaySignMenu('none')">
          <i class="fa-solid fa-xmark"></i></a>
        <h2 class="signin-heading">Đăng nhập</h2>
        <p class="signin-already" id="signin-already">
          Bạn chưa có tài khoản?
        </p>
        <div class="error-signin"> <p class="error-message"></p> </div>
        <form id="signin-form" action="../Controllers/Signin-upController.php" method="post" >
          <div class="form-user-name">
          <input type="text" class="form-input" placeholder="Name" id="name" name="username" autocomplete="username">
          </div>
          <div class="form-password">
            <input type="password" class="form-input" placeholder="Password" id="pass" name="password" autocomplete="current-password">
          </div>
          <div>
            <button type="submit" class="form-submit">
              <span class="form-submit-text">Đăng nhập</span>
              <i class="fa fa-long-arrow-right form-submit-icon"></i>
            </button>
          </div>
          <input type="hidden" name="action" value="signin">
        </form>
    </div>    
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js" defer></script>
<script type="text/javascript" src="../js/signin-form.js" defer></script>
<script src="../js/signin-up.js" defer></script>
</body>
</html>

