

<?php
    session_start();

    if(!empty($_POST["send"])) {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $captcha = $_POST["captcha"];
      $captchaUser = filter_var($_POST["captcha"], FILTER_SANITIZE_STRING);
      if(empty($captcha)) {
        $captchaError = array(
          "status" => "alert-danger",
          "message" => "Please enter the captcha."
        );
      }
      else if($_SESSION['CAPTCHA_CODE'] == $captchaUser){
        $captchaError = array(
          "status" => "alert-success",
          "message" => "Your form has been submitted successfuly."
        );
      } else {
        $captchaError = array(
          "status" => "alert-danger",
          "message" => "Captcha is invalid."
        );
      }
    }
?>




<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>PHP Contact Form with Captcha</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container mt-5">
    <!-- <?php include('contact_form.php'); ?> -->
    <!-- Captcha error message -->
    <?php if(!empty($captchaError)) {?>
      <div class="form-group col-12 text-center">
        <div class="alert text-center <?php echo $captchaError['status']; ?>">
          <?php echo $captchaError['message']; ?>
        </div>
      </div>
    <?php }?>
    <!-- Contact form -->
    <form action="store.php" name="contactForm" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" id="email">
      </div>
      <div class="row">
        <div class="form-group col-6">
          <label>Enter Captcha</label>
          <input type="text" class="form-control" name="captcha" id="captcha">
        </div>
        <div class="form-group col-6">
          <label>Captcha Code</label>
          <img src="capcha.php" alt="PHP Captcha">
        </div>
      </div>
      <input type="submit" name="send" value="Send" class="btn btn-dark btn-block">
    </form>
  </div>
</body>
</html>


<?php unset($_SESSION['captcha']);?>
