// valida numero inteiros ou não
function valida_numero(numero,inteiro) {
	numero = new String(numero);
	
	if(numero.length==0)
		return false;
		
	var exp = /^\$|\./g ;

	// retira $ e .
	numero = numero.replace(exp, "");
	
	exp = /,/g ;
	
	// troca , por .
	numero = numero.replace(exp,".");

	numero = parseFloat(numero);
	
	if(isNaN(numero))
		return false;

	if(inteiro && numero!=Math.round(numero))
		return false;
		
	return true;

}

// verifica se um ano é bissexto
function ano_bi(ano) {
	if (ano % 100 == 0) {
		if (ano % 400 == 0) 
			return true; 
	}
	else 
		if ((ano % 4) == 0) 
			return true; 
	return false;
}


// Valida uma data
function valida_data(data) {

	var datePat = /^(\d{1,2})(\/|-|.)(\d{1,2})\2(\d{4})$/;

	var datadiv = data.match(datePat);
   	if (datadiv==null)
		return false;
	
	var dia = datadiv[1];
	var mes = datadiv[3];
	var ano = datadiv[4];

	if(dia<1 || dia>31 || mes<1 || mes>12)// || ano < 2001)
		return false;

	if ((mes==4 || mes==6 || mes==9 || mes==11) && dia>30) 
		return false;
	
	if(mes==2)
		if(dia>29)
			return false;
		else
			if(dia==29 && !ano_bi(ano))
				return false;

	return true;

}

// valida CEP
function valida_cep(cep) {
	if(cep.length>9 || (cep.indexOf("-")==-1 && cep.length>8))
		return false;
	
	var pat = /((\d{5})(-)(\d{3}))|(\d{8})/;
	
	var cepdiv = cep.match(pat);
	
	if(cepdiv==null)
		return false;
	return true;
}


// Calculo do CNPJ 
function valida_cnpj(cnpj) {
	var erro = true; 
	var aux_cnpj = "";	
	var cnpj1=0,cnpj2=0;

	// retirar caracteres não numéricos
	for(j=0;j<cnpj.length;j++)
		if(cnpj.substr(j,1)>="0" && cnpj.substr(j,1)<="9")
			aux_cnpj += cnpj.substr(j,1);
	
	if(aux_cnpj.length!=14)
		erro = false;
	else {
		cnpj1 = aux_cnpj.substr(0,12);
		cnpj2 = aux_cnpj.substr(aux_cnpj.length-2,2);
		fator = "543298765432";
		controle = "";
		for(j=0;j<2;j++) {
			soma = 0;
			for(i=0;i<12;i++) 
				soma += cnpj1.substr(i,1) * fator.substr(i,1);
			if(j==1) soma += digito * 2;
			digito = (soma * 10) % 11;
			if(digito==10) digito = 0;
			controle += digito;
			fator = "654329876543";
		} 
		if(controle!=cnpj2)
			erro = false;
	} 
	return erro;
}

// Validação do CPF
function valida_cpf(cpf) {
	var cpf = new String(cpf);
    var aux_cpf = "";

	// retirar caracteres não numéricos
	for(j=0;j<cpf.length;j++)
  		if(cpf.substr(j,1)>="0" && cpf.substr(j,1)<="9")
   			aux_cpf += cpf.substr(j,1);

	if(aux_cpf.length!=11)
		return false;
    else {
    	var cpf1 = String(aux_cpf);
    	var cpf2 = cpf.substr(cpf.length-2,2);
      	var controle = "";
      	var start = 2;
      	var end = 10;
      	for(var i=1;i<=2;i++) {
      		var soma = 0;
      		for(j=start;j<=end;j++)
      			soma += cpf1.substr((j-i-1),1)*(end+1+i-j);
        	if(i==2)
          		soma += digito * 2;
        	digito = (soma * 10) % 11;
        	if(digito==10)
          		digito = 0;
        	controle += digito;
        	start = 3;
        	end = 11;
      	}
      	if(controle!=cpf2)
        	return false;
    }
	
	return true;
}


// Esta é uma função simples para validar emails
function valida_email(email) {
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (filter.test(email))
		return true;
	else return false;
}


/*
function valida_email(email) {
	var chars = "@#$&[]()/\\\{}!^:'\"";
	var pat=/^(.+)@(.+)$/;
	
	var emaildiv = email.match(pat);
	
	if(emaildiv==null)
		return false;
		
	var login = emaildiv[1];
	var dominio = emaildiv[2];
	
	for(var i=0;i<chars.length;i++) {
		if(login.indexOf(chars.substr(i,1))!=-1)
			return false;
	}
	
	for(var i=0;i<chars.length;i++) {
		if(dominio.indexOf(chars.substr(i,1))!=-1)
			return false;
	}
	
	return true;
}
*/

// Valida uma string em particular (tipo login ou senha)
function valida_string(string,nrochars) {
	str = new String(string);
	if(str.length<nrochars)
		return false;
	if(str.indexOf(" ")!=-1)
		return false;

	var chars = "@#$&[]()/\\\{}!^:'\"";

	for(var i=0;i<chars.length;i++) {
		if(str.indexOf(chars.substr(i,1))!=-1) {
			return false;
		}
	}
		
	return true;

}

// Valida o numero do Cartão de crédito
function valida_cartao(numero) {
	var str = new String(numero);

	if(str.length==0)
		return false;

	var peso = (str.length%2==0) ? 2 : 1;
	var soma = 0;
	
	for(var i=0;i<str.length;i++) {
		num = str.substr(i,1);
		vlr = num*peso;
		soma+= (vlr>9) ? vlr-9 : vlr;
		peso = (peso==2) ? 1 : 2;
	}

	return (soma%10==0 && soma!=0);
}

// Valida a Data de validade do cartão (mm/aa)
function valida_dtvalidade(data) {
	var datePat = /^(\d{1,2})(\/|-|.)(\d{1,2})$/;
	var dtdiv = data.match(datePat);
	
	if(dtdiv==null)
		return false;
	
	var dia = 31;
	var mes = parseInt(dtdiv[1]);
	var ano = parseInt(dtdiv[3]);
	
	if(mes<1 || mes>12 || ano<01)
		return false;
	
	var data = new Date();
	var mes_at = data.getMonth();
	var ano_at = data.getYear();
	mes_at++;
	ano+=2000; 
	
	var anomes = ano*100+mes;
	var anomes_at = ano_at*100+mes_at;
	
	if(anomes<anomes_at)
		return false;
	
	return true;		
}

function retira_car(numero) {

	var exp = /^\$|\./g ;

	numero = numero.replace(exp, "");
	
	return numero;

}

function valida_form(formulario,campos,nomescampos,tipos,status) {
	/*
	form = Nome do formulário
	campos = nome campos a verificar (cli_codigo,cli_nome,...)
	nomescampos = nome campos a verificar (Código,Nome,...)
	tipos = tipo de cada campo:
			 	1-inteiro
				2-decimal
				3-data
				4-email
				5-cpf
				6-cnpj
				7-cep
				8-string
				9-login/senha
				10-confirmação de senha 
				11-Cartão de Crédito
				12-Validade do Cartão (mes/ano)
				13-Campo select
	status = 0 - não obrigatório, 1 - obrigatório
	*/

	var erro = false;
	var mensagem = "Foram encontrados alguns erros na validação das informações, conforme descrito abaixo:\n\n";
	var erromsg = "";
	
	for(var i=0;i<campos.length;i++) {
		resultado=true;
		
		// Localiza o campo dentro do array elements
		// Isso é feito porque o array elements tem propriedades que o objeto não,
		// principamente, no caso de objetos do tipos Selecto-One, Select-Multiple, Option ou CheckBox
		form = eval("document." + formulario);
		for (var n=0;n<form.elements.length;n++) {
//			if (form.elements[n].name == "cli_situacao") 
//				alert("Valor: " + form.elements[n].value);
												
			if (form.elements[n].name == campos[i]) {
					var campo = form.elements[n];
					n = form.elements.length;
			}
		}
		// atribui o valor do elemento
		valor = campo.value;
		erromsg = "";
		switch(tipos[i]) {
		case 1:
			resultado = valida_numero(valor,true);
			campo.value = retira_car(valor);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com um número inteiro";
			break;
		case 2:
			resultado = valida_numero(valor,false);
			campo.value = retira_car(valor);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com um número decimal";
			break;
		case 3:
			resultado = valida_data(valor);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com uma data válida";
			break;
		case 4:
			resultado = valida_email(valor);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com um e-mail válido";
			break;
		case 5:
			resultado = valida_cpf(valor);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com um CPF válido";
			break;
		case 6:
			resultado = valida_cnpj(valor);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com um CNPJ válido";
			break;
		case 7:
			resultado = valida_cep(valor);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com um CEP válido";
			break;
		case 8: // CAMPO TEXTO
//			alert("Status: " + status[i] + "\nTamanho: " + valor.length);
			if (status[i]==1 && valor.length==0)
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido";
			break;
		case 9: // CAMPO SENHA / LOGIN
			resultado = valida_string(valor,6);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com caracteres válidos";
			break;
		case 10: // CAMPO CONFIRMAÇÃO DE SENHA
			resultado = valida_string(valor,6);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
			{
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com caracteres válidos";
			} else {
				if ((resultado) && !(valor == eval("document." + formulario + "." + campos[i-1] + ".value")))
					erromsg="O Campo " + nomescampos[i] + " deve ser preenchido igualmente à senha";
			}
			break;
		case 11:
			resultado = valida_cartao(valor,6);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com um cartão de crédito válido";
			break;
		case 12:
			resultado = valida_dtvalidade(valor);
			if (((status[i]==1) && ((valor.length==0) || !resultado)) || ((status[i]==0) && ((valor.length!=0) && !resultado)))
				erromsg="O Campo " + nomescampos[i] + " deve ser preenchido com uma data de validade válida";
			break;
		case 13:
			if(valor=="")
				erromsg = "O Campo " + nomescampos[i] + " deve ser selecionado";
			break;
/*		case 14:
			doc = document.forms[0];
			for(j=0; j < campos.length; j++)
			{
				if(doc.elements[campos[j]].type == undefined)
				{
					var qtd = doc.elements[campos[j]].length;
					var x = 0;
					
					for(k=0; k < qtd; k++)
					{
						if(doc.elements[campos[j]][k].checked == false)
						{
							x++;
						}
					}
					if(x == qtd)
					{
						erromsg = "O Campo "+ nomescampos[i] + " deve ser selecionado";
					}
				}
			}
			break;*/
		}
		if(erromsg != "") {
			mensagem+= "- " + erromsg + "\n";
			erro = true;
		}
	}

	if(erro)
		alert(mensagem)
		
	return !erro;
}