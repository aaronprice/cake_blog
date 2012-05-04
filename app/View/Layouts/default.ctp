<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>
				<?= $this->Html->link( 'Blog', '/' ) ?>
				<?php if ( $currentUser ) : ?>
					Welcome, <?= $currentUser->data[ 'User' ][ 'first_name' ] ?>.
					<?= $this->Html->link( 'Logout', array( 'controller' => 'logout' ) ) ?>
				<?php else : ?>
					<?= $this->Html->link( 'Login', array( 'controller' => 'login' ) ) ?>
				<?php endif ?>
			</h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
</body>
</html>