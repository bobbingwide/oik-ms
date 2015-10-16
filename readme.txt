=== oik-ms ===
Contributors: bobbingwide, vsgloik
Donate link: http://www.oik-plugins.com/oik/oik-donate/
Tags: shortcodes, smart, lazy
Requires at least: 3.6
Tested up to: 3.6.1
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
oik multisite shortcodes

[bw_blog] to switch to another site or return to the current site


[bw_blog 2]
[bw_link 42]

[bw_blog]
[bw_link 42]


[bw_blogs] to list the WordPress MultiSite sites or a selected list using id=1,2,wpms
 
Now supports copying of oik options fields between sites. See oik options > overview


== Installation ==
1. Upload the contents of the oik-ms plugin to the `/wp-content/plugins/oik-ms' directory
1. Activate the oik-ms plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
= Does this plugin extend oik shortcodes? =
In a future version of oik is will be possible to add blog=id/name to directly to the oik shortcode

= What happens if the shortcode used on another site is not available in the calling site? =
Good question. It won't get expanded.

= Can I merge output from multiple blogs into a single list? =
Not yet, but you can get the appearance of this limiting the number of items returned from each block and not leaving a gap between the results.


== Screenshots ==
1. oik-ms's [bw_blogs] in action
2. oik-ms's [bw_blog] shortcode in action
3. oik-ms's multi-site settings - copy options dialog 


== Upgrade Notice ==
= 0.2 =
Developed for setting up the replacement bobbingwide.com website and other newly created WordPress Multi Site sites

= 0.1 =
This version is dependent upon the oik base plugin
 

== Changelog == 
= 0.2 = 
* Added: Dialog to copy options from a source site. Includes the ability to copy options, more option and even more options.
* Added: Screenshots

= 0.1 =
* Added: brand new code


== Further reading ==
If you want to read more about the oik plugins then please visit the
[oik plugin](http://www.oik-plugins.com/oik) 
**"the oik plugin - for often included key-information"**

