=== WP FullPage ===
Contributors: Julien Zerbib
Tags: fullpage, fullscreen, scrolling, theme, parallax, page builder, lazy, loading, responsive, easing, overlay, material, design
Requires at least: 3.5
Tested up to: 4.6.1
Stable tag: 4.0.5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Change your WordPress website to a Fullscreen Scrolling one using fullPage.js

== Description ==
Wp Fullpage integrates the power of [fullPage.js](https://github.com/alvarotrigo/fullPage.js "fullPage.js") into your WordPress website.

= Examples =
Browse some [examples](http://wp-fullpage.juzed.fr/ "WP FullPage on JuZED.fr").

= Demo Website =
Try out the [demo](http://wp-fullpage-demo.juzed.fr/admin "WP FullPage Demo on JuZED.fr") (user: demo / pwd: demo).

= FAQ =
Browse [questions](http://wp-fullpage.juzed.fr/faq/ "WP FullPage FAQ on JuZED.fr").

= New Features =
1. Style your fullpage directly from the back office (in Design Parameters tabs).
2. Parallax effects are more fluid than ever and work now on CSS3 mode.
3. Add to background images some colored overlays using Slide and Section Color (Styling / Design Parameters, choose a color and reduce its opacity).
4. New [Materialize](http://materializecss.com/ "Materialize") UI, more easy to use.
5. New easy to use [Ace editor](https://ace.c9.io/#nav=about "Ace editor") to add your own javascript in events and your own CSS. No need to modify anymore the js files in your template to get what you want. If you really need to do that, you can add you own javascript in "/wp-content/themes/YOURTHEME/wp-fullpage/js/jquery.fullpage.theme.js" (take a look at "Customization" to do so).
6. A DOM Ready Event has been added to setup your own javascript code on DOM Ready.
7. New templating system. Add your own theme styles to "/wp-content/themes/YOURTHEME/wp-fullpage/css/jquery.fullpage.theme.css" instead of modifying the huge custom CSS file (take a look at "Customization" to do so).
8. New options from [fullPage.js](https://github.com/alvarotrigo/fullPage.js "fullPage.js") implemented. You can now for example add a auto height section... Very useful to make a footer!
9. Now you can chose between lazy loaded backgrounds (once the section or slide is loaded) or a "All at once" backgrounds loading.
10. A debug (Verbose mode) has been added so you can follow the code execution.
11. Now compatible with page builders (tested with [Divi builder](http://www.elegantthemes.com/plugins/divi-builder/ "Divi Builder") and [Page Builder by SiteOrigin](https://wordpress.org/plugins/siteorigin-panels/ "Page Builder by SiteOrigin")). You can use your favorite Page Builder to customize your Slides or simple Sections as you want.
12. Display what you want in your slides and simple sections. You can choose to display or not titles, section titles, metas, ...
13. Now, in CSS3 mode, you can chose a transition effect by FullPage (vertical) and Section (horizontal) independently. 
14. Many js and CSS3 transition effects available. 
15. You can now disable FullPage vertical Scrolling for smaller screens modifying "Responsive width / height" value.
16. Pages can now be used as FullPages.

= How to use =
1. Create Fullpage Sections and Slides and integrates them into a Fullpage or a Page.
2. Replace Sections and Slides by a list of any type of post.
3. Setup your Fullpage with many options from [fullPage.js](https://github.com/alvarotrigo/fullPage.js "fullPage.js").
4. Easely style your fullpage, sections and slides directly from the back office.
5. Add a featured image to your section, slide or post, and it will appear as background of the section or the slide.

= Customization =
1. Customize FullPage templates and functionalities by copying the contents of "/wp-content/plugins/wp-fullpage/templates/" into "/wp-content/themes/YOURTHEME/wp-fullpage/".
2. Many hook filters and actions are available too.

= Documentation =
Read the [full documentation](http://docs.juzed.fr/wp-fullpage "WP FullPage Documentation")

[Contact me](http://www.juzed.fr/en/contact-form/ "Contact me") if you want to know how to customise WP FullPage.

== Installation ==
1. Upload "wp-fullpage.zip" to the "/wp-content/plugins/" directory.
2. Unzip archive.
3. Activate the plugin through the "Plugins" menu in WordPress.
4. Go to "Settings/Wp FullPage" for default settings.

= Upgrade Notice =
If you already customized your FullPage templates and you want to get the new features, you'll have to upgrade your templates too.
Otherwise your FullPage will work the same.

== Changelog ==
= 4.0.5.2 =
*   Materialize tooltips compatibility issue with Bootstrap fixed using 'm_tooltip()' instead of 'tooltip()'
= 4.0.5.1 =
*   Some bug fixes regarding range inputs
= 4.0.5 =
*   Change the way Dynamic css is built using script template
*   Testing compatibility with WP 4.6.1
= 4.0.4.3 =
*   Fixed compatibility with Materialize 
= 4.0.4.2 =
*   Trailing slash removed from front scripts
= 4.0.4.1 =
*   PHP error fixed
= 4.0.4 =
*   Fixed conflict issues with Bootstrap and Advanced Content Field
= 4.0.3 =
*   Fixed nav not selected on page load
*   "will-change" issue on firefox fixed.
*   Deprecated methods removed.
= 4.0.2 =
*   Add ace.js editor in full width mode.
= 4.0.1.3 =
*   Bug fixes: jquery and Materialize conflicts resolved.
*   Some other bug fixes.
= 4.0.1.2 =
*   readme.txt updated. Demo website added.
= 4.0.1.1 =
*   Some bug fixes.
*   readme.txt updated.
= 4.0.1 =
*   Some bug fixes.
= 4.0 =
*   UI improvments and new options added.
*   Add [Materialize](http://materializecss.com/ "Materialize").
*   Add [Ace editor](https://ace.c9.io/#nav=about "Ace editor").
*   Many options added.
*   fullPage.js Upgrade to 2.7.7.
*   Bug fixes on Parallax effect.
*   Bug fixes.
= 3.1.2 =
*   Bug fixes on sections and slides per fullpage
= 3.1.1 =
*   Bug fixes on WP 4.1
= 3.1 =
*   Admin Bug Fixes
= 3.0 =
*   New parallax effect
= 2.2 =
*   New options added
= 2.1 =
*   UI improvments + fullPage.js upgrade to 2.4.3 
= 2.0.1 =
*   Bug fixes
= 2.0 =
*   FullPage options added to Pages
= 1.5 =
*   fullPage.js Upgrade to 2.4.1 and bug fixes in Back Office
= 1.4 =
*   Removing of feature of empty post type in permalink for fullpage post type. 
= 1.3 =
*   Remove fullpage post-type in permalink and add fullpage to the front page dropdown. 
= 1.2 =
*   Condition updated. 
= 1.1 =
*   Dropdown Pages Filter to add Fullpage Post Type pages to "Settings / Reading" Page. 
= 1.0 =
*   Initial release. 
