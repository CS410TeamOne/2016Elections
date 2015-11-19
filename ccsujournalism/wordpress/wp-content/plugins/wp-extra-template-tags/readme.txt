=== WP Extra Template Tags ===
Tags: template, tags, post, page, permalink, admin
Requires at least: 2.5
Tested up to: 2.6
Stable tag: 0.4

This plugin provides Wordpress users with extra template tags. It can be used in themes or plugins.

== Description ==

= Wordpress template tags =

To make it easy to edit themes and plugins there are many build in <a href="http://codex.wordpress.org/Template_Tags">template tags</a> within the Wordpress code. I did not found all the tags I wanted so I created them and now provides as a plugin.

For usage go to "<a href='http://wordpress.org/extend/plugins/wp-extra-template-tags/installation/'>Installation</a>"

= Updates =

<code>0.4 - _get_category_count() and _category_count() functions updated
0.3 - _get_depth(), _is_child(), is_grandchild() functions created
0.2 - _get_the_content_with_formatting() function created
0.1 - Plugin created</code>

= Prevents collisions =

Every extra template tag with this plugin has an underscore before the function name. That is to prevent collisions if the Wordpress team develop the functions in the future.

= Add an extra template tag =

If you have an own extra template tag, send it to me and if it is a good one I will include it in the next plugin update. For bug reports, donations, feedback, more plugins and themes visit <a href="http://www.web-templates.nu/2008/08/25/wp-extra-template-tags/" title="web-templates.nu">web-templates.nu</a>

== Installation ==

1. Upload the FOLDER 'wp-extra-template-tags' to the '/wp-content/plugins/'
2. Activate the plugin 'WP Extra Template Tags' through the 'Plugins' menu in admin
3. Call the functions of your choice from your theme or plugin

= Category ID =

Displays or returns the numeric ID of the category a post belongs to. This tag must be used within The Loop.

<code>&lt;?php _category_ID(); ?&gt;
&lt;?php echo _get_category_ID(); ?&gt;</code>

= Category Parent ID =

Displays or returns the numeric parent ID of the category a post belongs to. This tag must be used within The Loop.

<code>&lt;?php _category_parent_ID(); ?&gt;
&lt;?php echo _get_category_parent_ID(); ?&gt;</code>

= Category Slug =

Displays or returns the category slug/nicename of the category a post belongs to. This tag must be used within The Loop.

<code>&lt;?php _category_slug(); ?&gt;
&lt;?php echo _get_category_slug(); ?&gt;</code>

= Category Name =

Displays or returns the name/title of the category a post belongs to. This tag must be used within The Loop.

<code>&lt;?php _category_name(); ?&gt;
&lt;?php echo _get_category_name(); ?&gt;</code>

= Category Count =

Displays or returns the number of posts within a category. It can be used with a post ID, post slug (nicename) or empty used within The Loop.

<code>&lt;?php _category_count(); ?&gt;
&lt;?php _category_count(3); ?&gt;
&lt;?php _category_count('about'); ?&gt;
&lt;?php echo _get_category_count(); ?&gt;
&lt;?php echo _get_category_count(3); ?&gt;
&lt;?php echo _get_category_count('about'); ?&gt;</code>

= Get Category Name By ID =

Returns the name/title of the category ID.

<code>&lt;?php echo _get_category_name_by_ID(3); ?&gt;</code>

= Get Category ID By Name =

Returns the ID of the category slug/nicename.

<code>&lt;?php echo _get_category_ID_by_name('about'); ?&gt;</code>

= User ID =

Displays or returns the user ID of the logged in user.

<code>&lt;?php _user_id(); ?&gt;
&lt;?php echo _get_user_id(); ?&gt;</code>

= User Name =

Displays or returns the user name of the logged in user.

<code>&lt;?php _user_name(); ?&gt;
&lt;?php echo _get_user_name(); ?&gt;</code>

= User Level =

Displays or returns the user level of the logged in user.

<code>&lt;?php _user_level(); ?&gt;
&lt;?php echo _user_level(); ?&gt;</code>

= ID by Page Name =

Returns the page ID by page or post slug/nicename.

<code>&lt;?php echo _get_ID_by_page_name('about'); ?&gt;</code>

= Name by Page ID =

Returns the page slug/nicename by page or post ID.

<code>&lt;?php echo _get_name_by_page_ID(3); ?&gt;</code>

= Max Pages =

Displays or returns the max amount of pages per post. This tag must be used within The Loop.

<code>&lt;?php _max_pages(); ?&gt;
&lt;?php echo _get_max_pages(); ?&gt;</code>

= Depth =

Returns the depth of a page. It can be used with a page ID or empty used within The Loop.

<code>&lt;?php echo _get_depth(); ?&gt;
&lt;?php echo _get_depth(3); ?&gt;</code>

= Is Child =

Returns true if the current page is a child. It can be used with a page ID or empty used within The Loop.

<code>&lt;?php if(_is_child()) { echo 'This is a child page'; } ?&gt;
&lt;?php if(_is_child(3)) { echo 'This is a child page'; } ?&gt;</code>

= Is Grandchild =

Returns true if the current page is a grandchild.

<code>&lt;?php if(_is_grandchild()) { echo 'This is a grandchild page'; } ?&gt;</code>

= Delete Post Link =

Displays a link to delete current post or page for logged in administrators. Be careful!

<code>&lt;?php _delete_post_link(); ?&gt;</code>

= Get The Content with Formatting =

Returns get_the_content() tag WITH formatting like the_content().

<code>&lt;?php echo _get_the_content_with_formatting(); ?&gt;</code>

= Parent Permalink =

Displays or returns the parent permalink. This tag must be used within The Loop.

<code>&lt;?php _parent_permalink(); ?&gt;
&lt;?php echo _get_parent_permalink(); ?&gt;</code>

= Permalink by Name =

Displays or returns the permalink by page or post slug/nicename.

<code>&lt;?php _permalink_by_name('about'); ?&gt;
&lt;?php echo _get_permalink_by_name('about'); ?&gt;</code>

== Frequently Asked Questions ==

= How do I report a bug? =

Contact me <a href="http://www.web-templates.nu/2008/08/25/wp-extra-template-tags/">here</a>. Describe the problem as good as you can, your plugin version, Wordpress version and possible conflicting plugins and so on.

= How can I support this plugin? =

The best way to contribute is to spread the word, link to <a href="http://www.web-templates.nu/2008/08/25/wp-extra-template-tags/">WP Extra Template Tags</a>, blog about WP Extra Template tags or give me feedback. All kinds of feedback are helpful to me. Suggestions and bug report are also welcome.

= Where can I use the extra template tags? =

You could use them in your theme. If you want you can use them within plugins as well.