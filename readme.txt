=== jQuery Slider ===

Contributors: vijaybidla
Tags: jQuery, Slider, Gallery, Plugin, Widget
Requires at least: 2.8
Tested up to: 3.4.2
Stable tag: 1.4.2
License: GPLv2

This is a highly customizable jQuery Slider plugin. You can set its width, height, pagination and other parameters.

== Description ==

This is a highly customizable jQuery Slider plugin. You can set its width, height, pagination and other
parameters. You can use it on your post or page using schortcode `[jQuery Slider]` or in your template 
file  using php function `<?php if(function_exists('jquery_slider')){ jquery_slider(); } ?>`.

Slides can be added as post type slide from slides menu.

For more details, please visit: http://www.iwebrays.com/

== Installation ==

1. Download the plugin
2. Upload the `jquery-slider` folder to the `/wp-content/plugins/` folder
3. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. This is how the slider will look on you post or page.
2. Go to /wp-admin/options-general.php?page=js_options to configure the slider.
3. Go to slides menu /wp-admin/edit.php?post_type=slide
4. Click on Add New button /wp-admin/post-new.php?post_type=slide. You can set its description and slide
image via posts content area and featured image section.

== Changelog ==


= 1.4.2 =
* Added thumbnail in slides list in admin.

= 1.4.1 =
* Fixed broken plugin issue.

= 1.4 =
* Added timthumb.php script to resize images.
* Fixed setting options not working bug.
* Added option to show/hide timer.
* Added option to select type of thumbnail.

= 1.3 =
Made plugin tranlation compatible.

= 1.2 =
Fixed some bugs in shortcode feature.

= 1.1 =
* Automatically add "featured image" theme support to activated theme.
* This version doesn't give "Headers already sent..." error upon activation.
* Available to be embedded into posts or pages via shortcode feature.

== Upgrade Notice ==

= 1.2 =
Fixed some bugs in shortcode feature.

= 1.1 =
This version doesn't give "Headers already sent..." error upon activation. Also added shortcode feature.