<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'incorrect username or password!';
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
   <title>Signature login</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <!-- <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" class="btn" name="submit">
      <p>don't have an account?</p>
      <a href="user_register.php" class="option-btn">register now</a>
   </form> -->
<div class="login-container">
  <div class="login-card">
    <div class="brand-header">
      <div class="logo-shine"></div>
      <h1 class="welcome-text">Welcome to <span>Signature Wear</span></h1>
      <p class="tagline">Where style meets sophistication</p>
    </div>

    <form action="" method="post" class="auth-form">
      <h2 class="form-title">ACCESS YOUR ACCOUNT</h2>
      
      <div class="input-group gold-border">
        <input type="email" name="email" required class="form-input" oninput="this.value = this.value.replace(/\s/g, '')">
        <label class="input-label">EMAIL ADDRESS</label>
        <div class="input-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
        </div>
      </div>
      
      <div class="input-group gold-border">
        <input type="password" name="pass" required class="form-input" oninput="this.value = this.value.replace(/\s/g, '')">
        <label class="input-label">PASSWORD</label>
        <div class="input-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
        </div>
      </div>
      
      <button type="submit" class="login-btn" name="submit">
        <span>LOGIN</span>
        <div class="arrow-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>
      </button>
      
      <div class="form-footer">
        <p>New to Signatre Ware? </p> <br><a href="user_register.php" class="register-link">CREATE ACCOUNT</a>
       <br>
        <a href="#" class="forgot-link">Forgot password?</a>
      </div>
    </form>
  </div>
</div>
<style>/* ===== Luxury Login Form ===== */
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(135deg, #f5f5f5 0%, #fafafa 100%);
  padding: 2rem;
}

.login-card {
  width: 100%;
  max-width: 420px;
  background: white;
  border-radius: 16px;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
  overflow: hidden;
  position: relative;
}

.login-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #d4af37, #f9d423, #d4af37);
  background-size: 200% 200%;
  animation: gradientShift 3s ease infinite;
}

@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.brand-header {
  padding: 2.5rem 2rem 1.5rem;
  text-align: center;
  position: relative;
}

.logo-shine {
  width: 60px;
  height: 60px;
  margin: 0 auto 1rem;
  background: Black;
  border-radius: 50%;
  box-shadow: 0 4px 20px rgba(212, 175, 55, 0.3);
}

.welcome-text {
  font-size: 1.8rem;
  font-weight: 300;
  letter-spacing: 1px;
  color: #222;
  margin-bottom: 0.5rem;
}

.welcome-text span {
  font-weight: 700;
  background: Black;
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.tagline {
  font-size: 0.9rem;
  color: #888;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.auth-form {
  padding: 0 2rem 2.5rem;
}

.form-title {
  font-size: 0.9rem;
  color: #888;
  text-transform: uppercase;
  letter-spacing: 2px;
  text-align: center;
  margin-bottom: 2rem;
}

.input-group {
  position: relative;
  margin-bottom: 1.8rem;
}

.gold-border {
  border: 1px solid #eee;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.gold-border:hover {
  border-color: #d4af37;
}

.form-input {
  width: 100%;
  padding: 1.2rem 1rem 1rem 3rem;
  border: none;
  background: transparent;
  font-size: 0.95rem;
  color: #333;
}

.form-input:focus {
  outline: none;
}

.input-label {
  position: absolute;
  top: 1.2rem;
  left: 3rem;
  color: #999;
  font-size: 0.95rem;
  pointer-events: none;
  transition: all 0.3s ease;
}

.form-input:focus + .input-label,
.form-input:not(:placeholder-shown) + .input-label {
  top: 0.6rem;
  left: 3rem;
  font-size: 0.7rem;
  color: #d4af37;
}

.input-icon {
  position: absolute;
  left: 1rem;
  top: 50%;
  transform: translateY(-50%);
  color: #999;
}

.gold-border:hover .input-icon {
  color: #d4af37;
}

.login-btn {
  width: 100%;
  padding: 1.2rem;
  background: Black;
  color: white;
  border: white;
  border-radius: 8px;
  font-weight: 600;
  font-size: 1rem;
  letter-spacing: 1px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  margin-top: 1.5rem;
}

.login-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
}

.arrow-icon {
  transition: transform 0.3s ease;
}

.login-btn:hover .arrow-icon {
  transform: translateX(3px);
}

.form-footer {
  text-align: center;
  margin-top: 2rem;
  font-size: 0.9rem;
  color: #888;
}

.register-link {
  color: #d4af37;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.register-link:hover {
  text-decoration: underline;
}

.forgot-link {
  display: block;
  margin-top: 0.8rem;
  color: #999;
  text-decoration: none;
  transition: all 0.3s ease;
}

.forgot-link:hover {
  color: #d4af37;
}</style>
</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>