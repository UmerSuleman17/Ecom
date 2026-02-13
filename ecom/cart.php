<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>
     <link rel="icon" type="image/jpg" href="project images/IMG_3949.jpg">
   <title>Signature about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<br>
<br>
<br>
<section class="products shopping-cart">

   <h3 class="heading">shopping cart</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
   ?>
   <!-- <form action="" method="post" class="box">
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
      <div class="name"><?= $fetch_cart['name']; ?></div>
      <div class="flex">
         <div class="price">$<?= $fetch_cart['price']; ?>/-</div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
         <button type="submit" class="fas fa-edit" name="update_qty"></button>
      </div>
      <div class="sub-total"> sub total : <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
      <input type="submit" value="delete item" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
   </form> -->
   <form action="" method="post" class="cart-item">
  <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
  
  <div class="cart-item-header">
    <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="quick-view-btn">
      <i class="fas fa-eye"></i>
    </a>
    <button type="submit" value="delete item" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
      <i class="fas fa-trash"></i>
    </button>
  </div>
  
  <div class="cart-item-body">
    <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="<?= $fetch_cart['name']; ?>" class="product-image">
    
    <div class="product-info">
      <h3 class="product-name"><?= $fetch_cart['name']; ?></h3>
      
      <div class="price-row">
        <span class="price">$<?= $fetch_cart['price']; ?></span>
        
        <div class="quantity-control">
          <input type="number" name="qty" class="quantity-input" 
                 min="1" max="99" 
                 value="<?= $fetch_cart['quantity']; ?>"
                 onkeypress="if(this.value.length == 2) return false;">
          <button type="submit" class="update-btn" name="update_qty">
            <i class="fas fa-sync-alt"></i>
          </button>
        </div>
      </div>
      
      <div class="subtotal">
        Subtotal: <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span>
      </div>
    </div>
  </div>
</form>
<style>
   /* ===== Mobile-First Cart Styles ===== */
   
.cart-item {
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  padding: 12px;
  margin-bottom: 12px;
  border: 1px solid #eee;
}

/* Header with action buttons */
.cart-item-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
}

.quick-view-btn, 
.delete-btn {
  background: none;
  border: none;
  color: #666;
  font-size: 13px;
  padding: 4px;
}

/* Mobile-optimized item layout */
.cart-item-body {
  display: flex;
  flex-direction: column; /* Stack vertically on mobile */
  gap: 10px;
}

.product-image {
  width: 100%;
  height: auto;
  max-height: 140px;
  object-fit: contain;
  border-radius: 6px;
  border: 1px solid #f0f0f0;
  align-self: center; /* Center image */
}

.product-info {
  width: 100%;
}

.product-name {
  font-size: 14px;
  font-weight: 600;
  color: #333;
  margin-bottom: 6px;
  text-align: center; /* Center text on mobile */
}

/* Price and quantity row */
.price-row {
  display: flex;
  flex-direction: column; /* Stack vertically */
  gap: 8px;
  margin-bottom: 8px;
}

.price {
  font-size: 15px;
  font-weight: 700;
  color: #222;
  text-align: center;
}

.quantity-control {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
}

.quantity-input {
  width: 50px;
  padding: 6px;
  border: 1px solid #ddd;
  border-radius: 4px;
  text-align: center;
  font-size: 14px;
}

.update-btn {
  background: #f8f8f8;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 6px 10px;
  font-size: 12px;
}

.subtotal {
  font-size: 14px;
  text-align: center;
  margin-top: 8px;
}

.subtotal span {
  font-weight: 700;
}

/* Tablet and larger screens */
@media (min-width: 480px) {
  .cart-item-body {
    flex-direction: row; /* Side-by-side on larger screens */
    align-items: center;
  }
  
  .product-image {
    width: 80px;
    height: 80px;
    align-self: flex-start;
  }
  
  .product-name,
  .price {
    text-align: left;
  }
  
  .price-row {
    flex-direction: row;
    justify-content: space-between;
  }
}

/* Small mobile tweaks */
@media (max-width: 360px) {
  .quantity-input {
    width: 40px;
    padding: 5px;
  }
  
  .update-btn {
    padding: 5px 8px;
  }
}
</style>
   <?php
   $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>grand total :</p>$<?= $grand_total; ?>/-
      
      <a href="shop.php" class="option-btn">continue shopping</a>
      <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all item</a>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>