=== WP Floating Menu Framework  ===
Contributors: Kimiya Kitani
Tags: floating menu,framework
Requires at least: 4.0
Tested up to: 4.0
Stable tag: 1.0.0

The plugin is the framework for setting up the floating menu in WordPress.
 
== Description ==

The plugin is the framework for setting up the floating menu in WordPress. 

I tested up the following themes, but I don't engage the perfect work because I'm not designer.
Please fixing the codes in each JavaScript file or the theme for your environment. 

* Twenty Eleven
* Twenty Twelve
* Twenty Thirteen

== Installation ==

First of all, please install this plugin and activate it.

Then, please select JavaScript(JS) file from the setting menu "Floating Setting Menu" in the setting.

If you want to customize the JS file, please copy the template file in js/templates folder to js folder and rename it.
Then, please select JS file from the setting menu "Floating Setting Menu" in the setting.

Then, fixed the JS file for your WordPress environment (name, page, adminbar values).

= Usage =

Basically, please find out or set up "id" for the page and the floating menu.

ex. If you would like to apply the floating menu to the global navigation bar in Twenty Thirteen theme, 
Please set up the following values in floating-menu.js.

* var name = "#navbar";
* var page = "#page";
* var adminbar = "#wpadminbar";

* "name" value is used for setting up "position: absolute" and controlling floating area.
* "page" value is used for adjusting the margin-top of the web page.

* "adminbar" value is used for adjusting in case of enabling the admin bar (the logged in user).

So, when you use this plugin, you need to set up three id.

For example, 

In case of setting up the following value,

* "name" = "navigation-bar"
* "page" = "page"

the HTML should be the following composition. 

&lt;body&gt;

&lt;div id="page"&gt;

...

  &lt;div id="navigation-bar"&gt;

    .....
    .....

  &lt;/div&gt;

...

&lt;/div&gt;

&lt;/body&gt;


== Frequently Asked Questions ==

= Cannot work on Twenty Ten =

Ummm, I cannot understand the Twenty Ten's layout...
Now, this plugin cannot work this theme. 

== Changelog ==

= 1.0.0 =
* First Released.
