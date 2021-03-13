<?php

$currentDir = $_GET['currentDir'];
if(!$currentDir) {
	$currentDir = __DIR__;
}

echo $currentDir . '<br>';

$dir = new DirectoryIterator($currentDir);

foreach ($dir as $item) {
	if ($item == '.') {
		continue;
	}

	if ($item == '..' && dirname($currentDir) == $currentDir) {
		continue;
	}

	if ($item == '..') {
		$cd = dirname($currentDir);
		echo "dir : <a href = '?currentDir=$cd'>$item</a><br>";
		continue;
	}

	if ($item->getType() == 'file') {
		echo "file: $item <br>";
		continue;
	}

	if ($item->getType() == 'link') {
		echo "link: $item <br>";
		continue;
	}

	if (dirname($currentDir) == $currentDir) {
		$cd = $currentDir . $item;
    	echo "dir : <a href = '?currentDir=$cd'>$item</a> <br>";
		continue;
	}

	$cd = $currentDir . '\\' . $item;
    echo "dir : <a href = '?currentDir=$cd'>$item</a> <br>";
}