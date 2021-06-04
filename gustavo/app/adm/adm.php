<?
	require_once("../lib/classe.php");
	$sessao->verifica("codUsuario","login.php");	

	if($_POST['opcao'] == 'inserir')
	{
		$dbase->autoInsert("adm",$_POST,"confirma|opcao");
	}
	elseif($_POST['opcao'] == 'alterar')
	{
		$dbase->autoInsert("adm",$_POST,"confirma|opcao");
	}
	elseif($_POST['opcao'] == 'excluir')
	{
		$dbase->delete("adm","codigo",$_POST['codigo']);
	}
	if($_GET['cod'])
	{
		$sql = "SELECT codigo, login, senha, nivel FROM adm WHERE codigo = '".$_GET['cod']."'";
		$dados = $dbase->select($sql);
	}
?>

<form action="index.php?op=adm" name="form1" method="POST">
	<br />
	<table cellpadding="1" cellspacing="1" width="100%" id="conteudo">
		<tr>
			<td colspan="2" class="titulo">Cadastro de Administradores</td>
		</tr>
		<tr>
			<td width="30%">Login:</td>
			<td><input type="text" name="login" id="login" size="30" class="campo" disabled value="<?=$dados[0]['login'];?>" /> (mín. 6 caracteres)</td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td><input type="password" name="senha" id="senha" size="30" class="campo" disabled value="<?=$dados[0]['senha'];?>" /> (mín. 6 caracteres)</td>
		</tr>
		<tr>
			<td>Confirmar Senha:</td>
			<td><input type="password" name="confirma" id="confirma" size="30" class="campo" disabled value="<?=$dados[0]['senha'];?>" /></td>
		</tr>
		<tr>
			<td>Nível:</td>
			<td>
				<input type="radio" name="nivel" id="adm" value="adm" disabled checked /><label for="adm">Adm</label>
				<input type="radio" name="nivel" id="usr" value="usr" disabled <?=$dados[0]['nivel'] == "usr" ? "checked" : "";?>/><label for="usr">Usr</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="mensagens" align="center" height="40">&nbsp;<? include("../lib/mensagens.php")?></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="inserir"  id="inserir"  class="botao"  value="Inserir"  onclick="setStatusInserir(); limpa()" />
				<input type="button" name="alterar"  id="alterar"  class="botao"  value="Alterar"  onclick="setStatusAlterar();"  <?=$_GET['cod'] ? "" : "disabled" ?>  />
				<input type="button" name="excluir"  id="excluir"  class="botao"  value="Excluir"  onclick="setStatusExcluir();"  <?=$_GET['cod'] ? "" : "disabled" ?>  />
				<input type="button" name="cancelar" id="cancelar" class="botao"  value="Cancelar" onclick="setStatusCancelar(); limpa()"   />
				<input type="button" name="salvar"   id="salvar"   class="botao"  value="Salvar"   onclick="javascript: validaAdm()"  />
				<input type="hidden" name="opcao"    id="opcao"    class="botao"  value=""  />
				<input type="hidden" name="codigo"   id="codigo"   class="botao"  value="<?=$dados[0]['codigo'];?>" />
			</td>
		</tr>
	</table>
	<table width="100%" cellpadding="1" cellspacing="1" id="todos">
		<tr class="titulo">
			<td>Login</td>
			<td>Nivel</td>
		</tr>
		<?
			$sql = "SELECT codigo, login, nivel FROM adm WHERE codigo <> 1";
			$dados = $dbase->select($sql);
			
			for($i=0;$i<count($dados);$i++)
			{
				echo "<tr onmouseover='this.style.cursor=\"pointer\"; this.style.backgroundColor=\"#FFF9DF\"' onmouseout='this.style.backgroundColor=\"#FFFFFF\"' onclick='location.replace(\"index.php?op=adm&cod=".$dados[$i]['codigo']."\")'>";
				echo "\n\t\t\t<td>".$dados[$i]['login']."</td>";
				echo $dados[$i]['nivel'] == "adm" ? "\n\t\t\t<td>Adm</td>\n\t\t</tr>" : "\n\t\t\t<td>Usr</td>\n\t\t</tr>";
			}
		?>
	</table>
	<br />
</form>