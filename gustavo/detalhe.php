<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="573" height="387" background="assets/imagem/fd_inicio.jpg" valign="top">
		  	<?
		  		$sql = "SELECT t1.nome, t1.descricao, t1.foto, t2.nome AS grupo, t3.codigo AS codMarca, t3.nome AS marca "; 
		  		$sql.= "FROM produto t1 ";
		  		$sql.= "INNER JOIN grupo t2 ON t2.codigo = t1.grupo ";
		  		$sql.= "LEFT JOIN marca t3 ON t3.codigo = t1.marca ";
		  		$sql.= "WHERE t1.codigo = '".$_GET['prod']."'";
		  		$dados = $dbase->select($sql);
		  		
		  	//	echo "<p class='tituloProd'><a href='produtos.php?op=marcas'>".strtoupper($dados[0]['marca'])."</a> - <a href='produtos.php?op=grupos&marca=".$dados[0]['codMarca']."'>".strtoupper($dados[0]['grupo'])."</a></p>";
		  	//	echo $dados[0]['foto'] ? "<p id='fotoProd'><img src='app/imagens/produtos/".$dados[0]['foto']."' /></p>" : "<p id='fotoProd'><img src='app/imagens/produtos/default.gif' /></p>";
		  	//	echo "<p id='descricaoProd'>".$dados[0]['descricao']."</p>";
		  	//	echo "<pre>";print_r($dados);
		  	?>
		  	<table border="0" cellpadding="3">
		  		<tr>
		  			<td colspan="2" align="center" class="tituloProd"><strong><?=$dados[0]['nome'];?></strong></td>
		  		</tr>
		  		<tr>
		  			<td><?=$dados[0]['foto'] ? "<p id='fotoProd'><img src='app/imagens/produtos/".$dados[0]['foto']."' /></p>" : "<p id='fotoProd'><img src='app/imagens/produtos/default.gif' /></p>";?></td>
		  			<td align="justify"><? if ($dados[0]['marca']) echo "<p id='descricaoProd'><strong>Marca: </strong>".$dados[0]['marca']."<br /><br />"; echo $dados[0]['descricao']."</p>";?></td>
		  		</tr>
		  	</table>
	  	<br /><br /><br />
	  	<center class="tituloProd"><a href="javascript: history.go(-1)"><strong>Voltar</strong></a></center>
	  </td>
	</tr>
</table>