<?
	require_once("../lib/classe.php");
	$sessao->verifica("codUsuario","login.php");
	
	$diretorio = "../imagens/marcas/";
	
	if($_POST['opcao'] == 'inserir')
	{
		$key = $dbase->pk("marca");
		
		if($nomeImagem = criaImg($diretorio,$key."_logo"))
		{
			$colunas = array("codigo","nome","logo");
			$valores = array($dbase->pk("marca"),$_POST['nome'],$nomeImagem);
			$dbase->insert("marca",$colunas,$valores);
		}
		else 
		{
			$colunas = array("codigo","nome");
			$valores = array($dbase->pk("marca"),$_POST['nome']);
			$dbase->insert("marca",$colunas,$valores);
		}
	}
	elseif($_POST['opcao'] == 'alterar')
	{
		if ($_POST['atualizaLogo'])
		{
			deletaImg($diretorio,$_POST['codigo']."_logo");
			$nomeImagem = criaImg($diretorio,$_POST['codigo']."_logo");
			$colunas = array("nome","logo");
			$valores = array($_POST['nome'],$nomeImagem);
			$dbase->update("marca",$colunas,$valores,"codigo",$_POST['codigo']);
		}
		else 
		{
			$colunas = array("nome");
			$valores = array($_POST['nome']);
			$dbase->update("marca",$colunas,$valores,"codigo",$_POST['codigo']);
		}
	}
	elseif($_POST['opcao'] == 'excluir')
	{
		$dbase->delete("marca","codigo",$_POST['codigo']);
		deletaImg($diretorio,$_POST['codigo']."_logo");
	}
	if($_GET['cod'])
	{
		$sql = "SELECT codigo, nome, logo FROM marca WHERE codigo = '".$_GET['cod']."'";
		$dados = $dbase->select($sql);
	}
?>

<form action="index.php?op=marca" name="form1" method="POST" enctype="multipart/form-data">
	<br />
	<table cellpadding="1" cellspacing="1" width="100%" id="conteudo">
		<tr>
			<td colspan="2" class="titulo">Cadastro de Marcas</td>
		</tr>
		<tr>
			<td width="30%">Marca:</td>
			<td><input type="text" name="nome" id="nome" size="30" class="campo" disabled value="<?=$dados[0]['nome'];?>" /></td>
		</tr>
		<tr>
			<td>Logo:</td>
			<td><input type="file" name="logo" id="logo" size="30" class="campo" disabled /> <input type="checkbox" name="atualizaLogo" id="atualizaLogo" <?=$dados[0]['logo'] && $_POST["opcao"] == "alterar" ? "" : "disabled";?> /><label for="atualizaLogo">Atualizar</label></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="button" name="verLogo" id="verLogo" value="Ver logo" <?=$dados[0]['logo'] ? "" : "disabled";?> class="botao" onclick="javascript: AbrePagina('imagem.php?foto=<?=$dados[0]['logo']."&de=marca";?>')" /></td>
		</tr>
		<tr>
			<td colspan="2" class="mensagens" align="center" height="40">&nbsp;<? include("../lib/mensagens.php")?></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="inserir"  id="inserir"  class="botao"  value="Inserir"  onclick="setStatusInserir();" />
				<input type="button" name="alterar"  id="alterar"  class="botao"  value="Alterar"  onclick="setStatusAlterar();"  <?=$_GET['cod'] ? "" : "disabled" ?>  />
				<input type="button" name="excluir"  id="excluir"  class="botao"  value="Excluir"  onclick="setStatusExcluir();"  <?=$_GET['cod'] ? "" : "disabled" ?>  />
				<input type="button" name="cancelar" id="cancelar" class="botao"  value="Cancelar" onclick="setStatusCancelar();" />
				<input type="button" name="salvar"   id="salvar"   class="botao"  value="Salvar"   onclick="javascript: validaMarca()"  />
				<input type="hidden" name="opcao"    id="opcao"    class="botao"  value=""  />
				<input type="hidden" name="codigo"   id="codigo"   class="botao"  value="<?=$dados[0]['codigo'];?>" />
			</td>
		</tr>
	</table>
	<table width="100%" cellpadding="1" cellspacing="1" id="todos">
		<tr class="titulo">
			<td>Marca</td>
			<td width='20%'>Possui logo</td>
		</tr>
		<?
			$sql = "SELECT codigo, nome, logo FROM marca ORDER BY nome";
			$dados = $dbase->select($sql);
			
			for($i=0;$i<count($dados);$i++)
			{
				echo "<tr onmouseover='this.style.cursor=\"pointer\"; this.style.backgroundColor=\"#FFF9DF\"' onmouseout='this.style.backgroundColor=\"#FFFFFF\"' onclick='location.replace(\"index.php?op=marca&cod=".$dados[$i]['codigo']."\")'>";
				echo "\n\t\t\t<td>".$dados[$i]['nome']."</td>";
				echo $dados[$i]['logo'] ? "\n\t\t\t<td>Sim</td>\n\t\t</tr>" : "\n\t\t\t<td>N&atilde;o</td>\n\t\t</tr>";
			}
		?>
	</table>
	<br />
</form>