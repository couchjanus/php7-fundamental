<!-- Footer Area Start -->
<footer id="footer">
</footer>
<!-- Footer Area Stop -->

<div id="shadow-layer" class="shadow-layer"></div>

<script id="cartItem" type="text/template">
    <li>
        <span class="productInCart"></span>
        <span class="qty">
            <span class="item-quantities"></span>
        </span>
        <span class="item-name"></span>
        <span class="item-price"></span>
        <span class="item-prices"></span>
        <a class="item-remove" href="#0"><i class="fas fa-times"></i></a>
    </li>
</script>


<template id="productItem">

        <article class="grid-item">
          <div class="product-wrapper">    
            <div class="product">
              <p class="product-name">Very&nbsp;Big&nbsp;Cat</p>
              <div class="icon">
                <div class="icon-background"></div>
                  <span class="shopping-cart">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                  </span>
                </div>
                <div class="product-picture">
                  <img src="" alt="Nice Cat" />
                </div>
                <span class="product-description"></span>
                <div class="product-menu"  productId='1'>
                  <div class="product-price">
                    9.99
                  </div>
                  <div class="buy-now">
                    Buy now!
                  </div>
                  <div class="product-detail">
                    Detail
                  </div>
              
                  <div class="how-many">
                    <div class="quantity-input">
                      <input class="minus btn" type="button" value="-">
                      <input class="input-text quantity text" value="1" size="4">
                      <input class="plus btn" type="button" value="+">
                    </div>
                  </div>
                  <div class="cancel">
                    Cancel
                  </div>
                  <div class="add-to-cart">
                    Add to Cart!
                  </div>
                </div>
            </div>
            <div class="product-back">
                <span class="check">
                  <i class="fas fa-check fa-4x"></i>
                  <p>Success!</p>
                </span>
              </div>   
          </div> 
          
        </article> 
      </template>
<template id="productDetail">

<figure class="item">
    <h4 class="product-name">Cool Cat</h4>
    <div class="image">
        <img class="slide" src=""/>
        <img class="slide" src="images/cat2.jpg" style="display:none;" />
        <img class="slide" src="images/cat3.jpg" style="display:none;" />
        <img class="slide" src="images/cat4.jpg" style="display:none;" />
    </div>
    
    <div class="rating">
            <button class="prev">&#10094;&#10094;</button>
            <button class="next">&#10095;&#10095;</button>
        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
    </div>
    <figcaption productId="">
        <p class="product-description">
            I'm just very selective about the reality I choose to accept.
        </p>
        <div class="price">
            <s class="old-price">$24.00</s><b class="product-price">$19.00</b>
        </div>
    </figcaption>
    <a href="#" class="add-to-cart">Add to Cart</a>
</figure>
              

</template>
<div class="mega-menu">
        <div class="mega-menu-top">
            <div class="mega-search">
                <label for="mega-search">Search</label>
                <input type="search" id="mega-search" placeholder="Search" />
            </div>
            <div class="close">
                <span>&#10006;</span> 
            </div>
        </div>
        <h3>Catalog</h3>
        <ul class="nav themes">
            <li><a href="#"> Mice</a></li>
            <li><a href="#"> Cats</a></li>
            <li><a href="#"> Dogs</a></li>
            <li><a href="#"> Rabbits</a></li>
            <li><a href="#"> Crocodiles</a></li>
            <li><a href="#"> Chicks</a></li>
            <li><a href="#"> Dinosaurs</a></li>
            <li><a href="#"> Skunks</a></li>
            <li><a href="#"> Rats</a></li>
            <li><a href="#"> Crows</a></li>
        </ul>
        <footer>
            <div class="logo-footer">  
              <img src="images/logo.png">
            </div>
            <ul class="nav footer">
                <li>Contact Us</li>
                <li>About Us</li>
                <li>Privacy Policy</li>
            </ul>
        </footer>
    </div>

