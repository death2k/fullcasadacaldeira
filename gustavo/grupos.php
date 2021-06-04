<center class="tituloProd"><strong>Selecione a categoria que deseja ver:</strong></center>
<br />
<?
	$sql = "SELECT codigo, nome FROM grupo WHERE marca = '".$_GET['marca']."'";
	$dados = $dbase->select($sql);
	
	echo "<table width=90% cellspacing='5' id='marcas'><tr>";
	for($i=0;$i<count($dados);$i++)
	{
		echo "<td align='center'><a href='produtos.php?op=pecas&grupo=".$dados[$i]['codigo']."'>".$dados[$i]['nome']."</a></td>";
		echo ($i+1)%2==0 ? "</tr><tr>" : "";
	}
	echo "</tr></table>";
?>
<br />	
<center class="tituloProd"><a href="javascript: history.go(-1)">Voltar</a></center>				