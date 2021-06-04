<p style="margin:0 0 10px 0;">
	Olá <?php echo $data['nomeAmigo']; ?>,
	seu amigo <?php echo $data['nome']; ?> te indicou um produto de nosso site.
</p>


<br />


<h1 style="margin:0 0 10px 0; font-size:16px;"><?php echo $html->link($tituloProduto, $linkProduto); ?></h1>
<p style="margin:0 0 10px 0;">
	<?php echo $descricaoProduto; ?>
	<br />
	<?php echo $html->link('Veja mais', $linkProduto); ?>
</p>


<br /><p>----------</p>


<p>
	Para maiores informações, entre em contato conosco.
	<br />
	Telefone: (44) 3046-8989 / 0800-605-8989
	<br />
	Email: <a href="mailto:contato@valeatacado.com.br">contato@valeatacado.com.br</a>
	<br />
	<a href="http://www.valeatacado.com.br">ValeAtacado.com.br</a>
</p>