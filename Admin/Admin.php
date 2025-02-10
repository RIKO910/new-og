<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class QUICK_admin{

    /**
     * Define Constant.
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct() {
        add_action('admin_menu', [$this, 'addAdminMenu']);
        add_action('plugins_loaded', [$this, 'attribute_section_setup_gallery_field']);
    }

    /**
     * Select admin menu.
     *
     * @return void
     * @since 1.0.0
     */
    public function addAdminMenu() {
        add_menu_page(
            'Variations Table',
            'Variations Table',
            'manage_options',
            'quick-variable-setting',
            [$this, 'renderDashboard'],
            'dashicons-editor-table',
            20
        );
    }

    /**
     * Dashboard setup.
     *
     * @return void
     * @since 1.0.0
     */
    public function renderDashboard() {
        require_once plugin_dir_path(__FILE__) . 'Dashboard.php';
    }

    /**
     * Variation gallery and attribute setup field all hook initialization.
     *
     * @return void
     * @since 1.0.3
     */
    public function attribute_section_setup_gallery_field() {

        add_action( 'woocommerce_after_edit_attribute_fields', array($this,'wc_custom_attribute_field'), 10 );
        add_action( 'woocommerce_after_add_attribute_fields', array($this, 'wc_custom_attribute_field') );
        add_action( 'woocommerce_attribute_added', array($this, 'wc_save_custom_attribute_field'), 10, 2 );
        add_action( 'woocommerce_attribute_updated', array($this, 'wc_save_custom_attribute_field'), 10, 3 );

        $attributes = wc_get_attribute_taxonomies();
        foreach ($attributes as $attribute) {
            $taxonomy = 'pa_' . $attribute->attribute_name;
            add_action("{$taxonomy}_add_form_fields", [$this, 'wc_custom_attribute_add_form_fields'], 10, 1);
            add_action("{$taxonomy}_edit_form_fields", [$this, 'wc_custom_attribute_edit_form_fields'], 10, 2);

            // Adding column filters and actions.
            add_filter("manage_edit-{$taxonomy}_columns", function ($columns) use ($taxonomy) {
                return $this->add_color_image_columns($columns, $taxonomy);
            }, 10, 1);

            add_action("manage_{$taxonomy}_custom_column", function ($content, $column_name, $term_id) use ($taxonomy) {
                return $this->populate_color_image_columns($content, $column_name, $term_id, $taxonomy);
            }, 10, 3);
        }

        add_action( 'created_term', array($this, 'wc_save_custom_created_term'), 10, 3 );
        add_action( 'edit_term', array($this, 'wc_save_custom_edit_term'), 10, 3);

        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    /**
     * Custom attribute field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_custom_attribute_field( $attribute ) {
        $attribute_id       = isset( $attribute->attribute_id ) ? $attribute->attribute_id : ( isset( $_GET['edit'] ) ? intval( $_GET['edit'] ) : 0 );
        $display_type       = get_option( 'wc_attribute_display_type_' . $attribute_id );
        $tooltip_permission = get_option( 'wc_attribute_tooltip_permission_' . $attribute_id );


        wp_nonce_field( 'save_attribute_display_type', 'attribute_display_type_nonce' );
        ?>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="attribute_display_type"><?php esc_html_e( 'Display Type', 'product-variation-table-with-quick-cart' ); ?></label>
            </th>
            <td>
                <select name="attribute_display_type" id="attribute_display_type">
                    <option value="select" <?php selected( $display_type, 'select' ); ?>><?php esc_html_e( 'Select', 'product-variation-table-with-quick-cart' ); ?></option>
                    <option value="color" <?php selected( $display_type, 'color' ); ?>><?php esc_html_e( 'Color', 'product-variation-table-with-quick-cart' ); ?></option>
                    <option value="image" <?php selected( $display_type, 'image' ); ?>><?php esc_html_e( 'Image', 'product-variation-table-with-quick-cart' ); ?></option>
                    <option value="button" <?php selected( $display_type, 'button' ); ?>><?php esc_html_e( 'Button', 'product-variation-table-with-quick-cart' ); ?></option>
                    <option value="radio" <?php selected( $display_type, 'radio' ); ?>><?php esc_html_e( 'Radio', 'product-variation-table-with-quick-cart' ); ?></option>
                </select>
                <p class="description"><?php esc_html_e( 'Select how this attribute should be displayed on the product page.', 'product-variation-table-with-quick-cart' ); ?></p>
            </td>
        </tr>

        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="attribute_tooltip_permission"><?php esc_html_e( 'Tooltip Show', 'product-variation-table-with-quick-cart' ); ?></label>
            </th>
            <td>
                <input type="checkbox" id="attribute_tooltip_permission" name="attribute_tooltip_permission" value="yes"
                    <?php checked($tooltip_permission, 'yes'); ?>>
                <p class="description"><?php esc_html_e( 'If you want to show tooltip on above attribute then check it.', 'product-variation-table-with-quick-cart' ); ?></p>
            </td>
        </tr>
        <?php
    }

    /**
     * Save custom attribute field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_save_custom_attribute_field( $attribute_id, $attribute = null, $old_attribute = null ) {

        if ( ! isset( $_POST['attribute_display_type_nonce'] ) || ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['attribute_display_type_nonce'])), 'save_attribute_display_type' ) ) {
            return;
        }

        if ( isset( $_POST['attribute_display_type'] ) ) {
            $display_type = sanitize_text_field( wp_unslash( $_POST['attribute_display_type'] ) );
            update_option( 'wc_attribute_display_type_' . $attribute_id, $display_type );
        }

        if (isset($_POST['attribute_tooltip_permission'])) {
            $tooltip_permission = sanitize_text_field(wp_unslash($_POST['attribute_tooltip_permission']));
            update_option('wc_attribute_tooltip_permission_' . $attribute_id, $tooltip_permission);
        } else {
            // Explicitly save 'no' when the checkbox is unchecked
            update_option('wc_attribute_tooltip_permission_' . $attribute_id, 'no');
        }
    }

    /**
     * Attribute new term custom field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_custom_attribute_add_form_fields($taxonomy ) {

        $attributes   = wc_get_attribute_taxonomies();
        $attribute_id = null;
        foreach ($attributes as $attribute) {
            if ('pa_' . $attribute->attribute_name === $taxonomy) {
                $attribute_id = $attribute->attribute_id;
                break;
            }
        }

        $display_type = get_option( 'wc_attribute_display_type_' . $attribute_id );

        if ($display_type === 'color') {
            ?>
            <div class="form-field product_attribute_color">
                <label for="term_color"><?php esc_html_e('Color', 'product-variation-table-with-quick-cart'); ?></label>
                <input name="term_color" id="term_color" type="text" value="" class="wvs-color-picker" data-default-color="#ffffff">
                <p class="description"><?php esc_html_e('Select a color for this term.', 'product-variation-table-with-quick-cart'); ?></p>
            </div>

            <div class="form-field product_attribute_color">
                <label for="term_secondary_color"><?php esc_html_e('Secondary Color', 'product-variation-table-with-quick-cart'); ?></label>
                <input name="term_secondary_color" id="term_secondary_color" type="text" value="" class="wvs-color-picker" data-default-color="#ffffff">
                <p class="description"><?php esc_html_e('Select a secondary color for this term.', 'product-variation-table-with-quick-cart'); ?></p>
            </div>
            <?php
        }elseif ($display_type === 'image') {
            ?>
            <div class="form-field">
                <label for="term_image_add_new"><?php esc_html_e('Image', 'product-variation-table-with-quick-cart'); ?></label>
                <input type="hidden" name="term_image_add_new" id="term_image_add_new" value="">
                <div style="display: flex; gap: 20px; align-items: center" >
                    <button type="button" class="button" id="upload_image_button_add_new"><?php esc_html_e('Upload Image', 'product-variation-table-with-quick-cart'); ?></button>
                    <img id="term_image_preview_add_new" src="" alt="No Image Selected" style="max-width: 70px; height: auto; display: none; border: 1px solid lightgrey; border-radius: 5px">
                </div>
                <p class="description">Upload an image for this term.</p>
            </div>
            <?php
        }
        ?>
        <div class="form-field">
            <label for="add_term_tooltip">Tool Tip</label>
            <input type="text" name="add_term_tooltip" id="add_term_tooltip" value="<?php echo esc_attr($term_name ?? ''); ?>">
            <p class="description">Add your custom Tooltip or it will default to the term name.</p>
        </div>
        <?php
    }

    /**
     * Attribute edit term custom field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_custom_attribute_edit_form_fields($term, $taxonomy) {

        $attributes   = wc_get_attribute_taxonomies();
        $attribute_id = null;
        foreach ($attributes as $attribute) {
            if ('pa_' . $attribute->attribute_name === $taxonomy) {
                $attribute_id = $attribute->attribute_id;
                break;
            }
        }

        $display_type = get_option( 'wc_attribute_display_type_' . $attribute_id );
        $term_id      = $term->term_id;
        $color        = get_term_meta($term_id, 'term_color', true);
        $secondaryColor        = get_term_meta($term_id, 'term_secondary_color', true);
        $image        = get_term_meta($term_id, 'term_image', true);
        $tooltip      = get_term_meta($term_id, 'term_tooltip', true);

        if ($display_type === 'color') {
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="term_color">Color</label></th>
                <td>
                    <input class="wvs-color-picker" data-default-color="#ffffff" type="text" name="term_color" id="term_color" value="<?php echo esc_attr($color); ?>">
                    <p class="description">Select a color for this term.</p>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="term_secondary_color">Secondary Color</label></th>
                <td>
                    <input class="wvs-color-picker" data-default-color="#ffffff" type="text" name="term_secondary_color" id="term_secondary_color" value="<?php echo esc_attr($secondaryColor); ?>">
                    <p class="description">Select a secondary color for this term.</p>
                </td>
            </tr>
            <?php
        }elseif ($display_type === 'image') {
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="term_image">Image</label></th>
                <td>
                    <!-- Display the selected image -->
                    <?php if (!empty($image)): ?>
                        <img id="term_image_preview" src="<?php echo esc_url($image); ?>" alt="Selected Image" style="max-width: 70px; height: auto; display: block; margin-bottom: 10px; border: 1px solid lightgrey; border-radius: 5px">
                    <?php else: ?>
                        <img id="term_image_preview" src="" alt="No Image Selected" style="max-width: 70px; height: auto; display: none; margin-bottom: 10px; border: 1px solid lightgrey; border-radius: 5px">
                    <?php endif; ?>

                    <!-- Input field to update image -->
                    <input type="hidden" name="term_image" id="term_image" value="<?php echo esc_attr($image); ?>">
                    <div>
                        <button type="button" class="button" id="upload_image_button">Upload Image</button>
                        <button type="button" style="background-color: firebrick; color: white; border: none" class="button " id="upload_image_button_remove">Remove Image</button>
                    </div>
                    <p class="description">Upload an image.</p>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="edit_term_tooltip">Tool Tip</label></th>
            <td>
                <input type="text" name="edit_term_tooltip" id="edit_term_tooltip" value="<?php echo esc_attr($tooltip); ?>">
                <p class="description">Add your custom Tooltip or it will be default term name.</p>
            </td>
        </tr>
        <?php
    }

    /**
     * Save attribute new term custom field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_save_custom_created_term($term_id, $tt_id, $taxonomy) {
        if (isset($_POST['term_color'])) {
            update_term_meta($term_id, 'term_color', sanitize_text_field($_POST['term_color']));
        }

        if (isset($_POST['term_secondary_color'])) {
            update_term_meta($term_id, 'term_secondary_color', sanitize_text_field($_POST['term_secondary_color']));
        }

        if (isset($_POST['term_image_add_new'])) {
            update_term_meta($term_id, 'term_image', esc_url_raw($_POST['term_image_add_new']));
        }

        if (isset($_POST['add_term_tooltip']) && !empty($_POST['add_term_tooltip'])) {
            update_term_meta($term_id, 'term_tooltip', sanitize_text_field($_POST['add_term_tooltip']));
        } else {
            // Default to term name if tooltip is not provided
            $term = get_term($term_id);
            update_term_meta($term_id, 'term_tooltip', sanitize_text_field($term->name));
        }
    }

    /**
     * Save attribute edit term custom field.
     *
     * @return void
     * @since 1.0.3
     */
    public function wc_save_custom_edit_term($term_id, $tt_id, $taxonomy) {
        if (isset($_POST['term_color'])) {
            update_term_meta($term_id, 'term_color', sanitize_text_field($_POST['term_color']));
        }

        if (isset($_POST['term_secondary_color'])) {
            update_term_meta($term_id, 'term_secondary_color', sanitize_text_field($_POST['term_secondary_color']));
        }

        if (isset($_POST['term_image'])) {
            update_term_meta($term_id, 'term_image', esc_url_raw($_POST['term_image']));
        }

        if (isset($_POST['edit_term_tooltip']) && !empty($_POST['edit_term_tooltip'])) {
            update_term_meta($term_id, 'term_tooltip', sanitize_text_field($_POST['edit_term_tooltip']));
        } else {
            // Default to term name if tooltip is not provided
            $term = get_term($term_id);
            update_term_meta($term_id, 'term_tooltip', sanitize_text_field($term->name));
        }
    }

    /**
     * Add color image column into attribute term table.
     *
     * @return array
     * @since 1.0.3
     */
    public function add_color_image_columns($columns, $taxonomy) {
        $attributes = wc_get_attribute_taxonomies();

        // Find the attribute ID for the current taxonomy
        $attribute_id = null;
        foreach ($attributes as $attribute) {
            if ('pa_' . $attribute->attribute_name === $taxonomy) {
                $attribute_id = $attribute->attribute_id;
                break;
            }
        }

        $display_type = get_option( 'wc_attribute_display_type_' . $attribute_id );
        $new_columns  = [];
        foreach ($columns as $key => $value) {
            $new_columns[$key] = $value;
            if ($key === 'slug') {
                if ($display_type === 'color') {
                    $new_columns['color'] = __('Color', 'product-variation-table-with-quick-cart');
                }elseif ($display_type === 'image') {
                    $new_columns['image'] = __('Image', 'product-variation-table-with-quick-cart');
                }
            }
        }
        return $new_columns;
    }

    /**
     * Show color image column into attribute term table.
     *
     * @return mixed | null | string
     * @since 1.0.3
     */
    public function populate_color_image_columns($content, $column_name, $term_id, $taxonomy) {
        // Get all attributes
        $attributes = wc_get_attribute_taxonomies();

        // Find the attribute ID for the current taxonomy
        $attribute_id = null;
        foreach ($attributes as $attribute) {
            if ('pa_' . $attribute->attribute_name === $taxonomy) {
                $attribute_id = $attribute->attribute_id;
                break;
            }
        }

        $display_type = get_option( 'wc_attribute_display_type_' . $attribute_id );

        if ($column_name === 'color' && $display_type === 'color') {
            $color = get_term_meta($term_id, 'term_color', true);
            $secondaryColor = get_term_meta($term_id, 'term_secondary_color', true);
            if ($color) {
                if ($secondaryColor) {
                    $content = '<span style="
                    display: inline-block; 
                    width: 20px; 
                    height: 20px; 
                    background: linear-gradient(to right, ' . esc_attr($color) . ' 50%, ' . esc_attr($secondaryColor) . ' 50%);
                    border: 1px solid #ccc; 
                    border-radius: 3px;
                "></span>';
                } else {
                    $content = '<span style="
                    display: inline-block; 
                    width: 20px; 
                    height: 20px; 
                    background-color: ' . esc_attr($color) . '; 
                    border: 1px solid #ccc; 
                    border-radius: 3px;
                "></span>';
                }
            } else {
                $content = __('—', 'product-variation-table-with-quick-cart');
            }
        }
        if ($column_name === 'image' && $display_type === 'image') {
            $image = get_term_meta($term_id, 'term_image', true);
            if ($image) {
                $content = '<img src="' . esc_url($image) . '" alt="' . esc_attr__('Term Image', 'product-variation-table-with-quick-cart') . '" style="max-width: 50px; height: auto;">';
            } else {
                $content = __('—', 'product-variation-table-with-quick-cart');
            }
        }
        return $content;
    }

    /**
     * Enqueue script.
     *
     * @return void
     * @since 1.0.2
     */
    public function enqueueAssets() {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery');
        wp_enqueue_script(
            'variation-gallery-admin',
            plugin_dir_url(dirname(__FILE__)) . 'Assets/JS/admin.js',
            ['jquery', 'wp-color-picker'],
            '1.0.0',
            true
        );
    }

}