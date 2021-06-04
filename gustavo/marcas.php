<?
	$sql = "SELECT codigo, nome FROM grupo ORDER BY nome";
	$dados = $dbase->select($sql);
	
	echo "<table id='marcas' width=90% cellspacing='3'>\n\t\t\t\t\t\t\t<tr>";
	for($i=0;$i<count($dados);$i++)
	{
		echo "\n\t\t\t\t\t\t\t\t<td align='left' style='padding-left:5px'><a href='produtos.php?op=pecas&grupo=".$dados[$i]['codigo']."'>".$dados[$i]['nome']."</a></td>";
		echo ($i+1) % 3 == 0 ? "\n\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t<tr>" : "";
	}
	echo "\n\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t</table>";
	

?>	
<br />
<table id='marcas' width=90% cellspacing='3'>
<tr>
<td align='center' style='padding-left:5px'><a href='http://www.caldeiraseit.com.br'>Caldeiras EIT</a></td>
</tr>
</table>
<br />
                    