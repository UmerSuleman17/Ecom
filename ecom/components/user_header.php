<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

   <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="bg-light py-3 text-center">
   <h5 class="mb-0">Welcome to our store</h5>
</div>
<style type="text/css">
   .navbar a {
      text-decoration: none;
   }
    .icons a {
      text-decoration: none;
   }
   /* Navbar Links Hover Effect */
.navbar a {
  position: relative;
  text-decoration: none;
  color: #333;
  font-weight: 500;
  margin: 0 12px;
  transition: color 0.3s ease;
}

.navbar a::after {
  content: '';
  position: absolute;
  width: 0;
  height: 2px;
  background: #4CAF50;
  left: 0;
  bottom: -5px;
  transition: 0.3s;
}

.navbar a:hover {
  color: #4CAF50;
}

/*.navbar a:hover::after {
  width: 100%;*/
}

/* Icons Styling */
.icons i {
  font-size: 18px;
  margin: 0 8px;
  color: #333;
  transition: transform 0.3s, color 0.3s;
}

.icons a:hover i {
  transform: scale(1.2);
  color: #4CAF50;
}

/* Cart/Wishlist Counts Styling */
.icons span {
  font-size: 12px;
  background-color: #dc3545;
  color: white;
  border-radius: 12px;
  padding: 2px 6px;
  margin-left: 4px;
}

/* Profile Box Styling */
.profile {
  background: #fff;
  border: 1px solid #ccc;
  padding: 15px;
  margin-top: 15px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  display: none;
  position: absolute;
  top: 100%;
  right: 20px;
  z-index: 999;
  width: 220px;
}

.profile p {
  font-weight: 600;
  margin-bottom: 10px;
}

/* Buttons Styling */
.btn, .option-btn, .delete-btn {
  display: inline-block;
  padding: 8px 16px;
  border-radius: 5px;
  margin: 4px 2px;
  text-decoration: none;
  color: white;
  background-color: #4CAF50;
  transition: background-color 0.3s ease;
}

.option-btn {
  background-color: #007BFF;
}

.delete-btn {
  background-color: #DC3545;
}

.btn:hover, .option-btn:hover, .delete-btn:hover {
  opacity: 0.9;
}/* Default: Show all icons (desktop) */
.fa-heart, .fa-shopping-cart, .fa-user,
a[href="wishlist.php"], a[href="cart.php"], #user-btn,
#menu-btn, .fa-search, a[href="search_page.php"] {
  display: inline-block;
  font-size: 1.5rem; /* Default size for desktop */
}

/* Mobile view (≤768px) */
@media (max-width: 768px) {
  /* HIDE wishlist & user icon on mobile */
  .fa-heart, .fa-user,
  a[href="wishlist.php"], #user-btn {
    display: none;
  }

  /* SHOW only Search, Cart, and Menu (in this order) */
  a[href="search_page.php"], /* Search */
  a[href="cart.php"],        /* Cart */
  #menu-btn {               /* Menu Bars */
    display: inline-block;
    font-size: 1.7rem;      /* Same size */
    margin: 0 8px;          /* Equal spacing */
  }
}
/* Default: Show all icons EXCEPT menu bars (desktop/iPad) */
.fa-heart, .fa-shopping-cart, .fa-user,
a[href="wishlist.php"], a[href="cart.php"], #user-btn,
.fa-search, a[href="search_page.php"] {
  display: inline-block;
  font-size: 1.5rem; /* Desktop size */
}

/* Hide menu bars by default (shown only on mobile) */
#menu-btn, .fa-bars {
  display: none;
}

/* Mobile view (≤768px) */
@media (max-width: 768px) {
  /* Hide wishlist & user icon */
  .fa-heart, .fa-user,
  a[href="wishlist.php"], #user-btn {
    display: none;
  }

  /* Show only Search, Cart, Menu Bars (bigger size) */
  a[href="search_page.php"], /* Search */
  a[href="cart.php"],        /* Cart */
  #menu-btn {               /* Menu Bars */
    display: inline-block;
    font-size: 1.5rem;
    margin: 0 10px;
  }
}
</style>


<header class="header">

   <section class="flex">
    <a href="home.php">
     <a href="home.php">
   
 <img src="images/IMG_3948.jpg" 
     alt="Logo" 
     style="width: 120px; height: 60px; border-radius: 16px; transition: transform 0.3s ease;" 
     onmouseover="this.style.transform='scale(1.1)'" 
     onmouseout="this.style.transform='scale(1)'">

  
</a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="orders.php">Orders</a>
         <a href="shop.php">Shop</a>
         <a href="contact.php">Contact</a>
      </nav>
      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
 <!-- Default order (desktop doesn't need reordering) -->
<a href="search_page.php"><i class="fas fa-search"></i></a>
<a href="wishlist.php"><i class="fa-regular fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
<a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
<div id="menu-btn" class="fas fa-bars"></div>
<div id="user-btn" class="fa-regular fa-user"></div>
      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>
<script>
document.getElementById("user-btn").addEventListener("click", function () {
  const profileBox = document.querySelector(".profile");
  profileBox.style.display = profileBox.style.display === "block" ? "none" : "block";
});
</script>

</header>