<?php
     $select_products = $conn->prepare("SELECT * FROM `products`"); 
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
</script>
  <style>
      /* Ultra-Premium Luxury Product Card */
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

.luxury-category {
  font-size: 12px;
  color: #888;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 5px;
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

.luxury-original-price {
  font-size: 14px;
  color: #aaa;
  text-decoration: line-through;
}

.luxury-rating {
  display: flex;
  align-items: center;
  gap: 5px;
  margin-bottom: 15px;
}

.luxury-rating i {
  color: #ffc107;
  font-size: 14px;
}

.luxury-rating span {
  font-size: 12px;
  color: #888;
  margin-left: 5px;
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
   </style>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>

</section>








