<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $product;
$product_id                     = $product->get_id();
$enable_global_stock_management = $product->get_manage_stock();
$global_stock_quantity          = $enable_global_stock_management ? $product->get_stock_quantity() : null;
$all_attributes                 = $product->get_attributes();
$variableSetting                = get_option('quick_variable_all_checked', array());
$quickTableOnOff                = isset($variableSetting['quickTableOnOff']) ? $variableSetting['quickTableOnOff'] : '';
$bulkSelectionHideShow          = isset($variableSetting['bulkSelectionHideShow']) ? $variableSetting['bulkSelectionHideShow'] : 'true';
$imageHideShow                  = isset($variableSetting['imageHideShow']) ? $variableSetting['imageHideShow'] : 'true';
$skuHideShow                    = isset($variableSetting['skuHideShow']) ? $variableSetting['skuHideShow'] : 'true';
$allAttributeHideShow           = isset($variableSetting['allAttributeHideShow']) ? $variableSetting['allAttributeHideShow'] : 'true';
$priceHideShow                  = isset($variableSetting['priceHideShow']) ? $variableSetting['priceHideShow'] : 'true';
$quantityHideShow               = isset($variableSetting['quantityHideShow']) ? $variableSetting['quantityHideShow'] : 'true';
$actionHideShow                 = isset($variableSetting['actionHideShow']) ? $variableSetting['actionHideShow'] : 'true';
$onSaleHideShow                 = isset($variableSetting['onSaleHideShow']) ? $variableSetting['onSaleHideShow'] : 'true';
$searchOptionHideShow           = isset($variableSetting['searchOptionHideShow']) ? $variableSetting['searchOptionHideShow'] : 'true';
$bulkAddToCartPosition          = isset($variableSetting['bulkAddToCartPosition']) ? $variableSetting['bulkAddToCartPosition'] : 'after';
$designSingleProductPageMobile  = isset($variableSetting['designSingleProductPageMobile']) ? $variableSetting['designSingleProductPageMobile'] : 'template_1';
$cartButtonText                 = isset($variableSetting['cartButtonText']) ? $variableSetting['cartButtonText'] : 'Add-to-cart';
$onSaleNameChange               = isset($variableSetting['onSaleNameChange']) ? $variableSetting['onSaleNameChange'] : 'On Sale';
$searchOptionTextChange         = isset($variableSetting['searchOptionTextChange']) ? $variableSetting['searchOptionTextChange'] : 'Search...';
$showPopUpImage                 = isset($variableSetting['showPopUpImage']) ? $variableSetting['showPopUpImage'] : 'true';
$variationGalleryOnOff          = isset($variableSetting['variationGalleryOnOff']) ? $variableSetting['variationGalleryOnOff'] : '';
$popUPImageShow                 = isset($variableSetting['popUPImageShow']) ? $variableSetting['popUPImageShow'] : 'default';

?>

<div class="table-scroll-container" style="overflow-x: auto; width: 100%;">
    <div class="table-before" style="display: inline-flex; gap: 30px; align-items: baseline; margin-left: 5px">

        <?php if ($onSaleHideShow === "true"){
            ?>
            <div style="display: inline-flex; align-items: baseline; gap: 10px">
                <input style="outline: none" id="stock_status" type="checkbox"  name="" >
                <p for="stock_status" ><?php echo esc_html($onSaleNameChange); ?></p>
            </div>
            <?php
        }?>

        <?php if ($searchOptionHideShow === "true"){
            ?>
            <div class="search_option">
                <input style="outline: none" class="variation-table-search" type="text" placeholder="<?php echo esc_html($searchOptionTextChange); ?>" name="search" id="variation-search">
            </div>
            <?php
        }?>
    </div>

    <?php if ($bulkAddToCartPosition === "before"  || $bulkAddToCartPosition === "both"){
        ?>
        <button class="bulk-add-to-cart"  id="bulk-add-to-cart" data-productId="<?php echo esc_attr($product->get_id()); ?>"  style="background-color: #007CBA; color: white; border-radius: 5px ; margin-bottom: 10px; outline: none">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            <span><?php echo esc_html($cartButtonText); ?></span>
            <span  class="bulk-add-to-cart-success-icon"> </span>
        </button>
        <?php
    }?>

    <table id="quick-variable-table" class="mobile-table" style="min-width: 100%; table-layout: auto;">
        <tr>
            <?php if ($bulkSelectionHideShow === "true"){
                ?>
                <th><input id="bulk_checkbox_select_all" type="checkbox"  name="" style="outline: none" ></th>
                <?php
            }?>

            <?php if ($imageHideShow === "true"){
                ?>
                <th><?php esc_html_e('Image', 'product-variation-table-with-quick-cart'); ?></th>
                <?php
            }?>


            <?php if ($skuHideShow === "true"){
                ?>

                <th>
                                <span>
                                    <?php esc_html_e('SKU', 'product-variation-table-with-quick-cart'); ?>
                                </span>
                    <span style=" float: right" id="sku-sort-arrows">
                                    <span class="dashicons dashicons-arrow-up-alt" id="sort-asc"></span>
                                </span>
                </th>

                <?php
            }?>

            <?php if ($allAttributeHideShow === "true"){
                foreach ($all_attributes as $attribute_name => $attribute) {
                    // Reflection to access the attribute's private data
                    $reflection   = new ReflectionClass($attribute);
                    $dataProperty = $reflection->getProperty("data");
                    $dataProperty->setAccessible(true);
                    $data = $dataProperty->getValue($attribute);

                    // Only display attribute columns that are variations
                    if (taxonomy_exists($attribute_name) && isset($data["variation"]) && $data["variation"]) {
                        $taxonomy = get_taxonomy($attribute_name);
                        $label = str_replace("Product ", "", $taxonomy->label);

                        ?>
                        <th >
                                            <span ><?php echo esc_html(ucfirst($label)); ?>
                                                <span style="float: right" class="attribute-sort-arrows" data-attribute="<?php echo esc_attr($attribute_name); ?>">
                                                    <span class="dashicons dashicons-arrow-up-alt" id="sort-toggle-<?php echo esc_attr($attribute_name); ?>"></span>
                                                </span>
                                            </span>
                        </th>
                        <?php
                    } elseif (isset($data["variation"]) && $data["variation"]) {
                        // Output the attribute column header with sorting arrows
                        ?>
                        <th >
                                            <span><?php echo esc_html(ucfirst($attribute_name)); ?>
                                                <span style="float: right" class="attribute-sort-arrows" data-attribute="<?php echo esc_attr($attribute_name); ?>">
                                                    <span class="dashicons dashicons-arrow-up-alt" id="sort-toggle-<?php echo esc_attr($attribute_name); ?>"></span>
                                                </span>
                                            </span>
                        </th>
                        <?php
                    }
                }
            }
            ?>

            <?php if ($priceHideShow === "true"){
                ?>
                <th >
                                    <span>
                                    <?php esc_html_e('Price', 'product-variation-table-with-quick-cart'); ?>
                                    </span>
                    <span style="float: right" id="price-sort-arrows">
                                        <span class="dashicons dashicons-arrow-up-alt" id="price-sort-toggle"></span>
                                    </span>
                </th>
                <?php
            }?>

            <?php if ($quantityHideShow === "true"){
                ?>
                <th><?php esc_html_e('Quantity', 'product-variation-table-with-quick-cart'); ?></th>
                <?php
            }?>

            <?php if ($actionHideShow === "true"){
                ?>
                <th><?php esc_html_e('Action', 'product-variation-table-with-quick-cart'); ?></th>
                <?php
            }?>

        </tr>

        <?php
        $variations = $product->get_available_variations();

        // Sort the variations by SKU
        usort($variations, function($a, $b) {
            $skuA = $a['sku'];
            $skuB = $b['sku'];

            return strcmp($skuA, $skuB); // Ascending order
        });

        // Sort the variations by Price (ascending)
        usort($variations, function($a, $b) {
            // Get variation objects
            $variationA = new WC_Product_Variation($a['variation_id']);
            $variationB = new WC_Product_Variation($b['variation_id']);

            // Get the prices for each variation
            $priceA = $variationA->get_price();
            $priceB = $variationB->get_price();

            // Check if prices are available and perform numerical comparison
            if ($priceA === false || $priceB === false) {
                return 0; // If price is not available, consider them equal
            }

            return $priceA - $priceB; // Ascending order by price
        });


        // Add sorting for each attribute (example for 'color' and 'size')
        foreach ($all_attributes as $attribute_name => $attribute) {
            usort($variations, function($a, $b) use ($attribute_name) {
                // Get the variation attributes (e.g., color, size)
                $attrA = $a['attributes'][$attribute_name] ?? '';
                $attrB = $b['attributes'][$attribute_name] ?? '';

                // Sort based on attribute value (lexicographical order)
                return strcmp($attrA, $attrB); // Ascending order
            });
        }

        foreach ($variations as $var) {
            $variation_id             = $var['variation_id'];
            $variation                = new WC_Product_Variation($variation_id);
            $variation_stock_quantity = $variation->get_manage_stock() ? $variation->get_stock_quantity() : null;

            if ($popUPImageShow === 'default'){
                $image_popup_height = 500;
                $image_popup_width  = 100;
            }elseif($popUPImageShow === 'default2'){
                $image_popup_height = 300;
                $image_popup_width  = 300;
            }else{

                $image_size = wc_get_image_size($popUPImageShow);
                $image_popup_height = $image_size['height'];
                $image_popup_width  = $image_size['width'];
            }

            // Retrieve the gallery images
            $gallery_images = get_post_meta($variation_id, '_variation_gallery_images', true);
            $image_ids      = $gallery_images ? explode(',', $gallery_images) : [];
            $thumbnail_id   = $variation->get_image_id();
            $thumbnail_url  = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, "thumbnail") : '';
            $stock_status   = $variation->is_on_sale();
            ?>
            <tr class="variation-row" data-variation-id="<?php echo esc_attr($variation_id); ?>" data-stock-status="<?php echo esc_attr($stock_status); ?>" data-gallery-images="<?php echo esc_attr(wp_json_encode($image_ids)); ?>">
                <?php if ($bulkSelectionHideShow === "true"){
                    ?>

                    <td style="padding: 20px; text-align: center">
                        <input class="bulk_cart" style="outline: none" type="checkbox" id="bulk_cart_<?php echo esc_attr($variation_id); ?>" name="bulk_cart[]" value="<?php echo esc_attr($variation_id); ?>">
                    </td>

                    <?php
                }?>

                <?php if ($imageHideShow === "true") { ?>
                    <td class="table_image">
                        <?php
                        // Use wp_get_attachment_image() to render the image
                        echo wp_get_attachment_image(
                            $thumbnail_id, // Attachment ID for the thumbnail
                            "",   // Image size (you can adjust this)
                            false,         // Icon (false for actual image)
                            array(         // Additional attributes
                                'alt' => esc_attr($variation->get_name()),
                                'class' => 'gallery-trigger',
                                'style' => 'cursor: pointer; ',
                                'data-gallery-onoff' => esc_attr($variationGalleryOnOff),
                                'data-gallery' =>  esc_attr(implode(',', $image_ids)) // Pass URLs
                            )
                        );
                        ?>
                    </td>


                    <!-- Modal Popup -->
                    <?php if ($showPopUpImage === "true"){

                        ?>
                        <div id="imagePopup" class="popup-container">
                            <div class="popup-content">
                                <span class="close-btn">&times;</span>
                                <button style="outline: none; ma" id="prevImage" class="lightbox-nav prev">⟨</button>
                                <?php
                                echo wp_get_attachment_image(
                                    $thumbnail_id, // Initially display the main variation image
                                    '', // Default size; JavaScript will adjust dimensions dynamically
                                    false, // No icon
                                    array(
                                        'id' => 'popupImage',
                                        'alt' => esc_attr__('Popup Image', 'product-variation-table-with-quick-cart'),
                                        'style' => sprintf(
                                            'object-fit: contain; %s',
                                            $popUPImageShow === 'default' ?
                                                "max-height: " . esc_attr($image_popup_height) . "px; max-width: " . esc_attr($image_popup_width) . "%;" :
                                                "height: " . esc_attr($image_popup_height) . "px; width:" . esc_attr($image_popup_width) . "px;"
                                        )
                                    )
                                );
                                ?>
                                <button style="outline: none" id="nextImage" class="lightbox-nav next">⟩</button>
                            </div>
                        </div>
                        <?php
                    }?>


                    <?php
                }?>

                <?php if ($skuHideShow === "true"){
                    ?>
                    <td style="padding: 20px; text-align: center" class="quick-variable-title variable-sku"><?php echo esc_html($variation->get_sku()); ?></td>
                    <?php
                }?>


                <?php if ($allAttributeHideShow === "true"){
                    foreach ($all_attributes as $attribute_name => $attribute) {
                        $attribute_value = $variation->get_attribute($attribute_name);

                        if (empty($attribute_value)) {
                            echo "<td><select class='quick-attribute-select' name='attribute_" . esc_attr($attribute_name) . "' data-attribute-name='" . esc_attr($attribute_name) . "'>";

                            if ($attribute->is_taxonomy()) {
                                $options = wc_get_product_terms($product->get_id(), $attribute_name, ['fields' => 'names']);
                            } else {
                                $options = $attribute->get_options();
                            }

                            foreach ($options as $option) {
                                echo "<option value='" . esc_attr($option) . "'>" . esc_html($option) . "</option>";
                            }

                            echo "</select></td>";
                        } else {
                            // Display value as static text if it’s set for the variation
                            echo "<td  class='quick-variable-title quick-attribute-text'  data-attribute-name='" . esc_attr($attribute_name) . "' name='attribute_" . esc_attr($attribute_name) . "'>" . esc_html($attribute_value) . "</td>";
                        }
                    }
                }
                ?>

                <?php if ($priceHideShow === "true"){
                    ?>
                    <td class='variable-price quick-variable-title'><?php echo wp_kses_post($variation->get_price_html()); ?></td>
                    <?php
                }?>

                <?php if ($quantityHideShow === "true"){
                    ?>
                    <td>
                        <div class="quick-quantity-container" style="margin-bottom: 10px">
                            <button class="quick-quantity-decrease" id="decrease">-</button>
                            <input  type="text" id="quantity" autocomplete="off" class="quick-quantity-input" value="1" data-max="<?php echo esc_attr($variation_stock_quantity ?: $global_stock_quantity ?: 99); ?>">
                            <button class="quick-quantity-increase" id="increase">+</button>
                        </div>
                        <div class="quick-cart-notification quick-hidden"></div>
                    </td>
                    <?php
                }?>

                <?php if ($actionHideShow === "true"){
                    ?>
                    <td class="stock-notification" style="padding: 20px; text-align: center ; justify-items: center">
                        <?php if (0 === ($variation_stock_quantity ?: $global_stock_quantity)) : ?>
                            <p><?php esc_html_e('Out Of Stock', 'product-variation-table-with-quick-cart'); ?></p>
                        <?php else : ?>
                            <button style="width: 100%; text-align: center" class="quick-add-to-cart" data-productId="<?php echo esc_attr($product->get_id()); ?>" data-variationId="<?php echo esc_attr($variation_id); ?>">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span><?php echo esc_html($cartButtonText); ?></span>
                            </button>
                        <?php endif; ?>
                    </td>
                    <?php
                }?>

            </tr>
            <?php
        }
        ?>
    </table>

    <?php if ($bulkAddToCartPosition === "after"  || $bulkAddToCartPosition === "both"){
        ?>
        <button class="bulk-add-to-cart"  id="bulk-add-to-cart" data-productId="<?php echo esc_attr($product->get_id()); ?>"  style="background-color: #007CBA; color: white; border-radius: 5px ; outline: none">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            <span><?php echo esc_html($cartButtonText); ?></span>
            <span  class="bulk-add-to-cart-success-icon"> </span>
        </button>
        <?php
    }?>
</div>

