function ajaxRequest()
{
	ajax = false;
	if(window.XMLHttpRequest) // Mozilla, Safari...
	{
		ajax = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) // IE
	{
		try
		{
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				alert("Este navegador não suporta AJAX.");
			}
		}
	}
}

function dados(valor, origem, destino)
{
	ajaxRequest();
	if(ajax)
	{
		var campo =	document.getElementById(destino);
			campo.options.length = 1;
		var	opcao = campo.options[0];
		
		ajax.open("POST", "ajax.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		ajax.onreadystatechange = function() //enquanto estiver processando...emite a msg de carregando
		{
			if(ajax.readyState == 1)
			{
				opcao.text = "Carregando...";  
			}  //após ser processado - chama função processXML que vai varrer os dados
			if(ajax.readyState == 4 )
			{
				if(ajax.responseXML)
				{
					processXML(ajax.responseXML, origem, destino, opcao);
				}
				else   //caso não seja um arquivo XML emite a mensagem abaixo
				{
					opcao.text = "Escolha uma "+origem;
				}
			}
		}  //passa o código do grupo escolhido

		var param = "codigo="+valor+"&origem="+origem;
		ajax.send(param);
	}
}

function processXML(obj, origem, destino, opcao)
{
	//pega a tag subgrupo
	var dataArray   = obj.getElementsByTagName("registro");
	//total de elementos contidos na tag subgrupo

	if(dataArray.length > 0)
	{    //percorre o arquivo XML paara extrair os dados
		for(var i = 0 ; i < dataArray.length ; i++)
		{
			var items = dataArray[i];
			//contéudo dos campos no arquivo XML
			var codigo    =  items.getElementsByTagName("codigo")[0].firstChild.nodeValue;
			var descricao =  items.getElementsByTagName("descricao")[0].firstChild.nodeValue;

			opcao.text = "--Selecione--";

			//cria um novo option dinamicamente  
			var novo = document.createElement("option");
			//atribui um ID a esse elemento
			novo.setAttribute("id", "opcoes");
			//atribui um valor
			novo.value = codigo;
			//atribui um texto
			novo.text  = descricao;
			//finalmente adiciona o novo elemento
			var combo = 'document.forms[0].'+destino+'.options.add(novo)';
			eval(combo);
		}
	}
	else
	{
		//caso o XML volte vazio, printa a mensagem abaixo
		opcao.text = "Escolha "+origem+" antes...";
	}	
}