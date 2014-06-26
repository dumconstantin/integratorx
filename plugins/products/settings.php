<?php

return [

	'name'=>'products',

	'template'=>'grid.html.twig',

	'parts'=>[
		'product'=>[
			'template'=>'view.thumbnail.html.twig',
			'templateInclude'=>'{#'.file_get_contents(__DIR__.'/product.include.php').'#}',

			'_before'=>'{#'.file_get_contents(__DIR__.'/product.before.php').'#}',
			'_after'=>'{#'.file_get_contents(__DIR__.'/product.after.php').'#}',

			'picture'=>'{#'.file_get_contents(__DIR__.'/product.picture.php').'#}',
			'name'=>'{#'.file_get_contents(__DIR__.'/product.name.php').'#}',
			'price'=>'{#'.file_get_contents(__DIR__.'/product.price.php').'#}'
		]
	],

	'_before'=>'{#'.file_get_contents(__DIR__.'/before.php').'#}',
	'_after'=>'{#'.file_get_contents(__DIR__.'/after.php').'#}',

];