<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'order placed successfully!';
   }else{
      $message[] = 'your cart is empty';
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
   <title>Signature Check out</title>

   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>your orders</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>(<?= '$'.$fetch_cart['price'].'/- x '. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">grand total : <span>$<?= $grand_total; ?>/-</span></div>
      </div>
<!-- 
      <h3>place your orders</h3>

      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" placeholder="enter your name" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" placeholder="enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <!-- <option value="paytm">paytm</option> -->
               <!-- <option value="paypal">easypaisa or jazzcash</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="flat" placeholder="e.g. flat number" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>address line 02 :</span>
            <input type="text" name="street" placeholder="e.g. street name" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" placeholder="e.g. Hyderabad" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" placeholder="e.g. Sindh" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" placeholder="e.g. Pakistan" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">

   <!-- </form> --> 

  <form action="" method="post" class="order-form">
    <h5 class="form-title">PLACE YOUR ORDER</h5>
    
    <div class="form-grid">
      <!-- Personal Info -->
      <div class="input-group">
        <label>Your Name</label>
        <input type="text" name="name" placeholder="Enter your name" maxlength="20" required>
      </div>
      
      <div class="input-group">
        <label>Your Number</label>
        <input type="number" name="number" placeholder="Enter your number" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
      </div>
      
      <div class="input-group">
        <label>Your Email</label>
        <input type="email" name="email" placeholder="Enter your email" maxlength="50" required>
      </div>
      
      <!-- Payment -->
      <div class="input-group">
        <label>Payment Method</label>
        <select name="method" required>
          <option value="cash on delivery">Cash on Delivery</option>
          <option value="credit card">Credit Card</option>
    <option value="paypal"><a href="online.php">easypaisa/jazzcash</a></option>
        </select>
      </div>
      
      <!-- Address -->
      <div class="input-group">
        <label>Address Line 01</label>
        <input type="text" name="flat" placeholder="Flat/Building number" maxlength="50" required>
      </div>
      
      <div class="input-group">
        <label>Address Line 02</label>
        <input type="text" name="street" placeholder="Street/Area name" maxlength="50" required>
      </div>
      
      <div class="input-group">
        <label>City</label>
        <input type="text" name="city" placeholder="e.g. Hyderabad" maxlength="50" required>
      </div>
      
      <div class="input-group">
        <label>State</label>
        <input type="text" name="state" placeholder="e.g. Sindh" maxlength="50" required>
      </div>
      
      <div class="input-group">
        <label>Country</label>
        <input type="text" name="country" placeholder="e.g. Pakistan" maxlength="50" required>
      </div>
      
      <div class="input-group">
        <label>PIN Code</label>
        <input type="number" name="pin_code" placeholder="e.g. 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" required>
      </div>
    </div>
           <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">
 
    </button>
  </form>
</div>
<style>
   /* ===== Luxury Order Form ===== */
   /* ===== Order Container ===== */
.order-container {
  max-width: 800px;
  margin: 30px auto;
  padding: 0 15px;
  font-family: 'Helvetica Neue', Arial, sans-serif;
}

/* ===== Order Header ===== */
.order-header {
  font-size: 1.8rem;
  font-weight: 500;
  color: #222;
  text-align: center;
  margin-bottom: 25px;
  letter-spacing: 0.5px;
  position: relative;
  padding-bottom: 10px;
}

.order-header::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 2px;
  background: #222;
}

/* ===== Order Summary ===== */
.order-summary {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 3px 15px rgba(0,0,0,0.05);
  padding: 20px;
  margin-bottom: 30px;
  border: 1px solid #eee;
}

.order-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 0;
  border-bottom: 1px solid #f5f5f5;
}

.order-item span:first-child {
  font-size: 1rem;
  color: #333;
}

.order-item span:last-child {
  font-size: 0.95rem;
  color: #666;
}

/* ===== Grand Total ===== */
.grand-total {
  text-align: right;
  padding-top: 15px;
  font-size: 1.2rem;
}

.grand-total strong {
  color: #222;
  font-weight: 600;
}

/* ===== Responsive Adjustments ===== */
@media (max-width: 768px) {
  .order-header {
    font-size: 1.5rem;
  }
  
  .order-summary {
    padding: 15px;
  }
}

@media (max-width: 480px) {
  .order-header {
    font-size: 1.3rem;
  }
  
  .order-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 5px;
  }
  
  .grand-total {
    text-align: left;
    padding-top: 10px;
  }
}
.order-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  font-family: 'Helvetica Neue', Arial, sans-serif;
}

.order-header {
  font-size: 1.8rem;
  color: #222;
  text-align: center;
  margin-bottom: 30px;
  font-weight: 500;
  letter-spacing: 1px;
}

.order-summary {
  background: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
  margin-bottom: 30px;
  border: 1px solid #eee;
}

.order-item {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px solid #eee;
  font-size: 1rem;
}

.grand-total {
  text-align: right;
  padding-top: 15px;
  font-size: 1.2rem;
}

.form-title {
  font-size: 1.3rem;
  text-align: center;
  margin-bottom: 25px;
  color: #333;
  font-weight: 500;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.input-group {
  margin-bottom: 15px;
}

.input-group label {
  display: block;
  margin-bottom: 8px;
  font-size: 0.9rem;
  color: #555;
  font-weight: 500;
}

.input-group input,
.input-group select {
  width: 100%;
  padding: 12px 15px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 0.95rem;
  transition: all 0.3s;
}

.input-group input:focus,
.input-group select:focus {
  outline: none;
  border-color: #999;
  box-shadow: 0 0 0 2px rgba(0,0,0,0.05);
}

.order-btn {
  width: 100%;
  padding: 15px;
  background: #000;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 1rem;
  font-weight: 600;
  letter-spacing: 1px;
  cursor: pointer;
  transition: all 0.3s;
  text-transform: uppercase;
}

.order-btn:hover {
  background: #333;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .form-grid {
    grid-template-columns: 1fr;
  }
  
  .order-header {
    font-size: 1.5rem;
  }
  
  .order-summary {
    padding: 15px;
  }
}

@media (max-width: 480px) {
  .order-container {
    padding: 15px;
  }
  
  .order-btn {
    padding: 12px;
    font-size: 0.9rem;
  }
}
</style>
</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>