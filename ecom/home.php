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
   <title>Signature</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      /* Ultra-Premium Luxury Product Card */
      .luxury-product-card {
         position: relative;
         width: 100%;
         background: #ffffff;
         border-radius: 16px;
         overflow: hidden;
         box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
         transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
         margin: 0 auto;
         border: 1px solid rgba(0, 0, 0, 0.03);
         height: 100%;
      }

      .luxury-product-card:hover {
         transform: translateY(-8px);
         box-shadow: 0 25px 60px rgba(0, 0, 0, 0.12);
      }

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
         transition: all 0.6s ease;
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
         transition: all 0.3s ease;
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

      .luxury-wishlist:hover, .luxury-quickview:hover {
         background: #000;
         color: #fff;
         transform: scale(1.1);
      }

      .luxury-details {
         padding: 20px;
      }

      .luxury-name {
         font-size: 16px;
         font-weight: 600;
         color: #333;
         margin-bottom: 12px;
         line-height: 1.4;
      }

      .luxury-price-container {
         display: flex;
         align-items: center;
         gap: 10px;
         margin-bottom: 10px;
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
         transition: all 0.2s ease;
      }

      .luxury-qty-btn:hover {
         background: #eee;
         color: #000;
      }

      .luxury-qty-input {
         width: 40px;
         height: 40px;
         border: none;
         border-left: 1px solid #eee;
         border-right: 1px solid #eee;
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
         text-transform: uppercase;
         letter-spacing: 0.5px;
      }

      .luxury-cart-btn:hover {
         background: linear-gradient(45deg, #1a2a3a, #3a919f);
         transform: translateY(-2px);
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      /* Swiper adjustments */
      .products-slider .swiper-slide {
         height: auto;
         padding: 10px;
         box-sizing: border-box;
      }

      .home-products {
         padding: 30px 0;
      }
   </style>
</head>
<body>
<?php include 'components/user_header.php'; ?>
<marquee><h1 class="heading">Free Delivery</h1></marquee>

<section class="home">
   <?php include 'components/banner.php'; ?>
</section>

<section class="home-products">
   <marquee><h1 class="heading">latest products</h1></marquee>

   <div class="swiper products-slider">
      <div class="swiper-wrapper">
         <?php
         $select_products = $conn->prepare("SELECT * FROM products LIMIT 6"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         ?>
         <div class="swiper-slide">
            <form action="" method="post" class="luxury-product-card">
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
         </div>
         <?php
            }
         }else{
            echo '<div class="swiper-slide"><p class="empty">no products added yet!</p></div>';
         }
         ?>
      </div>
      <div class="swiper-pagination"></div>
   </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

<script>
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

var swiper = new Swiper(".products-slider", {
   loop: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
   breakpoints: {
      0: {
         slidesPerView: 1,
      },
      576: {
         slidesPerView: 2,
      },
      992: {
         slidesPerView: 3,
      }
   }
});
</script>
</body>
</html>