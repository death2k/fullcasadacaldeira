$(function(){
	$('a.close').bind('click', function(e) {
        e.preventDefault();
        $(this).parent().slideUp('fast', function() { $(this).remove(); });
    });
});