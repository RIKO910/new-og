<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $product;
$all_attributes                 = $product->get_attributes();
$product_id                     = $product->get_id();
$enable_global_stock_management = $product->get_manage_stock();
$global_stock_quantity          = $enable_global_stock_management ? $product->get_stock_quantity() : null;
$variableSetting                = get_option('quick_variable_all_checked', array());
$imageHideShow                  = isset($variableSetting['imageHideShow']) ? $variableSetting['imageHideShow'] : '';
$skuHideShow                    = isset($variableSetting['skuHideShow']) ? $variableSetting['skuHideShow'] : '';
$allAttributeHideShow           = isset($variableSetting['allAttributeHideShow']) ? $variableSetting['allAttributeHideShow'] : '';
$priceHideShow                  = isset($variableSetting['priceHideShow']) ? $variableSetting['priceHideShow'] : '';
$quantityHideShow               = isset($variableSetting['quantityHideShow']) ? $variableSetting['quantityHideShow'] : '';
$actionHideShow                 = isset($variableSetting['actionHideShow']) ? $variableSetting['actionHideShow'] : '';
$cartButtonText                 = isset($variableSetting['cartButtonText']) ? $variableSetting['cartButtonText'] : 'Add-to-cart';

?>

<div id="mobile-quick-variable-table">
    <?php
    $variations = $product->get_available_variations();
    foreach ($variations as $var) {
        $variation_id             = $var['variation_id'];
        $variation                = new WC_Product_Variation($variation_id);
        $variation_stock_quantity = $variation->get_manage_stock() ? $variation->get_stock_quantity() : null;
        $thumbnail_id             = $variation->get_image_id();
        $thumbnail_html           = wp_get_attachment_image($thumbnail_id, 'thumbnail', false, [
            'alt' => esc_attr($variation->get_name()),
            'height' => '100px',
        ]);
        $thumbnail_url            = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, "thumbnail") : '';
        ?>
        <div class="mobile-variation-card-row-template-4">
            <div style="display:flex; width: 100%; gap: 10px" >
                <?php if ($imageHideShow === "true"){
                    ?>
                    <div class="" style="width: 50%">
                        <?php echo wp_kses_post($thumbnail_html); ?>
                    </div>
                <?php
                }?>

                <!-- Attributes Section -->
                <div class="">
                    <?php if ($skuHideShow === "true"){
                        ?>
                        <span style="text-overflow: ellipsis; overflow: hidden;"><?php echo esc_html($variation->get_sku()); ?></span>
                        <?php
                    }?>

                    <?php if ($allAttributeHideShow === "true"){
                        ?>
                        <div class="mobile-attributes-list">
                            <?php foreach ($all_attributes as $attribute_name => $attribute) {
                                $attribute_value = $variation->get_attribute($attribute_name);

                                // Check if the attribute is a taxonomy
                                $taxonomy = taxonomy_exists($attribute_name) ? get_taxonomy($attribute_name) : null;

                                // Determine the label for the attribute
                                $label = $taxonomy ? str_replace("Product ", "", $taxonomy->label) : ucfirst($attribute_name);

                                if (empty($attribute_value)) {
                                    // Display a dropdown if the attribute value is empty
                                    echo "<div><label>" . esc_html($label) . ":</label> ";
                                    echo "<select class='quick-attribute-select' name='attribute_" . esc_attr($attribute_name) . "' data-attribute-name='" . esc_attr($attribute_name) . "'>";

                                    if ($attribute->is_taxonomy()) {
                                        $options = wc_get_product_terms($product->get_id(), $attribute_name, ['fields' => 'names']);
                                    } else {
                                        $options = $attribute->get_options();
                                    }

                                    foreach ($options as $option) {
                                        echo "<option value='" . esc_attr($option) . "'>" . esc_html($option) . "</option>";
                                    }

                                    echo "</select></div>";
                                } else {
                                    // Display the static attribute value
                                    echo "<div><label>" . esc_html($label) . ":</label> ";
                                    echo "<span class='quick-attribute-text'>" . esc_html($attribute_value) . "</span></div>";
                                }
                            } ?>
                        </div>
                        <?php
                    }?>


                    <?php if ($priceHideShow === "true"){
                        ?>
                        <div class="">
                            <span><?php echo wp_kses_post($variation->get_price_html()); ?></span>
                        </div>
                        <?php
                    }?>

                </div>
            </div>

            <div style="display: flex; gap: 30px; justify-content: center">
                <?php if ($quantityHideShow === "true"){
                    ?>
                    <div class="quick-quantity-container" style="margin-bottom: 10px">
                        <button class="quick-quantity-decrease" id="decrease">-</button>
                        <input type="text" id="quantity" autocomplete="off" class="quick-quantity-input" value="1" data-max="<?php echo esc_attr($variation_stock_quantity ?: $global_stock_quantity ?: 99); ?>">
                        <button class="quick-quantity-increase" id="increase">+</button>
                    </div>
                    <?php
                }?>

                <div style="margin-top: 10px">
                    <div class="quick-cart-notification quick-hidden"></div>
                    <?php if ($actionHideShow === "true"){
                        ?>
                        <div class=" stock-notification" style="justify-items: center">
                            <?php if (0 === ($variation_stock_quantity ?: $global_stock_quantity)) : ?>
                                <p><?php esc_html_e('Out Of Stock', 'product-variation-table-with-quick-cart'); ?></p>
                            <?php else : ?>
                                <button style="width: 100% ; text-align: center" class="quick-add-to-cart" data-productId="<?php echo esc_attr($product->get_id()); ?>" data-variationId="<?php echo esc_attr($variation_id); ?>">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                    <span><?php echo esc_html($cartButtonText); ?></span>
                                </button>
                            <?php endif; ?>
                        </div>
                        <?php
                    }?>

                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
