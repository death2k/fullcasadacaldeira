
<?
	$max = 9; // maximo de registro por pagina
	$limit_in = !empty($_GET['inicio']) ? $_GET['inicio']*$max:0;
	$inicio = $_GET['inicio'];
	$fim = $max;
	$maxLink = 1;	
	      		
	$sql = "SELECT t1.codigo, t1.marca, t1.grupo, MID(t1.nome,1,40) AS nome, t1.descricao, t1.foto, t2.nome AS nGrupo ";
	$sql.= "FROM produto t1 ";
	$sql.= "INNER JOIN grupo t2 ON t1.grupo = t2.codigo ";
	$sql.= "WHERE grupo = '".$_GET['grupo']."' ORDER BY t1.nome";

	$aux = explode("FROM",$sql);
	$total = $dbase->select("SELECT COUNT(*) FROM ".$aux[1]);
	$tt_pagina = ceil($total[0][0]/$max);
	  		
	$sql.= " LIMIT ".$limit_in.",".$fim;
	$dados = $dbase->select($sql);
	  		
	echo "<p class='tituloProd'><strong>".$dados[0]['nGrupo']."</strong></p>";
	
	$dir = "app/imagens/produtos/";
	$listagem->addListagem($dados,$dir);
	
	$url = "&grupo=".$_GET['grupo'];
	$op = $_GET['op'];

	echo "<p class='tituloProd'><a href='javascript: history.go(-1)'><strong>Voltar</strong></a></p>";
	
	$html->addPaginacao($op, $maxRegistro, $maxLink, $inicio, $tt_pagina, $url);
?>