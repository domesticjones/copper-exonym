<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<title><?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<?php wp_head(); ?>
	</head>
	<body itemscope itemtype="http://schema.org/WebPage">
		<?php
			$headerLogo = get_field('header_logo', 'options');
			$headerNav = get_field('header_navigation', 'options');
			if($headerLogo || $headerNav) {
				echo '<nav class="navbar">';
					if($headerLogo) { echo '<a class="navitem space">' . wp_get_attachment_image($headerLogo['id'], 'medium') . '</a>'; }
					if($headerNav) {
						foreach($headerNav as $nav) {
							$name = $nav['name'];
							$button = $nav['button'] ? ' button' : '';
							$space = $nav['space'] ? ' space' : '';
							echo '<a class="navitem' . $button . $space . '">' . $name . '</a>';
						}
					}
				echo '</nav>';
			}
		?>
		<div class="content">
