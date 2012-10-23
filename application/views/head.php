<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
		<title>Skyrim Alchemy Workbench</title>
		<META NAME='description' CONTENT='Skyrim Alchemy Workbench: alchemy recipies for Skyrim based off "recipe book" or your own criteria.  Shows name, ingredients, effects, and value for each alchemy recipe.'/>
		<META NAME='author' CONTENT='Sebastian Wiers'/>
		<META NAME='keywords' CONTENT='skyrim alchemy potion poison elder scrolls sebastian wiers'/>
		<link rel='stylesheet' href='<?php echo base_url('/assets/css/site.css?') . time()  ?>' type='text/css'/>
		<link href="<?php echo base_url() ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link href="<?php echo base_url() ?>/favicon.ico" rel="icon" type="image/x-icon" />
	</head>
	<body>
		<form name="workbench" id='workbench' method='post'>
		<div style="height:5px"></div>
		<div id='tabs'>
		<?php
		$tabs = array('welcome', 'ingredients','effects','recipes');
		foreach ($tabs as $tab) {
			$tabOn = $currentTab === $tab ? "tabon' id='on' onclick='return false" : 'taboff';
			$tabText = ucfirst($tab);
			echo "\t\t<a id='{$tab}_tab' href='" . site_url() . "/workbench/$tab' class='section_tab $tabOn'>$tabText</a>\n";
		}



		?>
		</div>
		<div id='main'>

