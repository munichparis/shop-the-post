<div class="partials" id="tracdelight" style="display: none;">

	<h3><?php _e('Tracdelight Shopping Widget', 'shop-the-post') ?></h3>
	<p><?php _e('Paste the code from a Tracdelight gallery widget here.', 'shop-the-post') ?></p>

	<?php if(get_theme_mod('shopthepost_tracdelight_code', '') != ''): ?>
		<p><span style="color: green;"><span class="dashicons dashicons-yes"></span><?php _e('You have sucessfully added the header script. Your Tracdelight Access Key is: ' . get_theme_mod('shopthepost_tracdelight_code'), 'shop-the-post') ?></span></p>
	<?php else: ?>
		<p><span style="color: grey; font-weight: 600"><?php _e('It is recommended to use the \'optimal\' code for better performance. Go to the <a href="' . admin_url('customize.php') . '">Customizer</a> to add the required header script code.', 'shop-the-post') ?></span></p>
	<?php endif; ?>

	<textarea name="_tracdelight_code" class="widefat" rows="2"><?php echo esc_html($tracdelight_code); ?></textarea>

</div>

</div>