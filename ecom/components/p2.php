<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/jpg" href="project images/IMG_3949.jpg">
   <title>Signature </title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   
<?php include 'components/user_header.php'; ?>
 <marquee>  <h1 class="heading">Free Delivery</h1></marquee>


<section class="home">
<?php include 'components/banner.php'; ?>
</section>

</div>


<section class="home-products">

 <marquee>  <h1 class="heading">latest products</h1></marquee>

  <div class="swiper products-slider">
   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="luxury-product-card">
  <!-- Hidden inputs for backend processing -->
  <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
  <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
  <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
  <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
  
  <div class="luxury-badge">LIMITED EDITION</div>
  
  <div class="luxury-image-container">
    <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="<?= $fetch_product['name']; ?>" class="luxury-product-image">
    <div class="luxury-image-hover">
      <button type="submit" name="add_to_wishlist" class="luxury-wishlist"><i class="fas fa-heart"></i></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="luxury-quickview"><i class="fas fa-expand"></i></a>
    </div>
  </div>
  
  <div class="luxury-details">
    <h3 class="luxury-name"><?= $fetch_product['name']; ?></h3>
    
    <div class="luxury-price-container">
      <span class="luxury-price">$<?= $fetch_product['price']; ?></span>
    </div>
    
    <div class="luxury-controls">
      <div class="luxury-qty-selector">
        <button type="button" class="luxury-qty-btn minus">-</button>
        <input type="number" name="qty" class="luxury-qty-input" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
        <button type="button" class="luxury-qty-btn plus">+</button>
      </div>
      <button type="submit" name="add_to_cart" class="luxury-cart-btn">
        <i class="fas fa-shopping-bag"></i>
        <span>ADD TO CART</span>
      </button>
    </div>
  </div>
</form>

<!-- Mobile Navigation (for multiple cards) -->
<!-- <div class="luxury-mobile-nav" style="display: none;">
  <button class="luxury-nav-btn prev-btn"><i class="fas fa-chevron-left"></i></button>
  <div class="luxury-page-indicator">1/1</div>
  <button class="luxury-nav-btn next-btn"><i class="fas fa-chevron-right"></i></button>
</div> -->

<script>
// Quantity Selector Functionality
document.querySelectorAll('.luxury-qty-btn').forEach(button => {
  button.addEventListener('click', function() {
    const input = this.parentNode.querySelector('.luxury-qty-input');
    if(this.classList.contains('minus') && input.value > 1) {
      input.value = parseInt(input.value) - 1;
    } else if(this.classList.contains('plus') && input.value < 99) {
      input.value = parseInt(input.value) + 1;
    }
  });
});


// Mobile Navigation (only activates if multiple cards exist)
document.addEventListener('DOMContentLoaded', function() {
  const cards = document.querySelectorAll('.luxury-product-card');
  const mobileNav = document.querySelector('.luxury-mobile-nav');
  
  if (cards.length > 1) {
    mobileNav.style.display = 'flex';
    const container = cards[0].parentNode;
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const pageIndicator = document.querySelector('.luxury-page-indicator');
    
    let currentIndex = 0;
    pageIndicator.textContent = `${currentIndex + 1}/${cards.length}`;
    
    // Button navigation
    prevBtn.addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
        updateCardPosition();
      }
    });
    
    nextBtn.addEventListener('click', () => {
      if (currentIndex < cards.length - 1) {
        currentIndex++;
        updateCardPosition();
      }
    });
    
    function updateCardPosition() {
      container.scrollTo({
        left: cards[currentIndex].offsetLeft - (container.offsetWidth - cards[currentIndex].offsetWidth) / 2,
        behavior: 'smooth'
      });
      pageIndicator.textContent = `${currentIndex + 1}/${cards.length}`;
    }
  }
});
</script>

<style>
  
/* Base Styles */
.luxury-product-card {
  position: relative;
  width: 100%;
  max-width: 300px;
  background: #ffffff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  margin: 0 auto;
  border: 1px solid rgba(0, 0, 0, 0.03);
}

/* Mobile Single Card View */
@media (max-width: 767px) {
  .luxury-products-container {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: smooth;
    gap: 0;
    padding: 0;
  }
  
  .luxury-product-card {
    min-width: 85%;
    margin: 20px 7.5%;
    scroll-snap-align: center;
    flex: 0 0 auto;
  }
  
  .luxury-mobile-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    padding: 15px 0;
  }
}

/* Desktop Grid View */
@media (min-width: 768px) {
  .luxury-products-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
  }
  
  .luxury-mobile-nav {
    display: none;
  }
}

/* Card Elements */
.luxury-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: linear-gradient(45deg, #d4af37, #f1e5ac);
  color: #2a2a2a;
  padding: 6px 15px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  z-index: 3;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.luxury-image-container {
  position: relative;
  width: 100%;
  height: 220px;
  overflow: hidden;
}

.luxury-product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.luxury-image-hover {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3);
  opacity: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  transition: opacity 0.3s ease;
}

.luxury-product-card:hover .luxury-image-hover {
  opacity: 1;
}

.luxury-wishlist, .luxury-quickview {
  width: 45px;
  height: 45px;
  background: rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
  color: #333;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 16px;
}

.luxury-details {
  padding: 20px;
}

.luxury-name {
  font-size: 16px;
  font-weight: 600;
  color: #333;
  margin-bottom: 12px;
}

.luxury-price {
  font-size: 20px;
  font-weight: 700;
  color: #d4af37;
}

.luxury-controls {
  display: flex;
  gap: 10px;
  margin-top: 20px;
}

.luxury-qty-selector {
  display: flex;
  border: 1px solid #eee;
  border-radius: 8px;
  overflow: hidden;
}

.luxury-qty-btn {
  width: 35px;
  height: 40px;
  background: #f9f9f9;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 14px;
  color: #555;
}

.luxury-qty-input {
  width: 40px;
  height: 40px;
  border: none;
  text-align: center;
  font-size: 14px;
  -moz-appearance: textfield;
}

.luxury-qty-input::-webkit-outer-spin-button,
.luxury-qty-input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.luxury-cart-btn {
  flex: 1;
  background: linear-gradient(45deg, #2c3e50, #4ca1af);
  color: white;
  border: none;
  border-radius: 8px;
  padding: 0 15px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: all 0.3s ease;
}

.luxury-nav-btn {
  background: transparent;
  border: none;
  color: #d4af37;
  font-size: 18px;
  cursor: pointer;
  padding: 5px 15px;
}

.luxury-page-indicator {
  font-size: 14px;
  color: #555;
}
</style>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
   </div>
</div>


   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      // 1024: {
      //   slidesPerView: 5,
      // },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>



