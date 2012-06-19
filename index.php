<?php

require 'router.class.php';

$router = new Router;

$router->newPage('Hello World', 'hello-world', function(){
	echo 'Hello World!';
});
$router->newPage('PHPInfo', 'phpinfo', function(){
	phpinfo();
});

$page = $router->getContent($_GET['page'], '%title% &laquo; MyWebPage');

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $page['title'] ?></title>
</head>
<body>
	<ul>
		<?php foreach($router->getMenu('index.php', '?page=%slug%') as $url => $name): ?>
			<li><a href="<?php echo $url ?>"><?php echo $name ?></a></li>
		<?php endforeach ?>
	</ul>
	<p><?php $page['content']() ?></p>
</body>
</html>