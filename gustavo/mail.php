<?php

	if($_POST)
	{
		require_once("class.phpmailer.php");
		
		if($_POST["Contato"])
		{
			$tipo = "Contato";
		}
		else
		{
			$tipo = "" ;
		}
		$aux2 = "";
		$aux = "<table>
				<br /><br /><br /><br />
";
		
		$er = "(enviar|Contato|submit|submit2)";
		
		foreach($_POST as $k => $v)
		{
			if(!ereg($er, $k))
			{
				$aux.= "\n\t<tr>\n\t\t<td class=\"nome\">".$k."</td>\n\t\t<td>".$v."</td>\n\t</tr>";
				$aux2.= $k." ".$v."\n";
			}
		}
		$aux.= "</table>
<br />
";
		
		
		
		$mail = new PHPMailer();
		
		$mail->ContentType = "text/html";
		$mail->SetLanguage("br");
		$mail->IsHTML(true);   
		$mail->IsSMTP();                      
		$mail->Host     = "smtp.odara.com.br"; 
		$mail->Port     = 587; 
		$mail->SMTPAuth = true;  
		$mail->Secure = 'tls';     
		$mail->Username = "site@casadacaldeira.com.br";
		$mail->Password = "2102d3"; 
		
		$mail->From     = "site@casadacaldeira.com.br";
		$mail->FromName = "Casa da Caldeira";
		if ($_POST['E-mail:'])
			$mail->AddReplyTo     = $_POST['E-mail:'];
		$mail->Subject  =  "Contato Site";		
		
		$mail->AddAddress("casadacaldeira@casadacaldeira.com.br");
		
		$mail->Body = "
			<html>
				<head>
					<!--<title>Casa da Caldeira</title>-->
					<style type=\"text/css\">
						*{ margin:0; padding:0;  font-family: Verdana; font-size: 11px;}
						#topo { height:90px; width:600px; background:url('http://www.casadacaldeira.com.br/assets/imagem/contato_fd.jpg') repeat-x;}
						img{ border:0;}
						#topo a{ border:0; text-decoration:none; width:50px!important; height:50px!important; margin-left:0px!important;}
						#topo h2{ margin:15px 0 0 260px; font-size:15px;}
						#content{ margin:10px;}
						#rodape {background:url('http://www.casadacaldeira.com.br/assets/imagem/contato_fdrodape.jpg') repeat-x; width:600px; height:38px;}
						.nome{ font-weight: bold; margin:15px 0 0 210px; font-size:12px; width: 135; border: 0; cellspacing: 0;  cellpadding: 0; }
						
					</style>
				</head>
				<body>
					<div id=\"topo\">
						<a href=\"http://www.casadacaldeira.com.br\">
							<img src=\"http://www.casadacaldeira.com.br/assets/imagem/contato_logo.jpg\" alt=\"Casa da Caldeira\" title=\"Casa da Caldeira\" />		
						</a>
						<h2>Contato ".$tipo." </h2>
					</div>
					<div id=\"content\">
					";
		$mail->Body.= $aux;
		$mail->Body.= "
					</div>
					<div id=\"rodape\">
					</div>
				</body>
			</html>";
			
		$mail->AltBody = "Casa da Caldeira\n\n";
		$mail->AltBody.= $tipo."\n\n\n";
		$mail->AltBody.= $aux2;
		
		$mail->Send();
		
		echo "<script type=\"text/javascript\">location.replace('contato.php')</script>";
	}
?>