/*
function valida()
{
   if (document.form1.adm_login.value.length < 6)
   {
	  alert("Por favor preencha o campo Login com o mínimo de 6 caractéres.");
	  document.form1.adm_login.focus();
	  return false;
   }

   if (document.form1.opcao.value == "inserir")
   {
   		if (document.form1.adm_senha.value.length < 6)
   		{
	  		alert("Por favor preencha o campo Senha com o mínimo de 6 caractéres.");
	  		document.form1.adm_senha.focus();
	  		return false;
   		}

    	if (document.form1.adm_confirmasenha.value != document.form1.adm_senha.value)
   		{
	  		alert("Você não confirmou a senha corretamente, digite-a novamente.");
	  		document.form1.adm_confirmasenha.focus();
	  		return false;
   		}
   }
   else if (document.form1.opcao.value == "alterar")
   {
       
	   if (document.form1.adm_senha.value != "")
       {
          if (document.form1.adm_senha.value.length < 6)
          {
		      alert("Por favor preencha o campo Senha com o mínimo de 6 caractéres.");
	          document.form1.adm_senha.focus();
	          return false;
   		  }

		  if (document.form1.adm_senha.value != document.form1.adm_confirmasenha.value)
          {
              alert("Você não confirmou a senha corretamente, digite-a novamente.");
              document.form1.adm_confirmasenha.select();
              return false;
          }
      }
   }
   
   document.form1.submit();
}
*/
function valida()
{
    	document.form1.submit();
}

function validaAdm()
{
	ref = document.forms['form1'];
	if(ref.opcao.value != ref.excluir.name)
	{
		var campos = new Array("login","senha","confirma");
		var nomes = new Array("Login","Senha","Confirmar Senha");
		var tipos = new Array(9,9,10);
		var status = new Array(1,1,1);

		if (valida_form('form1',campos,nomes,tipos,status))
    		document.forms['form1'].submit();
	} 
	else 
	{
    	document.forms['form1'].submit();
	}
}

function validaMarca()
{
	ref = document.forms['form1'];
	if(ref.opcao.value != ref.excluir.name)
	{
		var campos = new Array("nome","");
		var nomes = new Array("Marca","");
		var tipos = new Array(8,8);
		var status = new Array(1,0);

		if (valida_form('form1',campos,nomes,tipos,status))
    		document.forms['form1'].submit();
	} 
	else 
	{
    	document.forms['form1'].submit();
	}
}

function validaGrupo()
{
	ref = document.forms['form1'];
	if(ref.opcao.value != ref.excluir.name)
	{
		var campos = new Array("nome","");
		var nomes = new Array("Grupo","");
		var tipos = new Array(8,8);
		var status = new Array(1,0);

		if (valida_form('form1',campos,nomes,tipos,status))
    		document.forms['form1'].submit();
	} 
	else 
	{
    	document.forms['form1'].submit();
	}
}