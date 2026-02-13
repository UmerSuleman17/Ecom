<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/jpg" href="project images/IMG_3949.jpg">
   <title>Signature Contact </title>

   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="contact">
<!-- 
   <form action="" method="post">
      <h3>get in touch</h3>
      <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
      <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
      <input type="number" name="number" min="0" max="9999999999" placeholder="enter your number" required onkeypress="if(this.value.length == 10) return false;" class="box">
      <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form> -->
<form action="" method="post" class="contact-form">
  <h3 class="form-title">Get In Touch</h3>
  
  <div class="form-group">
    <input type="text" name="name" placeholder="Enter your name" required maxlength="20" class="form-box">
  </div>
  
  <div class="form-group">
    <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="form-box">
  </div>
  
  <div class="form-group">
    <input type="number" name="number" min="0" max="9999999999" placeholder="Enter your phone number" required 
           onkeypress="if(this.value.length == 10) return false;" class="form-box">
  </div>
  
  <div class="form-group">
    <textarea name="msg" class="form-box" placeholder="Enter your message" cols="30" rows="5"></textarea>
  </div>
  
  <div class="form-group">
    <input type="submit" value="Send Message" name="send" class="submit-btn">
  </div>
</form>

<style>
  .contact-form {
    max-width: 600px;
    margin: 0 auto;
    padding: 30px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
  }
  
  .form-title {
    text-align: center;
    color: #333;
    margin-bottom: 25px;
    font-size: 24px;
    text-transform: capitalize;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-box {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: all 0.3s;
  }
  
  .form-box:focus {
    border-color: #4CAF50;
    outline: none;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
  }
  
  textarea.form-box {
    min-height: 120px;
    resize: vertical;
  }
  
  .submit-btn {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .submit-btn:hover {
    background-color: #45a049;
  }
</style>
</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>