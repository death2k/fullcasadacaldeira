<?php
	class dbase 
	{
		function dbase()
		{
			setlocale(LC_ALL, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br');
#			@mysql_pconnect ($host="localhost", $user="is_ccaldeira", $pass="cc903ms9") or die ("Erro ao conectar base de dados <br />".mysql_error());
#			@mysql_select_db($db="is_ccaldeira") or die("Erro ao selecionar base de dados <br />".mysql_error());

			# ALTERADO POR RUBENS (ODARA INTERNET) EM 04/08/2008
                        @mysql_pconnect ($host="localhost", $user="casadacaldeira_1", $pass="cc9043") or die ("Erro ao conectar base de dados <br />".mysql_error());
                        @mysql_select_db($db="casadacaldeira_1") or die("Erro ao selecionar base de dados <br />".mysql_error());
		}
		
		function conecta ($host, $user, $pass)
		{
			@mysql_connect ($host, $user, $pass) or die ("Erro ao conectar base de dados<br />".mysql_error());
		}
		
		function db ($db)
		{
			@mysql_select_db($db) or die("Erro ao selecionar base de dados<br />".mysql_error());
		}
		
		function query ($sql)
		{
			$result = @mysql_query($sql) or die (mysql_error());
			return $result;
		}
		
		function select ($sql)
		{
			$consulta = dbase::query($sql);
			while($row = @mysql_fetch_array($consulta))
			{
				$dados[] = $row;
			}
			return $dados;
		}
		
		function pk ($tabela, $coluna="codigo")
		{
			$sql = "SELECT MAX(".$coluna.") FROM ".$tabela;
			$result = dbase::select($sql);
			return $result[0][0]+1;
		}
		
		function combo ($tabela, $select="", $value="codigo", $text="nome", $order="")
		{
			$sql = "SELECT ".$value.", ".$text." FROM ".$tabela;
			$order!="" ? $sql.=" ORDER BY ".$order: "";

			$dados = dbase::select($sql);
			for($i=0; $i<count($dados);$i++)
			{
				$dados[$i][0] == $select ? $sel = "selected='selected'" : $sel = "";
				$opcoes.= "\n<option value=\"".$dados[$i][0]."\" ".$sel.">".$dados[$i][1]."</option>";
			}
			return $opcoes;
		}
		
		function insert ($tabela, $colunas, $valores)
		{
			$sql = "INSERT INTO ".$tabela." (";
			foreach ($colunas as $value)
			{
				$sql.= $value.",";
			}
			$sql = substr($sql,0,-1).") VALUES (";
			foreach ($valores as $value)
			{
				$sql.= "'".$value."',";
			}
			$sql = substr($sql,0,-1).")";
			
			if(dbase::query($sql))
			{
				return  true;
			}
			else 
			{
				return false;
			}
		}
		
		function update ($tabela, $colunas, $valores, $condicao, $valor_condicao)
		{
			$sql = "UPDATE ".$tabela." SET ";
			for($i=0; $i<count($colunas); $i++)
			{
				$sql.=$colunas[$i]."='".$valores[$i]."',";
			}
			$sql = substr($sql,0,-1);
			$sql.= " WHERE ".$condicao."= '".$valor_condicao."'";
			if(dbase::query($sql))
			{
				return true;				
			}
			else 
			{
				return false;
			}
		}
		
		function delete ($tabela, $condicao, $valor_condicao)
		{
			$sql = "DELETE FROM ".$tabela." WHERE ".$condicao."='".$valor_condicao."' ";
			if(dbase::query($sql))
			{
				return true;
			}
			else 
			{
				return false;
			}
		}

		function autoInsert($tabela, $post, $er="")
		{
			if($er)
			{
				$aux = explode("|",$er);
				$exr = "/";
				for($i=0; $i<count($aux);$i++)
				{
					$exr.= "^".$aux[$i]."$|";
				}
				$er = substr($exr,0,-1)."/";
			}
			if($post["codigo"]=="")
			{
				foreach ($post as $chave => $valor)
				{
					if($er)
					{
						if(!preg_match($er,$chave) && $chave!="codigo")
						{
							$campo.= $chave.",";
							$value.= "'".$valor."',";
						}
					}
					else 
					{
						if($chave!="codigo")
						{
							$campo.= $chave.",";
							$value.= "'".$valor."',";
						}
					}
				}
				$pk = dbase::pk($tabela);
				
				$campo.="codigo";
				$value.="'".$pk."'";
				
				$sql = "INSERT INTO ".$tabela." (".$campo.") VALUES (".$value.")";
				if(dbase::query($sql))
				{
					return true;
				}
				else 
				{
					return false;
				}
			}
			else 
			{
				foreach($post as $chave => $valor)
				{
					if($er)
					{
						if(!preg_match($er, $chave) && $chave!="codigo")
						{
							$campo.=$chave."='".$valor."',";
						}
					}
					else 
					{
						if($chave!="codigo")
						{
							$campo.= $chave."='".$valor."',";	
						}
					}
				}
				$sql = "UPDATE ".$tabela." SET ".substr($campo,0,-1)." WHERE codigo='".$post["codigo"]."'";
				if(dbase::query($sql))
				{
					return true;
				}
				else 
				{
					return false;
				}
			}
		}
		
		function limpaSql($str)
		{
			return preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|'|#|\*|--|\\\\)/"),"",$str);
		}		
	}
	
	class date extends dbase 
	{
		function data ($data)
		{
			if(strpos($data,"-"))
			{
				if(strlen($data)>10)
				{
					$aux  = explode(" ",$data);
					$aux2 = explode("-",$aux[0]);
					$nova = $aux2[2]."/".$aux2[1]."/".$aux2[0]." ".$aux[1];
				}
				else 
				{
					$aux  = explode("-",$data);
					$nova = $aux[2]."/".$aux[1]."/".$aux[0];
				}
			}
			else if (strpos($data,"/")) 
			{
				if(strlen($data)>10)
				{
					$aux  = explode(" ",$data);
					$aux2 = explode("/",$aux[0]);
					$nova = $aux2[2]."-".$aux2[1]."-".$aux2[0]." ".$aux[1];
				}
				else 
				{
					$aux  = explode("/",$data);
					$nova = $aux[2]."-".$aux[1]."-".$aux[0];
				}
			}
			return $nova;
		}
		
		function dtTime ()
		{
			return date("Y-m-d H:i:s");
		}
		
		function dt()
		{
			return date("Y-m-d");
		}
	}
	
	class sessao extends dbase 
	{
		
		function verifica ($sessao, $redirecionamento)
		{
			session_start();			
			if($_SESSION[$sessao]=="")
			{
				echo "<script>location.replace('".$redirecionamento."');</script>";
			}
		}
		
		function start ()
		{
			session_start();
		}
		
		function destroy()
		{
			session_destroy();			
		}
	}
	
	class history extends dbase {
		
		/**
		 * @$url link para o qual será redirecionado
		 * teste
		 */
		function hReplace($url)
		{
			echo "<script>location.replace('".$url."');</script>";
		}
		
		function hHref($url)
		{
			echo "<script>location.href = '".$url."';</script>";
		}
	}
	
	class messenger extends dbase 
	{
		function insert($flag)
		{
			if($flag == true)
			{
				return "Registro gravado com sucesso!";
			}
			else 
			{
				return "Erro ao gravar registro!";
			}
		}
		
		function update($flag)
		{
			if($flag == true)			
			{
				return "Registro alterado com sucesso!";
			}
			else 
			{
				return "Erro ao alterar registro!";
			}
		}
		
		function delete($flag)
		{
			if($flag == true)
			{
				return "Registro excluido com sucesso!";
			}
			else 
			{
				return "Erro ao excluir registro!";
			}
		}
	}
	
	class moeda extends dbase 
	{
		
		function conv($valor, $moeda="", $casas=2)
		{
			if($moeda == "us" || $moeda=="US")
			{
				$valor = str_replace(".", "", $valor);
				$valor = str_replace(",", ".", $valor);
				return number_format($valor, $casas, ".","");
			}
			else if($moeda == "br" || $moeda == "BR" || $moeda=="")
			{
				return number_format($valor, $casas, ",",".");
			}
		}
	}

	class carrinho extends dbase 
	{
		
		function adiciona($codigo)
		{
			$sql = " SELECT codigo, id, nome, valor, promocao, vl_promocao, ini_promocao, fin_promocao,";
			$sql.= " multiplo, qtd_minimo";
			$sql.= " FROM produto WHERE codigo=".$codigo;
			
			$dados = dbase::select($sql);
			
			$dados[0]["valor"]=($dados[0]["valor"]*$_SESSION["percentual"]);
			$dados[0]["vl_promocao"]=($dados[0]["vl_promocao"]*$_SESSION["percentual"]);

			if($dados[0]["qtd_minimo"]!=0)
			{
				$dados[0]['qtd'] = $dados[0]["qtd_minimo"];
			}
			else if($dados[0]["multiplo"]!=0)
			{
				$dados[0]['qtd'] = $dados[0]["multiplo"];
			}
			else 
			{
				$dados[0]['qtd'] = 1;
			}

			if($dados[0]["promocao"]=="sim" && $dados[0]["ini_promocao"] <= date::dt() && $dados[0]["fin_promocao"]>= date::dt())
			{
				$dados[0]['total'] = $dados[0]["vl_promocao"]*$dados[0]["qtd"];
				$dados[0]['valor'] = $dados[0]['vl_promocao'];
			}
			else 
			{
				$dados[0]["total"] = $dados[0]["valor"]*$dados[0]["qtd"];	
			}
	
			if($_SESSION['produto'][$codigo]!="")
			{
				$_SESSION['produto'][$codigo]["total"] = moeda::conv($_SESSION['produto'][$codigo]["total"]+$dados[0]["total"]);
				$_SESSION['produto'][$codigo]["qtd"] = $_SESSION['produto'][$codigo]["qtd"]+$dados[0]['qtd'];
				carrinho::produto($codigo);
			}
			else
			{
				$_SESSION['produto'][$codigo] = $dados[0];
				carrinho::produto($codigo);
			}
		}

		function produto($codigo)
		{
			unset($_SESSION['produto'][$codigo]['promocao']);
			unset($_SESSION['produto'][$codigo]['ini_promocao']);
			unset($_SESSION['produto'][$codigo]['vl_promocao']);
			unset($_SESSION['produto'][$codigo]['fin_promocao']);

			for($i=0; $i<=count($_SESSION['produto'][$codigo]); $i++)
			{
				unset($_SESSION['produto'][$codigo][$i]);
			}			
		}		
		
		function atualiza($array)
		{
			for($i=0; $i<count($array); $i++)
			{
				if($array[$i][1]==0)
				{
					unset($_SESSION['produto'][$array[$i][0]]);
				}
				else
				{
					$_SESSION['produto'][$array[$i][0]]["total"]= moeda::conv($array[$i][1]*$_SESSION['produto'][$array[$i][0]]["valor"]);
					$_SESSION['produto'][$array[$i][0]]["qtd"]=$array[$i][1];
				}
			}
		}
		
		function esvasiar()
		{
			unset($_SESSION['produto']);
		}
	}
	
	class form
	{
		
		function addForm($nome, $action, $method="post", $enctype="multipart/form-data")
		{
			empty($method) ? $method = "post" : "";
			empty($enctype) ? $enctype = "multipart/form-data" : "";
			$GLOBALS['forms'][$nome]['iTag'] = "\n\t\t<form";
			$GLOBALS['forms'][$nome]['name'] = " name=\"".$nome."\"";
			$GLOBALS['forms'][$nome]['action'] = " action=\"".$action."\"";
			$GLOBALS['forms'][$nome]['method'] = " method=\"".$method."\"";
			$GLOBALS['forms'][$nome]['enctype'] = " enctype=\"".$enctype."\"";
			$GLOBALS['forms'][$nome]['fTagForm'] = " >";
			//$GLOBALS['forms'][$nome]['fTag'] = " </form>";
		}	
		
		 function addInput($form, $type, $nome, $id="", $valor="", $linha, $coluna, $label="", $mask="")
		{

			empty($id) ? $id = $nome : "";
			
			if(!preg_match('[button|submit|hidden]', $type))
			{
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['iTag'] = "\n\t\t\t<div";
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['id'] = " id=\"lb_".$nome."\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['propriedade']['class'] = " class=\"texto\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['iStyle'] = " style=\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['style']['position'] = " position:absolute;";
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['style']['top'] = " top:".($linha-18)."px;";
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['style']['left'] = " left:".$coluna."px;";
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['fStyle'] = " \"";
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['ftagDiv'] = " >";
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['text'] =  $label;
				$GLOBALS['forms'][$form]['elemento'][$id]['label']['fTag'] =  "</div>";
			}							

			if($type == "textarea")
			{
				$GLOBALS['forms'][$form]['elemento'][$id]['iTag'] = "\n\t\t\t<textarea ";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['name'] = " name=\"".$nome."\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['id'] = " id=\"".$id."\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['class'] = " class=\"inpute\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['iStyle'] = " style=\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['style']['positon'] = " position:absolute;";
				$GLOBALS['forms'][$form]['elemento'][$id]['style']['top'] = " top:".$linha."px;";
				$GLOBALS['forms'][$form]['elemento'][$id]['style']['left'] = " left:".$coluna."px;";
				$GLOBALS['forms'][$form]['elemento'][$id]['fStyle'] = " \"";
				$GLOBALS['forms'][$form]['elemento'][$id]['fTagTextarea'] = " >";
				$GLOBALS['forms'][$form]['elemento'][$id]['valor'] = $valor;
				$GLOBALS['forms'][$form]['elemento'][$id]['fTag'] = "\n\t</textarea>";
				
			}
			else if ($type == "select") 
			{
				$GLOBALS['forms'][$form]['elemento'][$id]['iTag'] = "\n\t\t\t<select ";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['name'] = " name=\"".$nome."\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['id'] = " id=\"".$id."\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['iStyle'] = " style=\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['style']['positon'] = " position:absolute;";
				$GLOBALS['forms'][$form]['elemento'][$id]['style']['top'] = " top:".$linha."px;";
				$GLOBALS['forms'][$form]['elemento'][$id]['style']['left'] = " left:".$coluna."px;";
				$GLOBALS['forms'][$form]['elemento'][$id]['fStyle'] = " \"";
				$GLOBALS['forms'][$form]['elemento'][$id]['fTagSelect'] = " >";
				
				//$GLOBALS['forms'][$form]['elemento']['propriedade']['valor'] = $valor;
				form::addOpcoes($form, $nome, $valor);
				
				$GLOBALS['forms'][$form]['elemento'][$id]['fTag'] = "\n\t\t\t</select>";
			}
			else 
			{
				$GLOBALS['forms'][$form]['elemento'][$id]['iTag'] = "\n\t\t\t<input";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['type'] = " type=\"".$type."\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['name'] = " name=\"".$nome."\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['id'] = " id=\"".$id."\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['class'] = " class=\"inpute\"";
				!empty($mask) ? $GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['onkeypress'] = " onkeypress=\"mascara(this, '".$mask."', event);\"" : "";
				$GLOBALS['forms'][$form]['elemento'][$id]['iStyle'] = " style=\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['style']['positon'] = " position:absolute;";
				$GLOBALS['forms'][$form]['elemento'][$id]['style']['top'] = " top:".$linha."px;";
				$GLOBALS['forms'][$form]['elemento'][$id]['style']['left'] = " left:".$coluna."px;";
				$GLOBALS['forms'][$form]['elemento'][$id]['fStyle'] = " \"";
				$GLOBALS['forms'][$form]['elemento'][$id]['propriedade']['value'] = " value=\"".$valor."\"";
				$GLOBALS['forms'][$form]['elemento'][$id]['fTagInput'] = " />";

			}
		}
		
		
		function addOpcoes($form, $campo, $opcoes, $sel="")
		{
			unset($GLOBALS['forms'][$form]['elemento'][$campo]['option']);
			unset($GLOBALS['forms'][$form]['elemento'][$campo]['fTag']);

			$GLOBALS['forms'][$form]['elemento'][$campo]['option']['optv']['iTag'] = "\n\t\t\t\t<option";
			$GLOBALS['forms'][$form]['elemento'][$campo]['option']['optv']['propriedade']['value'] = " value=\"\"";
			$GLOBALS['forms'][$form]['elemento'][$campo]['option']['optv']['propriedade']['id'] = " id=\"opcoes\"";
			$GLOBALS['forms'][$form]['elemento'][$campo]['option']['optv']['propriedade']['selected'] = "";
			$GLOBALS['forms'][$form]['elemento'][$campo]['option']['optv']['propriedade']['fOption'] = " >";
			$GLOBALS['forms'][$form]['elemento'][$campo]['option']['optv']['propriedade']['text'] = "";
			$GLOBALS['forms'][$form]['elemento'][$campo]['option']['optv']['fFag'] = "</option>";			

			if(is_array($opcoes))
			{
				if($opcoes[0][0])
				{
					foreach ($opcoes as $v)
					{				
						$v[0] == $sel ? $selected = " selected=\"selected\"" : $selected = "";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$v[0]]['iTag'] = "\n\t\t\t\t<option";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$v[0]]['propriedade']['value'] = " value=\"".$v[0]."\"";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$v[0]]['propriedade']['id'] = " id=\"opcoes\"";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$v[0]]['propriedade']['selected'] = $selected;
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$v[0]]['fOption'] = " >";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$v[0]]['text'] = $v[1];
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$v[0]]['fFag'] = "</option>";
					}
				}
				else 
				{
					foreach ($opcoes as $k => $v)
					{
						$sel == $v ? $selected = " selected=\"selected\"" : $selected = "";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$k]['iTag'] = "\n\t\t\t\t<option";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$k]['propriedade']['value'] = " value=\"".$k."\"";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$k]['propriedade']['id'] = " id=\"opcoes\"";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$k]['propriedade']['selected'] = $selected;
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$k]['fOption'] = " >";
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$k]['text'] = $v;
						$GLOBALS['forms'][$form]['elemento'][$campo]['option']['opt'.$k]['fFag'] = "</option>";
					}
				}
			}
			$GLOBALS['forms'][$form]['elemento'][$campo]['fTag'] = "\n\t\t\t</select>";
		}
		
		function setEstilo($form, $campo, $estilo, $valor)
		{
			$GLOBALS['forms'][$form]['elemento'][$campo]['style'][$estilo] =  $estilo.":".$valor."; ";
		}
		
		function setPropriedade($form, $campo, $propriedade, $valor)
		{
			$GLOBALS['forms'][$form]['elemento'][$campo]['propriedade'][$propriedade] =  " ".$propriedade."=\"".$valor."\" ";
		}

		function setTamanho($form, $campo, $width, $height="")
		{
			$GLOBALS['forms'][$form]['elemento'][$campo]['style']['width'] = " width:".$width."px;";
			if($height)
				$GLOBALS['forms'][$form]['elemento'][$campo]['style']['height'] = " height:".$height."px;";
		}
		
		function setBloqueado($form, $campo)
		{
			$GLOBALS['forms'][$form]['elemento'][$campo]['propriedade']['disabled'] = " disabled=\"disabled\"";
		}	
		
		function setValor($form, $campo, $valor)
		{
			if(preg_match('[select]',$GLOBALS['forms'][$form]['elemento'][$campo]['iTag']))
			{
				$option = $GLOBALS['forms'][$form]['elemento'][$campo]['option'];
				foreach ($option AS $k => $v)
				{
					if(preg_match("[".$valor."]", $v['propriedade']['value']))
					{
						$selected = " selected=\"selected\"";
					}
					else 
					{
						$selected = "";
					}
					$GLOBALS['forms'][$form]['elemento'][$campo]['option'][$k]['propriedade']['selected'] = $selected;
				}
			}
			elseif (preg_match('[textarea]',$GLOBALS['forms'][$form]['elemento'][$campo]['iTag']))
			{
				$GLOBALS['forms'][$form]['elemento'][$campo]['valor'] = $valor;
			}
			else 
			{
				$GLOBALS['forms'][$form]['elemento'][$campo]['propriedade']['value'] = "value=\"".$valor."\"";
			}
		}
		
		function setPositionLegenda($form, $nome, $posicao)
		{
			$atual = form::getPosition($form, $nome);
			$tam = form::getTamanho($form, $nome);
						
			$width = $tam[0];
			$height = $tam[1];
			$linha = $atual[0];
			$coluna = $atual[1];
			
			if($posicao == "t" || $posicao == "T")
			{
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['position'] = " position:absolute;";
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['top'] = " top:".($linha-18)."px;";
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['left'] = " left:".$coluna.";";
			}
			elseif($posicao == "l" || $posicao=="L")
			{
				$x = strlen($GLOBALS['forms'][$form]['elemento'][$nome]['label']['text']);
				$px = ceil($x*6.7);
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['position'] = " position:absolute;";
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['top'] = " top:".$linha."px;";
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['left'] = " left:".($coluna - $px)."px;";
			}
			elseif($posicao == "r" || $posicao == "R")
			{
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['position'] = " position:absolute;";
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['top'] = " top:".($linha)."px;";
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['left'] = " left:".($coluna+$width+10)."px;";
				//$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['float'] = " float:left;";
			}
			elseif ($posicao == "b" || $posicao == "B")
			{
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['position'] = " position:absolute;";
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['top'] = " top:".($linha+18)."px;";
				$GLOBALS['forms'][$form]['elemento'][$nome]['label']['style']['left'] = " left:".$coluna."px;";
			}
		}
		
		function getValor($form, $campo)
		{
			return preg_replace("[value|=|\"]","",$GLOBALS['forms'][$form]['elemento'][$campo]['propriedade']['value']);
		}
		
		function getPosition($form, $campo)
		{
			$top = str_replace("top:","",$GLOBALS['forms'][$form]['elemento'][$campo]['style']['top']);
			$top = str_replace("px;","",$top);
			$left = str_replace("left:","",$GLOBALS['forms'][$form]['elemento'][$campo]['style']['left']);
			$left = str_replace("px;","",$left);
			
			if(empty($top))
			{
				$top = 0;
			}
			if(empty($left))
			{
				$left = 0;			
			}
			
			return array(trim($top), trim($left));
		}
		function getTamanho($form, $campo)
		{
			$width = str_replace("width:","",$GLOBALS['forms'][$form]['elemento'][$campo]['style']['width']);
			$width = str_replace("px;", "", $width);
			$height = str_replace("height:", "", $GLOBALS['forms'][$form]['elemento'][$campo]['style']['height']);
			$height = str_replace("px;", "", $height);
			return array(trim($width), trim($height));
		}
		
		function space($form, $campo, $space, $coluna)
		{
			$tam = form::getTamanho($form, $campo);
			return $coluna+$tam[0]+$space;
		}

		function addText($form, $nome, $text, $linha, $coluna)
		{
			$GLOBALS['forms'][$form]['elemento'][$nome]['iTag'] = "\n\t\t\t<div";
			$GLOBALS['forms'][$form]['elemento'][$nome]['id'] = " id=\"txt_".$nome."\"";
			$GLOBALS['forms'][$form]['elemento'][$nome]['propriedade']['class'] = " class=\"texto\"";
			$GLOBALS['forms'][$form]['elemento'][$nome]['iStyle'] = " style=\"";
			$GLOBALS['forms'][$form]['elemento'][$nome]['style']['position'] = " position:absolute;";
			$GLOBALS['forms'][$form]['elemento'][$nome]['style']['top'] = " top:".$linha."px;";
			$GLOBALS['forms'][$form]['elemento'][$nome]['style']['left'] = " left:".$coluna."px;";
			$GLOBALS['forms'][$form]['elemento'][$nome]['fStyle'] = " \"";
			$GLOBALS['forms'][$form]['elemento'][$nome]['ftagDiv'] = " >";
			$GLOBALS['forms'][$form]['elemento'][$nome]['texto'] =  $text;
			$GLOBALS['forms'][$form]['elemento'][$nome]['fTag'] =  "</div>";			
		}
		
		function addPaginacao($op, $maxRegistro, $maxLink, $inicio, $tt_pagina, $url)
		{
			echo "\n<div id=\"paginacao\"> <!-- inicio div paginacao -->";
			echo "\n\t<span class=\"inativo\">";
			if($tt_pagina>1)
			{
				if($inicio > 0)
				{
					$pag = $inicio;
					$pag--;
					echo "\n\t\t\t\t<span class=\"btnFirstLast\"><a href=\"?op=".$op."&amp;inicio=0".$url."\" >&laquo;&laquo;</a></span>";
					echo "\n\t\t\t\t<span class=\"btnPrevNext\"><a href=\"?op=".$op."&amp;inicio=".$pag.$url."\" >&laquo;</a></span>";
				}
				($inicio - $maxLink)<=0 ? $i = 0 : $i = $inicio-$maxLink;
				$max = $inicio+$maxLink+1;
				
				if($max > $tt_pagina)
				{
					$max = $tt_pagina;
				}
				for($i=$i; $i<$max; $i++)
				{
					$x=$i;
					$x++;
					if($i==$inicio)
					{
						echo "\n\t\t\t\t<span class=\"atual\">\n\t\t\t\t\t<a href=\"?op=".$op."&amp;inicio=".$i.$url."\" >".$x."</a>\n\t\t\t\t</span>";
					}
					else
					{
						echo "\n\t\t\t\t<a href=\"?op=".$op."&amp;inicio=".$i.$url."\" >".$x."</a>";
					}
				}
				if($inicio != ($tt_pagina-1))
				{
					$pg = $inicio;
					$pg++;
					echo "\n\t\t\t\t<span class=\"btnPrevNext\"><a href=\"?op=".$op."&amp;inicio=".$pg.$url."\" >&raquo;</a></span>";
					echo "\n\t\t\t\t<span class=\"btnFirstLast\"><a href=\"?op=".$op."&amp;inicio=".($tt_pagina-1).$url."\" >&raquo;&raquo;</a></span>";
				}
			}
			echo "\n\t</span>";
			echo "\n</div><!-- fim div paginacao -->\n";
		}
	
		
		function endForm($form)
		{
			form::mostra($GLOBALS['forms'][$form]);
			echo "\n\t\t</form>\n";
		}
		
		function mostra($array)
		{
			foreach ($array as $k => $v)
			{
				if(!is_array($v))
				{
					echo $v;
				}
				else 
				{
					form::mostra($v);
				}				
			}
		}
	}
	
	class listagem
	{
		/**
		 * Adiciona uma listagem de produtos
		 *
		 * @param array $dados
		 * Array contendo os dados dos produtos a serem exibidos
		 * @param string $dir
		 * String contendo o caminho do diretorio das imagens dos produtos
		 */
		function addListagem($dados, $dir)	
		{
			echo "<ul id='listagem'>";
		
				for($i=0; $i<count($dados); $i++)
				{
					echo "\n\t\t\t\t<li>";
					
						$foto = $dir.str_replace("_g", "_p",$dados[$i]["foto"]);
								
						$img = file_exists($foto) && is_file($foto) ? $foto : $dir."default.gif";
						
						echo "\n\t\t\t\t\t<p class=\"image\"><a href=\"produtos.php?op=detalhe&prod=".$dados[$i]["codigo"]."\" ><img src=\"".$img."\" alt=\"\" /><br /></a></p>";
	
						echo "\n\t\t\t\t\t<p class=\"title\"><a href=\"produtos.php?op=detalhe&prod=".$dados[$i]["codigo"]."\">";
						echo strlen($dados[$i]['nome']) < 40 ? ucfirst(strtolower($dados[$i]["nome"]))."</a></p>" : ucfirst(strtolower($dados[$i]["nome"]))."...</a></p>";
						
					echo "\n\t\t\t\t</li>";
				}
			
			echo "\n\t\t\t</ul>\n";	

		}
		
	}
	
	class table 
	{
		function addTabela($nome, $titulo, $sql, $op, $inicio="", $max="", $busca="")
		{
			$GLOBALS['tables'][$nome]['Table']['iTag'] = "\n\t<table";
			$GLOBALS['tables'][$nome]['Table']['propriedade']['class'] = " class=\"grid\"";
			$GLOBALS['tables'][$nome]['Table']['propriedade']['border'] = " border=\"0\"";
			$GLOBALS['tables'][$nome]['Table']['propriedade']['cellpadding'] = " cellpadding=\"1\"";
			$GLOBALS['tables'][$nome]['Table']['propriedade']['cellspacing'] = " cellspacing=\"0\"";
			$GLOBALS['tables'][$nome]['Table']['style']['iStyle'] = " style=\"";
			$GLOBALS['tables'][$nome]['Table']['style']['style'] = " \"";
			$GLOBALS['tables'][$nome]['Table']['fTagTable'] = ">";

			$GLOBALS['tables'][$nome]['alfabeto']['iTr'] = "\n\t\t<tr";
 			$GLOBALS['tables'][$nome]['alfabeto']['tr']['propriedade']['height'] = " height=\"30\"";
			$GLOBALS['tables'][$nome]['alfabeto']['fTr'] = ">";

			$GLOBALS['tables'][$nome]['alfabeto'][$k]['iTd'] = "\n\t\t\t<td";
			$GLOBALS['tables'][$nome]['alfabeto'][$k]['td']['propriedade']['class'] = " class=\"\"";
			$GLOBALS['tables'][$nome]['alfabeto'][$k]['td']['propriedade']['colspan'] = " colspan=\"".count($titulo)."\"";
			$GLOBALS['tables'][$nome]['alfabeto'][$k]['td']['propriedade']['id'] = " id=\"alfabeto\"";
			$GLOBALS['tables'][$nome]['alfabeto'][$k]['fTd'] = ">";
			
			
			if(preg_match('[&]', $busca))
			{
				$x = explode('&', $busca);
				for($i=0; $i<count($x); $i++)
				{
					$y = explode("=", $x[$i]);
					if($y[0]=='busca')
					{
						$busca = "busca=".$y[1];
					}
					else 
					{
						$php.= "&amp;".$x[$i];
						$js.= "&".$x[$i];
					}
				}
			}
			$txt = 	"\n\t\t\t\t<ul id=\"ul_alfabeto\">";
				for($i=65; $i<91; $i++)
				{
					$busca == chr($i) ? $class = " class=\"_atual\"" : $class = "";
					$txt.="\n\t\t\t\t\t<li".$class."><a href=\"?op=".$op."&busca=".chr($i)."\">".chr($i)."</a></li>";
				}
				$txt.="\n\t\t\t\t</ul>";

			
			$GLOBALS['tables'][$nome]['alfabeto'][$k]['text'] = $txt;
			$GLOBALS['tables'][$nome]['alfabeto'][$k]['fTdTag'] = "\n\t\t\t</td>";
			$txt = "";
			
			
			$GLOBALS['tables'][$nome]['titulo']['iTr'] = "\n\t\t<tr";
			$GLOBALS['tables'][$nome]['titulo']['tr']['propriedade']['class'] = " class=\"titulo_tabela\"";
			$GLOBALS['tables'][$nome]['titulo']['fTr'] = ">";

			if(is_array($titulo))
			{
				foreach($titulo as $k => $v)
				{
					$GLOBALS['tables'][$nome]['titulo'][$k]['iTd'] = "\n\t\t\t<td";
					$GLOBALS['tables'][$nome]['titulo'][$k]['td']['propriedade']['class'] = " class=\"titulo_tabela\"";
					$GLOBALS['tables'][$nome]['titulo'][$k]['fTd'] = ">";
					$GLOBALS['tables'][$nome]['titulo'][$k]['text'] = $v;
					$GLOBALS['tables'][$nome]['titulo'][$k]['fTdTag'] = "</td>";
				}
			}
			$GLOBALS['tables'][$nome]['titulo']['fTrTag'] = "\n\t\t</tr>";
			
			
			if($max)
			{
				$limit_in = !empty($inicio) ? $inicio*$max:0;
				$inicio = $inicio;
				$fim = $max;
				
				$total = dbase::select($sql);
				$tt_pagina = ceil(count($total)/$max);
				$sql.= " LIMIT ".$limit_in.",".$fim;
			}
			
			$dados = dbase::select($sql);

			if($dados)
			{
				foreach ($dados as $k => $v)
				{
					$GLOBALS['tables'][$nome]['registro'][$k]['iTr'] = "\n\t\t<tr";
					$GLOBALS['tables'][$nome]['registro'][$k]['tr']['propriedade']['class'] = " class=\"texto_tabela\"";
					$GLOBALS['tables'][$nome]['registro'][$k]['tr']['propriedade']['onclick'] = " onclick=\"location.replace('?op=".$op."&codigo=".$v[0]."&".$busca.$js."&inicio=".$inicio."')\"";
					$GLOBALS['tables'][$nome]['registro'][$k]['tr']['propriedade']['onmouseover'] = " onmouseover=\"this.style.backgroundColor='#FFF'; this.style.cursor='pointer';\"";
					$GLOBALS['tables'][$nome]['registro'][$k]['tr']['propriedade']['onmouseout'] = " onmouseout=\"this.style.backgroundColor='#F4F3F0';\"";
					$GLOBALS['tables'][$nome]['registro'][$k]['fTr'] = ">";
					for($i=1; $i<(count($v)/2); $i++)
					{
						$v[$i] = eregi("^(([0-9]{4})([\-]([0-9]{2})){2})([\s][\]([0-9]{2})+(([\:])([0-9]{2})){2})?",$v[$i]) ? date::data($v[$i]) : $v[$i];
						$GLOBALS['tables'][$nome]['registro'][$k][$i]['iTd'] = "\n\t\t\t<td";
						$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['propriedade']['class'] = " class=\"\"";
						$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['style']['iStyle'] = " style=\"";
						$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['style']['fStyle'] = " \"";
						$GLOBALS['tables'][$nome]['registro'][$k][$i]['fTd'] = ">";
						$GLOBALS['tables'][$nome]['registro'][$k][$i]['text'] = !empty($v[$i])?$v[$i]: "&nbsp;";
						$GLOBALS['tables'][$nome]['registro'][$k][$i]['fTdTag'] = "</td>";
					}
					$GLOBALS['tables'][$nome]['registro'][$k]['fTrTag'] = "\n\t\t</tr>";
				}
				if($max)
				{
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['iTr'] = "\n\t\t<tr";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['tr']['propriedade']['class'] = " class=\"rodape_paginacao\"";
					//$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['tr']['propriedade']['valign'] = " valign=\"center\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['tr']['style']['iStyle'] = " style=\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['tr']['style']['text-align'] = " text-align:center;";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['tr']['style']['fStyle'] = " \"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['fTr'] = ">";
					
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['iTd'] = "\n\t\t\t<td";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['propriedade']['class'] = " class=\"inativo_tabela\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['propriedade']['colspan'] = " colspan=\"".($i-1)."\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['propriedade']['height'] = " height=\"50\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['style']['iStyle'] = " style=\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['style']['fStyle'] = " \"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['fTd'] = ">";
					
					$txt = "Página ".number_format(($inicio+1),0,"", ".")." de ".number_format($tt_pagina, 0, "", ".").", registros ".number_format(($inicio*$max)+1, 0, "", ".")." à ".number_format(((($inicio)*$max)+count($dados)), 0, "", ".")." de ".number_format((count($total)), 0, "", ".").". <br />";
					if($tt_pagina>1)
					{
						if($inicio > 0)
						{
							$pag = $inicio;
							$pag--;
							$txt.= "\n\t\t\t\t<a href=\"?op=".$op."&amp;inicio=0&amp;".$busca.$php."\" >&laquo;&laquo;</a>";							
							$txt.= "\n\t\t\t\t<a href=\"?op=".$op."&amp;inicio=".$pag."&amp;".$busca.$php."\" >&laquo;</a>";
						}
						($inicio - 7)<=0 ? $i = 0 : $i = $inicio-7;
						$max = $inicio+8;
						
						if($max > $tt_pagina)
						{
							$max = $tt_pagina;
						}
						for($i=$i; $i<$max; $i++)
						{
							$x=$i;
							$x++;
							if($i==$inicio)
							{
								$txt.= "\n\t\t\t\t<span class=\"atual_tabela\">\n\t\t\t\t\t<a href=\"?op=".$op."&amp;inicio=".$i.$php."&amp;".$busca."\" >".$x."</a>\n\t\t\t\t</span>";
							}
							else
							{
								$txt.= "\n\t\t\t\t<a href=\"?op=".$op."&amp;inicio=".$i.$php."&amp;".$busca."\" >".$x."</a>";
							}
						}
						if($inicio != ($tt_pagina-1))
						{
							$pg = $inicio;
							$pg++;
							$txt.= "\n\t\t\t\t<a href=\"?op=".$op."&amp;inicio=".$pg.$php."&amp;".$busca."\" >&raquo;</a>";
							$txt.= "\n\t\t\t\t<a href=\"?op=".$op."&amp;inicio=".($tt_pagina-1).$php."&amp;".$busca."\" >&raquo;&raquo;</a>";
						}
					}
					
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['text'] = "<span>".$txt."</span>";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['fTdTag'] = "\n\t\t\t</td>";
					
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['fTrTag'] = "\n\t\t</tr>";
				}
			}
			else 
			{
				
					$GLOBALS['tables'][$nome]['Table']['iTag'] = "\n\t<table";
					$GLOBALS['tables'][$nome]['Table']['propriedade']['class'] = " class=\"grid\"";
					$GLOBALS['tables'][$nome]['Table']['propriedade']['border'] = " border=\"0\"";
					$GLOBALS['tables'][$nome]['Table']['propriedade']['cellpadding'] = " cellpadding=\"1\"";
					$GLOBALS['tables'][$nome]['Table']['propriedade']['cellspacing'] = " cellspacing=\"0\"";
					$GLOBALS['tables'][$nome]['Table']['fTagTable'] = ">";
					
					$GLOBALS['tables'][$nome]['titulo'] = "";
				
					$GLOBALS['tables'][$nome]['registro'][$k]['iTr'] = "\n\t\t<tr";
					$GLOBALS['tables'][$nome]['registro'][$k]['tr']['propriedade']['class'] = " class=\"texto\"";
					//$GLOBALS['tables'][$nome]['registro'][$k]['tr']['propriedade']['onclick'] = " onclick=\"location.replace('?op=".$op."&codigo=".$v[0]."&busca=".$busca."&inicio=".$inicio."')\"";
					//$GLOBALS['tables'][$nome]['registro'][$k]['tr']['propriedade']['onmouseover'] = " onmouseover=\"this.style.backgroundColor='#FFF'; this.style.cursor='pointer';\"";
					$GLOBALS['tables'][$nome]['registro'][$k]['tr']['propriedade']['border'] = " onmouseout=\"this.style.backgroundColor='#F4F3F0';\"";
					$GLOBALS['tables'][$nome]['registro'][$k]['fTr'] = ">";

					$GLOBALS['tables'][$nome]['registro'][$k][$i]['iTd'] = "\n\t\t\t<td";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['propriedade']['class'] = " class=\"\"";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['propriedade']['colspan'] = " colspan=\"".count($titulo)."\"";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['propriedade']['align'] = " align=\"center\"";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['propriedade']['valign'] = " valign=\"center\"";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['propriedade']['height'] = " height=\"120\"";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['style']['iStyle'] = " style=\"";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['style']['style']['border'] = " border:0;";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['td']['style']['fStyle'] = " \"";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['fTd'] = ">";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['text'] = "<img src=\"../../assets/imagens/alert.gif\" alt=\"\" /><br /> Nenhum registro encontrado!";
					$GLOBALS['tables'][$nome]['registro'][$k][$i]['fTdTag'] = "</td>";

					$GLOBALS['tables'][$nome]['registro'][$k]['fTrTag'] = "\n\t\t</tr>";
					
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['iTr'] = "\n\t\t<tr";
					//$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['tr']['propriedade']['class'] = " class=\"rodape_paginacao\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['tr']['style']['iStyle'] = " style=\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['tr']['style']['text-align'] = " text-align:center;";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['tr']['style']['fStyle'] = " \"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['fTr'] = ">";
					
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['iTd'] = "\n\t\t\t<td";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['propriedade']['class'] = " class=\"rodape_paginacao\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['propriedade']['colspan'] = " colspan=\"".(count($titulo))."\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['propriedade']['height'] = " height=\"50\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['style']['iStyle'] = " style=\"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['td']['style']['fStyle'] = " \"";
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['fTd'] = ">";
					
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['text'] = $txt;
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)][$i]['fTdTag'] = "\n\t\t\t</td>";
					
					$GLOBALS['tables'][$nome]['rodape'][$k+(1)]['fTrTag'] = "\n\t\t</tr>";					
					

			}
			
			//table::endTable($nome);
		}
		
		function setPropriedade($tabela, $coluna, $propriedade, $valor)
		{
			$array = $GLOBALS['tables'][$tabela]['registro'];
			if(is_array($array))
			{
				foreach ($array as $lin => $linha)
				{
					foreach ($linha as $col => $celula)
					{
						if(is_numeric($col) && $col == $coluna)
						{
							$GLOBALS['tables'][$tabela]['registro'][$lin][$col]['td']['propriedade'][$propriedade] = " ".$propriedade."=\"".$valor."\"";
						}
					}
				}
			}
			$array = $GLOBALS['tables'][$tabela]['titulo'];
			if(is_array($array))
			{
				foreach ($array as $k => $v)
				{
					if(is_numeric($k) && ($k+1) == $coluna)
					$GLOBALS['tables'][$tabela]['titulo'][$k]['td']['propriedade'][$propriedade] = " ".$propriedade."=\"".$valor."\"";					
				}
			}
		}
		function setEstilo($tabela, $coluna, $estilo, $valor)
		{
			$array = $GLOBALS['tables'][$tabela]['registro'];
			if(is_array($array))
			{
				foreach ($array as $lin => $linha)
				{
					foreach ($linha as $col => $celula)
					{
						if(is_numeric($col) && $col == $coluna)
						{
							unset($GLOBALS['tables'][$tabela]['registro'][$lin][$col]['td']['style']['fStyle']);
							$GLOBALS['tables'][$tabela]['registro'][$lin][$col]['td']['style'][$estilo] = " ".$estilo.":".$valor.";";
							$GLOBALS['tables'][$tabela]['registro'][$lin][$col]['td']['style']['fStyle'] = "\"";
						}
					}
				}
			}
			
		}
		function endTable($nome)
		{
			table::mostra($GLOBALS['tables'][$nome]);
			echo  "\n\t</table>";
		}
		
		function mostra($array)
		{
			foreach ($array as $k => $v)
			{
				if(!is_array($v))
				{
					echo $v;
				}
				else 
				{
					table::mostra($v);
				}				
			}
		}	
	}
	$dbase 		= new dbase;
	$date 		= new date;
	$sessao 	= new sessao;
	$history 	= new history;
	$messenger 	= new messenger;
	$moeda 		= new moeda;
	$car		= new carrinho;
	$html		= new form;
	$table 		= new table;
	$listagem	= new listagem;
	
	
	function tipoImg($type)
	{
		if(eregi('^image/gif$', $type))
		{
			$erro["func"]  = "imagecreatefromgif";
			$erro["ext"] = "gif";
		}
		else if(eregi('^image/(jpg|jpeg|pjpeg)$', $type))
		{
			$erro["func"] = "imagecreatefromjpeg";
			$erro["ext"] = "jpg";
		}
		else if(eregi('^image/(x-)?(png)$', $type)) 
		{
			$erro["func"] = "imagecreatefrompng";
			$erro["ext"] = "png";
		}
		else 
		{
			$erro = 1;
		}	
		
		return $erro;
	}
	
	function deletaImg($diretorio,$img)
	{
		$ext = array(".jpg",".gif",".png");
		for ($i=0;$i<count($ext);$i++)
		{
			if (file_exists($diretorio.$img.$ext[$i]) && is_file($diretorio.$img.$ext[$i]))
			{
				unlink($diretorio.$img.$ext[$i]);
			}
		}
	}
	
	function criaImg($diretorio,$img)
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
				
				$max_w = 120;
				$max_h = 90;
				$w = imagesx($imagem_orig);
				$h = imagesy($imagem_orig);
				$scala = min($max_w/$w,$max_h/$h);
		
				$largura = floor($scala*$w); 
				$altura = floor($scala*$h); 
				
				$imagem_gerada = $img.".".$erro["ext"];
				$imagem_fin = imagecreatetruecolor($largura, $altura);
				imagecopyresampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura, $altura, $w, $h);
				imagejpeg($imagem_fin, $diretorio.$imagem_gerada);
				imagedestroy($imagem_fin);
			}
			imagedestroy($imagem_orig);
			unlink($diretorio.$imagem_up);
			return $imagem_gerada;
		}
	}
?>
