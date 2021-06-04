<?php

$errors = array();

foreach ($message AS $fieldErrors)
	foreach ($fieldErrors AS $error)
		$errors[] = $error;
	
$errors = array_unique($errors);

if (!empty($errors)) {
?>
<div class="message validation error">
	<p>Por favor, verifique os seguintes itens:</p>
	<?php echo '<ul><li>' . join('</li><li>', $errors) . '</li></ul>'; ?>
</div>
<?php } ?>