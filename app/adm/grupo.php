<?
	require_once("../lib/classe.php");
	$sessao->verifica("codUsuario","login.php");

	if($_POST['opcao'] == 'inserir')
	{
		$dbase->autoInsert("grupo",$_POST,"opcao");
	}
	elseif($_POST['opcao'] == 'alterar')
	{
		$dbase->autoInsert("grupo",$_POST,"opcao");
	}
	elseif($_POST['opcao'] == 'excluir')
	{
		$dbase->delete("grupo","codigo",$_POST['codigo']);
	}
	if($_GET['cod'])
	{
		$sql = "SELECT codigo, nome, marca FROM grupo WHERE codigo = '".$_GET['cod']."'";
		$dados = $dbase->select($sql);
	}
?>

<form action="index.php?op=grupo" name="form1" method="POST">
	<br />
	<table cellpadding="1" cellspacing="1" width="100%" id="conteudo">
		<tr>
			<td colspan="2" class="titulo">Cadastro de Grupos</td>
		</tr>
		<tr>
			<td width="30%">Grupo:</td>
			<td><input type="text" name="nome" id="nome" size="30" class="campo" disabled value="<?=$dados[0]['nome'];?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="mensagens" align="center" height="40">&nbsp;<? include("../lib/mensagens.php")?></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="inserir"  id="inserir"  class="botao"  value="Inserir"  onclick="setStatusInserir();" />
				<input type="button" name="alterar"  id="alterar"  class="botao"  value="Alterar"  onclick="setStatusAlterar();"  <?=$_GET['cod'] ? "" : "disabled" ?>  />
				<input type="button" name="excluir"  id="excluir"  class="botao"  value="Excluir"  onclick="setStatusExcluir();"  <?=$_GET['cod'] ? "" : "disabled" ?>  />
				<input type="button" name="cancelar" id="cancelar" class="botao"  value="Cancelar" onclick="setStatusCancelar();"   />
				<input type="button" name="salvar"   id="salvar"   class="botao"  value="Salvar"   onclick="javascript: validaGrupo()"  />
				<input type="hidden" name="opcao"    id="opcao"    class="botao"  value=""  />
				<input type="hidden" name="codigo"   id="codigo"   class="botao"  value="<?=$dados[0]['codigo'];?>" />
			</td>
		</tr>
	</table>
	<table width="100%" cellpadding="1" cellspacing="1" id="todos">
		<tr class="titulo">
			<td>Grupo</td>
		</tr>
		<?
			$sql = "SELECT codigo, nome FROM grupo ";
			$sql.= "ORDER BY nome";
			$dados = $dbase->select($sql);
			
			for($i=0;$i<count($dados);$i++)
			{
				echo "<tr onmouseover='this.style.cursor=\"pointer\"; this.style.backgroundColor=\"#FFF9DF\"' onmouseout='this.style.backgroundColor=\"#FFFFFF\"' onclick='location.replace(\"index.php?op=grupo&cod=".$dados[$i]['codigo']."\")'>";
				echo "\n\t\t\t<td>".$dados[$i]['nome']."</td>";
			}
		?>
	</table>
	<br />
</form>