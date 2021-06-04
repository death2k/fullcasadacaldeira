	/**
	 * insere uma mascara ao input de acordo com formato informado
	 * campo -> variavel representando o element como objeto DOM
	 * mask -> variavel string com o formato de mascara desejado
	 * e -> propriedade event do navegado
	 * *** uso ***
	 *
	 *<input type="text" name="nome" id="id" onkeypress="javascript: mascara(this, '##/##/####', event)" />
	 */
	 
	function mascara(campo, mask, e)
	{
		campo.maxLength=mask.length;
		
		var src=campo.value.length;
		var mask=mask.substr(src,1);
		
		if(window.event)
		{
			if(e.keyCode!=13 && (e.keyCode>47 && e.keyCode<58))
			{
				if(mask!='#' && src>=0)
				{	
					campo.value+=mask;
				}
			}
			else
			{
				e.keyCode=0;
			}
		}
		else
		{
			if(e.which!=13 && (e.which>47 && e.which<58))
			{
				if(mask!='#' && src>=0)
				{	
					campo.value+=mask;
				}
			}
			else if((e.which>64 && e.which<91) || (e.which>96 && e.which<123))
			{
				e.preventDefault();
			}
		}
	}