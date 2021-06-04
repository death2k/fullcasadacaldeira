<p>Olá <?php echo $data['nome'] ?>, obrigado por fazer o pedido de cotação. Nossa equipe entrará em contato o mais breve possível.</p>

<h1>Informações de Contato</h1>
<p>Nome: <strong><?php echo $data['nome'] ?></strong></p>
<p>Email: <strong><?php echo $data['email'] ?></strong></p>
<p>Telefone: <strong><?php echo $data['telefone'] ?></strong></p>
<p>Cidade/UF: <strong><?php echo $data['cidade'] . '/' . $data['estado']; ?></strong></p>
<p>Empresa: <strong><?php echo $data['empresa']; ?></strong></p>
<p>
    Observações:
    <br />
    <?php echo $data['observacoes']; ?>
</p>

<h1>Informações dos Produtos</h1>
<p>Segue a lista de produtos:</p>
<?php echo $this->element('carrinho/tabela-email', array('carrinho' => $carrinho)); ?>

<br /><p>----------</p>

<p>
	Qualquer dúvida, entre em contato:
	<br />
	Telefone: (44) 3042-0034
	<br />
	Email: <a href="mailto:contato@arosgt.com.br">contato@arosgt.com.br</a>
	<br />
	<a href="http://www.arosgt.com.br">ArosGT.com.br</a>.
</p>