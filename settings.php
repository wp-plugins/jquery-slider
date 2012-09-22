<?php

// Adding options page
function js_menu() {
	add_options_page('jQuery Slider','jQuery Slider','manage_options','js_options','js_options');
}
add_action('admin_menu', 'js_menu');

function js_options(){
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	?>
	<form action="options.php" method="post">
	  <div class="wrap">
		<?php wp_nonce_field('update-options') ?>
		  <h2>jQuery Slider <?php _e('Settings', 'jquery_slider') ?></h2>
		  <table border="0" cellspacing="6" cellpadding="6">
			<tr>
			  <td><?php _e('Width', 'jquery_slider') ?></td>
			  <td><input name="js_width" type="text" id="js_width" value="<?php echo get_option('js_width'); ?>" size="4" />px</td>
			</tr>
			<tr>
			  <td><?php _e('Height', 'jquery_slider') ?></td>
			  <td><input name="js_height" type="text" id="js_height" value="<?php echo get_option('js_height'); ?>" size="4" />px</td>
			</tr>
			<tr>
			  <td><?php _e('Pause on hover', 'jquery_slider') ?></td>
			  <td>
			  <select name="js_pause" id="js_pause">
				<option value="true" <?php if(get_option('js_pause') == 'true') echo "selected" ?>><?php _e('Yes', 'jquery_slider') ?></option>
				<option value="false" <?php if(get_option('js_pause') == 'false') echo "selected" ?>><?php _e('No', 'jquery_slider') ?></option>
			  </select></td>
			</tr>
			<tr>
			  <td><?php _e('Show pagination', 'jquery_slider') ?></td>
			  <td>
			  <select name="js_paging" id="js_paging">
				<option value="true" <?php if(get_option('js_paging') == 'true') echo "selected" ?>><?php _e('Yes', 'jquery_slider') ?></option>
				<option value="false" <?php if(get_option('js_paging') == 'false') echo "selected" ?>><?php _e('No', 'jquery_slider') ?></option>
			  </select></td>
			</tr>
			<tr>
			  <td><?php _e('Thumbnail Type', 'jquery_slider') ?></td>
			  <td>
			  <select name="js_thumbtype" id="js_thumbtype">
				<option value="tooltip" <?php if(get_option('js_thumbtype') == 'tooltip') echo "selected" ?>><?php _e('Tooltip', 'jquery_slider') ?></option>
				<option value="navigation" <?php if(get_option('js_thumbtype') == 'navigation') echo "selected" ?>><?php _e('Navigation', 'jquery_slider') ?></option>
			  </select><p class="description" style="display:inline"> Works only if pagination is enabled</p></td>
			</tr>
			<tr>
			  <td><?php _e('Show navigation', 'jquery_slider') ?></td>
			  <td>
			  <select name="js_nav" id="js_nav">
				<option value="true" <?php if(get_option('js_nav') == 'true') echo "selected" ?>><?php _e('Yes', 'jquery_slider') ?></option>
				<option value="false" <?php if(get_option('js_nav') == 'false') echo "selected" ?>><?php _e('No', 'jquery_slider') ?></option>
			  </select></td>
			</tr>
			<tr>
			  <td><?php _e('Show Timer', 'jquery_slider') ?></td>
			  <td>
			  <select name="js_timer" id="js_thumbtype">
				<option value="true" <?php if(get_option('js_timer') == 'true') echo "selected" ?>><?php _e('Yes', 'jquery_slider') ?></option>
				<option value="false" <?php if(get_option('js_timer') == 'false') echo "selected" ?>><?php _e('No', 'jquery_slider') ?></option>
			  </select></td>
			</tr>
			<tr>
			  <td><span class="submit">
			  <input type="hidden" name="action" value="update" />
                <input type="hidden" name="page_options" value="js_width,js_height,js_pause,js_paging,js_nav,js_timer,js_thumbtype" />
				<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'jquery_slider') ?>" />
			  </span></td>
			  <td>&nbsp;</td>
			</tr>
		  </table>
		</div>
	</form>
	<?php
}