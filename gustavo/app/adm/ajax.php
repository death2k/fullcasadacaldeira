<?
	include('../lib/classe.php');

	$codigo = $_REQUEST["codigo"]; 
	$origem = $_REQUEST["origem"]; 

	function xml($dados)
	{
		$xml  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
		$xml .= "<resultado>\n"; 
		for($i=0; $i<count($dados); $i++)
		{
			$xml .= "<registro>\n";     
			$xml .= "<codigo>".$dados[$i][0]."</codigo>\n";                  
			$xml .= "<descricao>".htmlspecialchars ($dados[$i][1])."</descricao>\n";
			$xml .= "</registro>\n";
		}
		$xml.="</resultado>\n";
		return $xml;
	}
	

	/////////////////////////////////////////////////////////
	//													   //
	// fim($xml) fecha o xml, insere o header e exibe o xml//
	//													   //
	/////////////////////////////////////////////////////////	
	function fim($xml)
	{
		Header("Content-type: application/xml; charset=iso-8859-1"); 
		echo $xml;
	}


	if($origem == "marca")
	{
		$sql = "SELECT codigo, nome FROM grupo WHERE marca = ".$codigo." ORDER BY nome";
		$dados = $dbase->select($sql);
		$xml = xml($dados);
	}
	fim($xml);
?>
