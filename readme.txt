=== oik-ms ===
Contributors: bobbingwide, vsgloik
Donate link: http://www.oik-plugins.com/oik/oik-donate/
Tags: shortcodes, smart, lazy
Requires at least: 4.2
Tested up to: 6.3-beta3
Stable tag: 0.2.2
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

[bw_blogs 1,2 class=w50p2]
[bw_logo link='/']
[/bw_blogs]


Now supports copying of oik options fields between sites. See oik options > overview


== Installation ==
1. Upload the contents of the oik-ms plugin to the `/wp-content/plugins/oik-ms' directory
1. Activate the oik-ms plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
= Does this plugin extend oik shortcodes? =
In a future version of oik it may be possible to add blog=id/name to directly to the oik shortcode

= What happens if the shortcode used on another site is not available in the calling site? =
Good question. It won't get expanded.

= Can I merge output from multiple blogs into a single list? =
Not yet, but you can get the appearance of this limiting the number of items returned from each blog and not leaving a gap between the results.


== Screenshots ==
1. oik-ms's [bw_blogs] in action
2. oik-ms's [bw_blog] shortcode in action
3. oik-ms's multi-site settings - copy options dialog 

== Upgrade Notice ==
= 0.2.2 = 
Now supports PHP 8.2

== Changelog == 
= 0.2.2 =
* Changed: Support PHP 8.1 and PHP 8.2,[github bobbingwide oik-ms issue 4]
* Tested: With WordPress 6.4-beta3 and WordPress Multisite
* Tested: With PHP 8.0, PHP 8.1 and PHP 8.2
* Tested: With PHPUnit 9.6

== Further reading ==
If you want to read more about the oik plugins then please visit the
[oik plugin](https://www.oik-plugins.com/oik) 
**"the oik plugin - for often included key-information"**