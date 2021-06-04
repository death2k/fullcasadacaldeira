<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>CASA da CALDEIRA | Pe&ccedil;as e Acess&oacute;rios para Caldeiras</title>
		<!-- CSS -->
		<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
		<!-- JavaScript -->
		<script src="assets/js/flash.js" type="text/javascript"></script>
		<script src="../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
	</head>
		<?
			require("../lib/classe.php");
			if ($_POST)
			{
				$sql = "SELECT codigo, login, nivel FROM adm WHERE login = '".$dbase->limpaSql($_POST['login'])."' AND senha = '".$dbase->limpaSql($_POST['senha'])."'";
				$dados = $dbase->select($sql);
				
				if(count($dados) > 0)
				{
					$sessao->start();
					$_SESSION['usuario'] = $dados[0]['login'];
					$_SESSION['codUsuario'] = $dados[0]['codigo'];
					$_SESSION['nivel'] = $dados[0]['nivel'];
					$history->hReplace("index.php");
				}
				else 
				{
					$history->hReplace("login.php?login=falhou");
				}
			}
			if($_GET["login"] == "falhou") 
			{
				$msg = "Login/Senha incorreto";
			}
		?>
	<body>
		<div id="tudo">
			<div id="topo"></div>
			<div id="login">
				<form action="login.php" method="POST">
					<center>
						<div id="msgLogin"><br /><?=$msg;?></div><br />
						<label for="login">Login</label><br />
						<input type="text" name="login" id="login" size="30" class="campo" />
						<br /><br />
						<label for="senha">Senha:</label><br />
						<input type="password" name="senha" id="senha" size="30" class="campo" />
						<br /><br />
						<input type="submit" name="entrar" id="entrar" value="Entrar" class="botao" />
						<br /><br />
					</center>
				</form>
			</div>
			<div id="rodape">
				Casa da Caldeira - Todos os direitos reservados
				<span class="creditos">Desenvolvido e hospedado por <a href="http://www.odarainternet.com.br" target="_blank">Odara Internet</a></span>
			</div>
		</div>
	</body>
</html>