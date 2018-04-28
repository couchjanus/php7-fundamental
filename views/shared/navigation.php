<nav class="navbar">
      <nav class="wrapper">
        <div class="logo"><img src="/images/logo.png"></div><!-- Logo -->
        <input type="checkbox" id="menu-toggle" />
        <label for="menu-toggle" class="label-toggle"></label>
        <ul class="flexmenu">
          <li><a href="/">Home</a></li>
          <li><a href="/about" id="catalog">About</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/guest">Guest Book</a></li>
          <li><a href="/contact">Contact</a></li>
          <li><a href="#" id="cart-trigger"><i class="fas fa-shopping-cart shopping-cart shoppingcart"></i>&nbsp;Cart</a></li>
          <li><a href="#"><label for="toggle-user" class="animate"><i class="fas fa-user"></i></label></a></li>
        </ul>
      </nav>
</nav>
<dropdown>
  <input id="toggle-user" type="checkbox">
  <ul class="animate">
    <?php if (User::isGuest()) :?>
      <li class="animate"><a href="/register">SignUp<i class="fa fa-user-plus float-right"></i></a></li>
      <li class="animate"><a href="/login">LogIn<i class="fa fa-sign-in float-right"></i></a></li>
    <?php else :?>
      <li class="animate"><a href="/logout">LogOut<i class="fa fa-sign-out float-right"></i></a></li>
    <?php endif;?>
  </ul>
</dropdown>