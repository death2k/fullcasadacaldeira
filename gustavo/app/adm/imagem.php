<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
		<title>CASA da CALDEIRA | Pe&ccedil;as e Acess&oacute;rios para Caldeiras</title>
		<style>
			* {margin:0; padding:0}
		</style>
		<script>
		function tam()
		{
			img = document.images;
			largura = img[0].offsetWidth;
			altura  = img[0].offsetHeight;
			
			window.resizeTo(largura+15,altura+50);
		}
		</script>
	</head>
	<body onload="tam();" scroll="no" oncontextmenu="return false;" onselectstart="return false;" >
		<?
			$diretorio = $_GET["de"] == "marca" ? "../imagens/marcas/" : "../imagens/produtos/";
			echo "<img src='".$diretorio.$_GET['foto']."' />";
		?>
	</body>
</html>