<?= $this->assign('title', 'Thank You!'); ?>


<h1><?= h( $user['role'] ) ?></h1>

<pre>
<?= h( var_dump($rq['action']) ) ?>
</pre>