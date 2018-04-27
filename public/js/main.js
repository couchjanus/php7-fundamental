// (function(){
    
//     var hamburgerToggle = document.querySelector('#menu-toggle');
    
//     hamburgerToggle.addEventListener('click', function(e){
//         e.preventDefault();
        
//         document.querySelector('.flexmenu').classList.toggle('active');
//     });

// })();

function toggle_panel(panel, background_layer) {
    if (panel.hasClass('show-sidebar')) {
      panel.removeClass('show-sidebar');
      background_layer.removeClass('is-visible');
    } else {
        panel.addClass('show-sidebar');
        background_layer.addClass('is-visible');
    }
  }

  function makeProductItem($template, product){
    $template.find('.product-menu').attr('productId', product["id"]);
    $template.find('.product-name').text(product.name);
    $template.find('img').attr('src', "/media/"+ product.picture);
    $template.find('.product-price').text(product["price"]);
    $template.find('.product-description').text( product["description"]);
    return $template;
  }
  function updateTotal() {
    var quantities = 0,
    total = 0,
    
    $cartTotal = $('.cart-total span'),
    items = $('ul.cart-items').children();

    items.each(function (index, item) {
        var $item = $(item);
        total += parseFloat($item.find('.item-price').text())*
        parseFloat($item.find('.item-quantities').text());
    });

    $cartTotal.text(parseFloat(Math.round(total * 100) / 100).toFixed(2));

    if (total === 0 ){
      
      $('.shopping-cart').fadeOut(500, function() {
              $(this).css({
                  'backgroundColor':'',
                  'borderRadius': '0%',
                  'transform': 'scale(1, 1)'
                  });
          });
    
      $('.shopping-cart').fadeIn(500);        
    }
}

