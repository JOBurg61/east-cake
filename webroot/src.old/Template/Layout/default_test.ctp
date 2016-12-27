<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>

<html>

	<head>

		<title><?= h($this->fetch('title')) ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?= $this->Html->css(['bootstrap.min']); ?>
		<?= $this->Html->script(['jquery-3.0.0.min']); ?>

	</head>

<body>
<div class="container-fluid">
	
	<?= $this->fetch('content') ?>

</div>
</div>
</body>
</html>