<?
	require_once("../lib/classe.php");
	$sessao->verifica("codUsuario","login.php");
	set_time_limit(0);
	
	function criaFoto($diretorio,$img,$tam,$flag)
	{
		if(is_uploaded_file($_FILES["logo"]["tmp_name"]))
		{
			$erro = tipoImg($_FILES["logo"]["type"]);
						
			if(is_array($erro))
			{
				$imagem_up = str_replace("'","",$_FILES["logo"]['name']);
				$imagem = $imagem_up;
				$copy = copy($_FILES["logo"]['tmp_name'],$diretorio.$imagem_up);
				$erro["func"];
				$imagem_orig = $erro["func"]($diretorio.$imagem);
				
				for($i=0;$i<count($tam);$i++)
				{
					$max_w = $tam[$i][0];
					$max_h = $tam[$i][1];
					$w = imagesx($imagem_orig);
					$h = imagesy($imagem_orig);
					$scala = min($max_w/$w,$max_h/$h);
			
					$largura = floor($scala*$w); 
					$altura = floor($scala*$h); 
					
					$imagem_gerada = $img.$flag[$i].".".$erro["ext"];
					$imagem_fin = imagecreatetruecolor($largura, $altura);
					imagecopyresampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura, $altura, $w, $h);
					imagejpeg($imagem_fin, $diretorio.$imagem_gerada);
					imagedestroy($imagem_fin);
				}
			}
			imagedestroy($imagem_orig);
			unlink($diretorio.$imagem_up);
			return $imagem_gerada;
		}
	}
	
	function deletaFoto($diretorio,$img,$flag)
	{
		$ext = array(".jpg",".gif",".png");
		for ($i=0;$i<count($ext);$i++)
		{
			for ($j=0;$j<count($flag);$j++)
			{
				if (file_exists($diretorio.$img.$flag[$j].$ext[$i]) && is_file($diretorio.$img.$flag[$j].$ext[$i]))
				{
					unlink($diretorio.$img.$flag[$j].$ext[$i]);
				}
			}
		}
	}

	$diretorio = "../imagens/produtos/";
	$tam = array(array(100,75),array(250,187));
	$flag = array("_p","_g");
	
	if($_POST['opcao'] == 'inserir')
	{
		$key = $dbase->pk("produto");
		
		if($nomeImagem = criaFoto($diretorio,$key."_produto",$tam,$flag))
		{
			$colunas = array("codigo","marca","grupo","nome","descricao","foto");
			$valores = array($dbase->pk("produto"),$_POST['marca'],$_POST['grupo'],$_POST['nome'],addslashes($_POST['descricao']),$nomeImagem);
			$dbase->insert("produto", $colunas, $valores);
		}
		else 
		{
			$colunas = array("codigo","marca","grupo","nome","descricao");
			$valores = array($dbase->pk("produto"),$_POST['marca'],$_POST['grupo'],$_POST['nome'],addslashes($_POST['descricao']));
			$dbase->insert("produto", $colunas, $valores);
		}
	}
	elseif($_POST['opcao'] == 'alterar')
	{
		if ($_POST['atualizaFoto'])
		{
			deletaFoto($diretorio,$_POST['codigo']."_produto",$flag);
			$nomeImagem = criaFoto($diretorio,$_POST['codigo']."_produto",$tam,$flag);
			$colunas = array("marca","grupo","nome","descricao","foto");
			$valores = array($_POST['marca'],$_POST['grupo'],$_POST['nome'],addslashes($_POST['descricao']),$nomeImagem);
			$dbase->update("produto",$colunas,$valores,"codigo",$_POST['codigo']);
		}
		else 
		{
			$colunas = array("marca","grupo","nome","descricao");
			$valores = array($_POST['marca'],$_POST['grupo'],$_POST['nome'],addslashes($_POST['descricao']));
			$dbase->update("produto",$colunas,$valores,"codigo",$_POST['codigo']);
		}
	}
	elseif($_POST['opcao'] == 'excluir')
	{
		$dbase->delete("produto","codigo",$_POST['codigo']);
		deletaFoto($diretorio,$_POST['codigo']."_produto",$flag);
	}
	if($_GET['cod'])
	{
		$sql = "SELECT codigo, marca, grupo, nome, descricao, foto FROM produto WHERE codigo = '".$_GET['cod']."'";
		$dados = $dbase->select($sql);
	}
	
?>

<form action="index.php?op=produto" name="form1" method="POST" enctype="multipart/form-data">
	<br />
	<table cellpadding="1" cellspacing="1" width="100%" id="conteudo">
		<tr>
			<td colspan="2" class="titulo">Cadastro de Produtos</td>
		</tr>
		<tr>
			<td width="30%">Marca:</td>
			<td>
				<!--<select name="marca" id="marca" class="campo" disabled onchange="javascript: dados(this.value, 'marca', 'grupo')">-->
				<select name="marca" id="marca" class="campo" disabled>
					<option value="">Selecione</option>
					<?
						$sql = "SELECT codigo, nome FROM marca ORDER BY nome";
						$marcas = $dbase->select($sql);
						
						for($i=0;$i<count($marcas);$i++)
						{
							echo "<option value='".$marcas[$i]['codigo']."' ";
							echo $dados[0]['marca'] == $marcas[$i]['codigo'] ? "selected >".$marcas[$i]['nome']."</option>" : ">".$marcas[$i]['nome']."</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Grupo:</td>
			<td><select name="grupo" id="grupo" class="campo" disabled>
				<?
					echo "<option id=\"opcoes\" value=''>Selecione</option>";
					$sql = "SELECT codigo, nome FROM grupo ORDER BY nome";
					$grupos = $dbase->select($sql);
					for($i=0;$i<count($grupos);$i++)
					{
						echo "<option value='".$grupos[$i]['codigo']."'";
						echo $dados[0]['grupo'] == $grupos[$i]['codigo'] ?  " selected >".$grupos[$i]['nome']."</option>" : ">".$grupos[$i]['nome']."</option>";
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Produto:</td>
			<td><input type="text" name="nome" id="nome" size="30" class="campo" disabled value="<?=$dados[0]['nome']?>" /></td>
		</tr>
		<tr>
			<td>Descrição:</td>
			<td><textarea name="descricao" id="descricao" class="campo" disabled cols="25" rows="5"><?=$dados[0]['descricao'];?></textarea></td>
		</tr>
		<tr>
			<td>Foto:</td>
			<td><input type="file" name="logo" id="logo" size="30" class="campo" disabled /> <input type="checkbox" name="atualizaFoto" id="atualizaFoto" <?=$dados[0]['foto'] && $_POST["opcao"] == "alterar" ? "" : "disabled";?> /><label for="atualizaFoto">Atualizar</label></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="button" name="verFoto" id="verFoto" value="Ver foto" class="botao" <?=$dados[0]['foto'] ? "" : "disabled";?> onclick="javascript: AbrePagina('imagem.php?foto=<?=$dados[0]['foto']."&de=produto";?>')" /></td>
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
				<input type="button" name="salvar"   id="salvar"   class="botao"  value="Salvar"   onclick="javascript: valida()"  />
				<input type="hidden" name="opcao"    id="opcao"    class="botao"  value=""  />
				<input type="hidden" name="codigo"   id="codigo"   class="botao"  value="<?=$dados[0]['codigo'];?>" />
			</td>
		</tr>
	</table>
	<table width="100%" cellpadding="1" cellspacing="1" id="todos">
		<tr class="titulo">
			<td>Marca</td>
			<td>Grupo</td>
			<td>Produto</td>
		</tr>
		<?
			$sql = "SELECT t1.codigo, t1.nome, t2.nome AS marca, t3.nome AS grupo ";
			$sql.= "FROM produto t1 ";
			$sql.= "INNER JOIN marca t2 ON t1.marca = t2.codigo ";
			$sql.= "INNER JOIN grupo t3 ON t1.grupo = t3.codigo ";
			$sql.= "ORDER BY marca,grupo,nome";
			$dados = $dbase->select($sql);
			
			for($i=0;$i<count($dados);$i++)
			{
				echo "<tr onmouseover='this.style.cursor=\"pointer\"; this.style.backgroundColor=\"#FFF9DF\"' onmouseout='this.style.backgroundColor=\"#FFFFFF\"' onclick='location.replace(\"index.php?op=produto&cod=".$dados[$i]['codigo']."\")'>";
				echo "\n\t\t\t<td>".$dados[$i]['marca']."</td>\n\t\t\t<td>".$dados[$i]['grupo']."</td>\n\t\t\t<td>".$dados[$i]['nome']."</td>";
			}
		?>
	</table>
	<br />
</form>