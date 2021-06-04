<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>CASA da CALDEIRA | Pe&ccedil;as e Acess&oacute;rios para Caldeiras</title>
		<!-- CSS -->
		<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
		<!-- JavaScript -->
		<script src="assets/js/flash.js" type="text/javascript"></script>
		<script src="js/lib.js" type="text/javascript"></script>
		<script src="js/var.js" type="text/javascript"></script>
		<script src="../js/valida_form.js" type="text/javascript"></script>
		<script src="js/ajax.js" type="text/javascript"></script>
		<script type="text/javascript">
			function limpa()
			{
				document.getElementById('senha').value='';
				document.getElementById('confirma').value='';
			}
			
			function AbrePagina(NomeDaPagina)
			{
				var x = window.open(NomeDaPagina,"PlantiCenter","resizable=no,toolbar=no,status=no,menubar=no,scrollbars=yes,width=400,height=500,top=1,left=1");
				x.focus();
			}
				
		</script>
	</head>
	<body>
		<?
			require("../lib/classe.php");
			$sessao->verifica("codUsuario","login.php");
			$sessao->start();
		?>
		<div id="tudo">
			<div id="topo"></div>
			<div id="menu">
				<ul>
					<li><strong>Cadastros</strong></li>
					<?
						echo $_GET['op'] == "adm" ? "<li>&rarr; <a href='index.php?op=adm'><strong>Administrador</strong></a></li>" : "\n\t\t\t\t\t<li>&rarr; <a href='index.php?op=adm'>Administrador</a></li>";
						echo $_GET['op'] == "marca" ? "\n\t\t\t\t\t<li>&rarr; <a href='index.php?op=marca'><strong>Marcas</strong></a></li>" : "\n\t\t\t\t\t<li>&rarr; <a href='index.php?op=marca'>Marcas</a></li>";
						echo $_GET['op'] == "grupo" ? "\n\t\t\t\t\t<li>&rarr; <a href='index.php?op=grupo'><strong>Grupos</strong></a></li>" : "\n\t\t\t\t\t<li>&rarr; <a href='index.php?op=grupo'>Grupos</a></li>";
						echo $_GET['op'] == "produto" ? "\n\t\t\t\t\t<li>&rarr; <a href='index.php?op=produto'><strong>Produtos</strong></a></li>\n" : "\n\t\t\t\t\t<li>&rarr; <a href='index.php?op=produto'>Produtos</a></li>\n";
					?>
					<li>&nbsp;</li>
					<li><a href="index.php?op=logout">Sair</a></li>
				</ul>
			</div>
			<div id="meio">
				<? 
					if($_GET['op'] && $_GET['op'] != 'logout')
					{
						if($_GET['op'] == "adm" && $_SESSION['nivel'] == "usr")
						{
							echo "<div class='texto'><br /><br />Voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar esta &aacute;rea!!!</div>";
						}
						else
						{
							if(is_file($_GET['op'].".php"))
							{
								include($_GET['op'].".php");
							}
						}
					}
					elseif ($_GET['op']=="logout")
					{
						$sessao->destroy();
						$history->hReplace('index.php');
					}
				?>
			</div>
			<div id="rodape">
				Casa da Caldeira - Todos os direitos reservados
				<span class="creditos">Desenvolvido e hospedado por <a href="http://www.odarainternet.com.br" target="_blank">Odara Internet</a></span>
			</div>
		</div>
	</body>
</html>