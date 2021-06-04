jQuery(document).ready(function($) {
    $("#galeria a")
        .fancybox({
            transitionIn: 'elastic',
            transitionOut: 'elastic'
        });
    

    $("#EnviarCotacaoBtn")
        .fancybox({
            'titleShow'       : false,
            'centerOnScroll'  : true
        });

    $("a.btn-indicar")
        .fancybox({
            'titleShow'       : false,
            'centerOnScroll'  : true
        });
    
    $("#search-field").placeHolder('Procurar...');

    $('#featured-banners-slider').nivoSlider();
});

jQuery.fn.extend({ placeHolder: function(value){
  jQuery(this).focus(function(){
    if(jQuery(this).val() == value)
      jQuery(this).val('');
  });
  jQuery(this).blur(function(){
    if(jQuery(this).val() == '')
      jQuery(this).val(value);
  });
}});