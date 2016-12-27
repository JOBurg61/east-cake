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
use Cake\Routing\Router;
?>
<!DOCTYPE html>

<html>

	<head>

		<title><?= h($this->fetch('title')) ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		
		<script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.0/js/bootstrap-select.min.js'></script>
		
		<link rel=”stylesheet” href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.0/css/bootstrap-select.min.css'>

		<?= $this->Html->script([
								 'dhtmlxscheduler', 
								 'dhtmlxscheduler_readonly',
								 'bootstrap-lightbox.min'
								  ]); ?>
		
		<?= $this->Html->css([ 'dhtmlxscheduler', 'east', 'bootstrap-lightbox.min' ]); ?>

	</head>

<body>
<div class="container-fluid">
	<?php
		if(in_array($this->request->session()->read('Auth.User.role'), ['coordinator','admin'])){
	?>
	<div class="row bg-info">
		<div class="col-md-8">
			Administrator <small class="text-muted"><?= $this->request->session()->read('Auth.User.full_name') ?></small>
		</div>

		<div class="btn-group col-md-4" role="group">
			<?= $this->Html->link('Volunteers', ['controller' => 'users', 'action' => 'index' ], ['class'=>'btn btn-default'] )  ?>
			<?= $this->Html->link('Venues', ['controller' => 'venues', 'action' => 'index' ], ['class'=>'btn btn-default'] )  ?>
			<?= $this->Html->link('Jobs', ['controller' => 'jobs', 'action' => 'index' ], ['class'=>'btn btn-default'] )  ?>
			<?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout' ], ['class'=>'btn btn-default', 'confirm' => 'Are you sure you wish to log out?'] )  ?>				
		</div>
	</div>
	<?php
		}
	?>

	<?= $this->fetch('content') ?>

</div>
</body>
</html>