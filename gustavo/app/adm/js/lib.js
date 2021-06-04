function get(id)
{
	return document.getElementById(id);
}
function setStatusInserir()
{
	ref = document.forms[0];
	for (var i = 0; i < ref.elements.length; i++) 
	{
    	if((ref.elements[i].type != 'button') && (ref.elements[i].type != 'hidden'))
	   	 	ref.elements[i].disabled = false;
			
       	if((ref.elements[i].type == 'text') || (ref.elements[i].type == 'textarea'))
	   		ref.elements[i].value = "";
			
    	if(ref.elements[i].type == 'select-one')
			if(ref.elements[i].length > 0)
	   			ref.elements[i].options[0].selected  = true;
				
		if(ref.elements[i].type == "checkbox")
			ref.elements[i].disabled = true;
    }
	//setando os botes
	if (document.getElementById('inserir')) 
		ref.inserir.disabled = true;
	if (document.getElementById('alterar')) 
		ref.alterar.disabled = true;
	if (document.getElementById('excluir')) 
		ref.excluir.disabled = true;
	if (document.getElementById('cancelar')) 
		ref.cancelar.disabled = false;
	if (document.getElementById('salvar')) 
		ref.salvar.disabled = false;
	/*setando a variavel hiden com a opo de novo
	pego o nome da variavel para garantir um valor
	sem caracteres maiusculos ou invalidos*/
	ref.opcao.value = ref.inserir.name;
	//aqui estou fazendo o layer com a mensagem aparecer
	getElement("menInserir").style.display = 'block';
	getElement("menAlterar").style.display = 'none';
	getElement("menExcluir").style.display = 'none';	
	getElement("codigo").value = "";
	
}
function setStatusAlterar()
{
	ref = document.forms[0];
	for (var i = 0; i < ref.elements.length; i++) 
	{
    	if((ref.elements[i].type != 'button') && (ref.elements[i].type != 'hidden'))
	   	 	ref.elements[i].disabled = false;
	}
	//ref.elements[0].focus();
	//setando os botes
	if (document.getElementById('inserir')) 
		ref.inserir.disabled = true;
	if (document.getElementById('alterar')) 
		ref.alterar.disabled = true;
	if (document.getElementById('excluir')) 
		ref.excluir.disabled = true;
	if (document.getElementById('cancelar')) 
		ref.cancelar.disabled = false;
	if (document.getElementById('salvar')) 
		ref.salvar.disabled = false;
	/*setando a variavel hiden com a opo de alterar
	pego o nome da variavel para garantir um valor
	sem caracteres maiusculos ou invalidos*/
	ref.opcao.value = ref.alterar.name;
	
	//aqui estou fazendo o layer com a mensagem aparecer
	getElement("menInserir").style.display = 'none';
	getElement("menAlterar").style.display = 'block';
	getElement("menExcluir").style.display = 'none';	
	
}

function setStatusExcluir()
{
	ref = document.forms[0];
	//setando os botes
	if (document.getElementById('inserir')) 
		ref.inserir.disabled = true;
	if (document.getElementById('alterar')) 
		ref.alterar.disabled = true;
	if (document.getElementById('excluir')) 
		ref.excluir.disabled = true;
	if (document.getElementById('cancelar')) 
		ref.cancelar.disabled = false;
	if (document.getElementById('salvar')) 
		ref.salvar.disabled = false;
	/*setando a variavel hiden com a opo de excluir
	pego o nome da variavel para garantir um valor
	sem caracteres maiusculos ou invalidos*/
	ref.opcao.value = ref.excluir.name;
  	//aqui estou fazendo o layer com a mensagem aparecer
	getElement("menInserir").style.display = 'none';
	getElement("menAlterar").style.display = 'none';
	getElement("menExcluir").style.display = 'block';	
	
}
function setStatusCancelar()
{
	ref = document.forms[0];
	for (var i = 0; i < ref.elements.length; i++) 
	{
		if((ref.elements[i].type == 'text') || (ref.elements[i].type == 'textarea'))
	   		ref.elements[i].value = "";

    	if((ref.elements[i].type != 'button') && (ref.elements[i].type != 'hidden'))
	   	 	ref.elements[i].disabled = true;
						
    	if(ref.elements[i].type == 'select-one') 
	   		ref.elements[i].options[0].selected  = true;
    }
	
	//setando os botes
	if (document.getElementById('inserir')) 
		ref.inserir.disabled = false;
	if (document.getElementById('alterar')) 
		ref.alterar.disabled = true;
	if (document.getElementById('excluir')) 
		ref.excluir.disabled = true;
	if (document.getElementById('cancelar')) 
		ref.cancelar.disabled = true;
	if (document.getElementById('salvar')) 
			ref.salvar.disabled = true;

	/*setando a variavel hiden com a opo de novo
	pego o nome da variavel para garantir um valor
	sem caracteres maiusculos ou invalidos*/
	ref.opcao.value = "";
	//aqui estou fazendo o layer com a mensagem aparecer
	getElement("menInserir").style.display = 'none';
	getElement("menAlterar").style.display = 'none';
	getElement("menExcluir").style.display = 'none';	
}
//função para gerenciar as tabelas de mensagens
function getElement(e,f){
    if(document.layers){
        f=(f)?f:self;
        if(f.document.layers[e]) {
            return f.document.layers[e];
        }
        for(W=0;i<f.document.layers.length;W++) {
            return(getElement(e,fdocument.layers[W]));
        }
    }
    if(document.all) {
        return document.all[e];
    }
    return document.getElementById(e);
}

function hiddenMens(){
	getElement("menInserir").style.display = 'none';
	getElement("menAlterar").style.display = 'none';
	getElement("menExcluir").style.display = 'none';	
}