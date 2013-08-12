<div class="wrap">
	
	<?php screen_icon('generic'); ?>

	<h2><?php _e('WP Fake Image Replacer Settings', 'wpfir'); ?></h2>

	<form method="post" action="options.php" id="wpfir_settings">
		<?php
			settings_fields('wpfir_settings');
			do_settings_sections('wpfir_settings');
			submit_button(); 
		?>
	</form>
</div>
