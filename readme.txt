=== Gallery-Extended ===
Contributors: Alexey Vidanov
Tags: plugin, posts, gallery,admin,image 
Requires at least: 3.0
Tested up to: 3.2
Stable tag: 1.2

This plugin adds to [gallery] short code the start and end attributes to enable slice the post gallery and show different parts of them.

== Description ==

= This plugin is out of date! Please use it instead of the standard functionality. =

With this plugin it is possible to put the part of the gallery in the post using start and stop attributes. 

Example of use:
Turn on HTML, put the code like this
[gallery link=file start=1 end=3]
Some content
[gallery link=file start=4 end=6]
Some other content
[gallery link=file start=7]

It will show the first 3 images, then some content, then the images from 4 to 6, then some other content and then the rest of the gallery. It could be useful for large posts with many images inside.
Better CSS (in external file) and the oldest images at the top by default. You can set now default link mode for images (standard wordpress or always link images in the gallery to file or alway link to the attachment page)


= Features =
* start and end attributes to show selected part of the gallery and put some content between
* you can add more picture to illustrate the post and do not output all of them in the gallery with simple trick
* CSS style in the external file for better HTML
* rel attribute for fancy box included
* you can set for the site default link mode for images (standard wordpress or always link images in the gallery to file or alway link to the attachment page)

== Installation ==

1. Upload `gallery-extended` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. You can adapt gallery CSS file gallery-extended/gallery.css for your purpose.

== Frequently Asked Questions ==
If you have any questions or comments, please drop me an email: http://vidanov.com/ contact

== Screenshots ==

1. Admin page
2. Frontend
3. Options page

== Changelog ==

= 1.0 =
* Initial release
= 1.01 =
* Fixed Call to undefined function get_post_thumbnail_id()  error 
= 1.1 =
* Added options page 
= 1.2 =
* Numbers fix


== Upgrade Notice ==

= 1.0 =
* Initial release
= 1.01 =
* Fixed Call to undefined function get_post_thumbnail_id()  error 
= 1.1 =
* Added options page 
