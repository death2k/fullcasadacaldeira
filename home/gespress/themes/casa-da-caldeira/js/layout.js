$(document).ready(function() {

	vex.defaultOptions.className = 'vex-theme-os';

	$("#contato-form").submit(function(e){
    	e.preventDefault();
    	var erros = [];
    	ajaxSubmit($(this), erros);
    });

	$('.fa.fa-navicon').click(function(){
        $('.menu').slideToggle();
        if($(this).hasClass('active')){
        	$('.three-line i.fa').addClass('fa-navicon');
        	$('.three-line i.fa').removeClass('fa-remove');
        	$(this).removeClass('active');
        }else{
        	$('.three-line i.fa').removeClass('fa-navicon');
        	$('.three-line i.fa').addClass('fa-remove');
        	$(this).addClass('active');
        }
    });

	$(window).load(function(){
		$(window).scroll(function(){
			checkScroll();
		});
	});

	checkScroll();


	$(" .menu-footer-mobile li a").click(function(e){
		var div = "#"+$(this).data('id');
		$('html, body').animate({scrollTop: $(div).offset().top - 80}, 1000);
	});


});


function ajaxSubmit(jForm, erros, args){
    args = args || {};
    if (erros.length > 0) {
        var _mensagem = "";
        $(erros).each(function(idx, item) {
            _mensagem += item.msg + '<br/>\n';
        });
		if($(window).width() > 767) erros[0].obj.focus();
        alerta(_mensagem);
    } else {
        $.ajax({
            url: jForm.attr('action'),
            data: jForm.serialize(),
            type: jForm.attr('method'),
            dataType: "json",
            beforeSend: function() {
                $('input:submit').attr('disabled', 'disabled');
               jForm.find("button[type=submit]").html("<i class='fa fa-spinner fa-pulse'></i>");
            },
            error:function(data){
                if(args.error != null)args.error(data.responseText);
            },
            complete: function(data) {
				console.log(data);
                $('input:submit').removeAttr('disabled');
                jForm.find("button[type=submit]").html("ENVIAR");
                jForm.trigger('reset');
                if(args.complete != null){
					args.complete(data.responseJSON.mensagem);
					if(data.responseJSON.mensagem != null && data.responseJSON.status == "error"){
						alerta(data.responseJSON.mensagem);
					}
                }else{
                   alerta(data.responseJSON.mensagem);
				}
            }
        });

    }

}
