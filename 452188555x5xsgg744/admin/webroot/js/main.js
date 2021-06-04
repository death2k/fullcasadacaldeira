$(function(){
    $(".mask-money").maskMoney({
        symbol: 'R$ ',
        showSymbol: true,
        thousands: '.',
        decimal: ',',
    });
    
    $('a.close').bind('click', function(e) {
        e.preventDefault();
        $(this).parent().slideUp('fast', function() { $(this).remove(); });
    });

    $('.topbar').dropdown();

    $('tbody tr')
        .filter(':has(:checkbox:checked)')
        .addClass('selected')
        .end()
        .click(function(event) {
            $(this).toggleClass('selected');
            if (event.target.type !== 'checkbox') {
                $(':checkbox', this).attr('checked', function() {
                    return !this.checked;
                });
            }
        })
        .find('a')
        .click(function(event) {
            event.stopPropagation();
        });

    $('thead tr :checkbox')
        .attr('checked', false)
        .change(function(event) {
            var $checkboxToggle = $(this);

            $(this).closest('table').find('tbody :checkbox').each(function() {
                if($checkboxToggle.attr('checked') == 'checked') {
                    console.log($(this));
                    $(this).parent().parent().addClass('selected');
                    $(this).attr('checked', 'checked');
                } else {
                    $(this).parent().parent().removeClass('selected');
                    $(this).attr('checked', false);
                }
            });
        });
    
    $("a.fancybox").fancybox({
        'transitionIn'  : 'elastic',
        'transitionOut' : 'elastic',
    });
    
    $(".gerenciarImagens")
        .fancybox({
            'width'         : 1015,
            'height'        : 550,
            'autoScale'     : false,
            'autoDimensions': true,
            'centerOnScroll': true,
            'transitionIn'  : 'none',
            'transitionOut' : 'none',
            'type'          : 'iframe'
        });
    
    $("#ImagemIndexForm")
        .submit(function() {
            $('.addBtn', this).hide();
            $('.loader-spinner', this).show();
        });
});