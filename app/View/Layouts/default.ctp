<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Blog</title>
	<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php echo $this->Session->flash(); ?>
	
	<?php echo $this->fetch('content'); ?>
	
	<?php echo $this->element('sql_dump'); ?>
	<?= "user_id: " ?>
	<?php var_dump( $this->Session->read( 'user_id' ) ); ?>
</body>
</html>
