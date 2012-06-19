# Basic Router #

## About Basic Router ##
Basic Router is a very basic and small Router class builded in PHP.

## Usage ##
### 1. First require the class ###
	require 'router.class.php';
### 2. Add a page ###
	$router->newPage('Hello World', 'hello-world', function(){
		echo 'Hello World!';
	});
### 3. Than get the content ###
	$page = $router->getContent($_GET['page'], '%title% &laquo; MyWebPage');
### 4. Than add the stuff the page ###
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