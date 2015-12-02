<?php
add_action('admin_menu', 'create_theme_options_page');

function create_theme_options_page() {
    add_options_page('Theme Options', 'Theme Options', 'administrator', basename(__FILE__), 'build_options_page');
}

function build_options_page() {
    ?>
    <style>
        #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
        #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
        #sortable li span { position: absolute; margin-left: -1.3em; }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <div id="theme-options-wrap">
        <script>
            jQuery(function () {
                jQuery("#sortable").disableSelection();
                jQuery("#sortable").sortable({
                    deactivate: function (event, ui) {
                        var order_string = jQuery("#sortable").sortable("toArray").join();
                        jQuery("#order").val(order_string);
                    }
                });

            });

        </script>
        <h2>Display Settings</h2>
        <p>Set custom display options here.</p>
        <ul id="sortable">
            <?php
            $categories = get_category_array();
            foreach ($categories as $category) {
                ?><li class="ui-state-default" id="<?php echo $category->name ?>"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $category->name ?></li>
            <?php } ?>

        </ul>
        <form method="post" action="options.php">
            <?php settings_fields('plugin_options'); ?>
            <?php do_settings_sections(basename(__FILE__)); ?>
            <p> This textbox is used to post the order to the wordpress backend. Do not modify it's contents for now. For final version, this will be hidden. </p>
            <p class="submit">
                <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
            </p>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'register_and_build_fields');

function register_and_build_fields() {
    register_setting('plugin_options', 'plugin_options', 'validate_setting');
    add_settings_section('main_section', 'Main Settings', 'section_cb', basename(__FILE__));
    add_settings_field('category_order', 'Category Display Order', 'category_order_setting', basename(__FILE__), 'main_section');
    add_settings_field('is_live','Enable Live Coverage', 'is_live_setting',basename(__FILE__),'main_section');
}

function validate_setting($plugin_options) {
    return $plugin_options;
}

function section_cb() {
    
}

// Banner Heading
function category_order_setting() {
    $options = get_option('plugin_options');
    echo "<input name='plugin_options[category_order]' type='text' value='{$options['category_order']}'  id='order'/>";
}
function is_live_setting() {
    $options = get_option('plugin_options');
    echo "<input name='plugin_options[is_live]' type='checkbox' value='1'" . checked( 1, $options['is_live'], false ) . "id='live'/>";
}
?>