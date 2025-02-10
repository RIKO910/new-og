<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'quick_cart_ajax_add_to_cart_handler');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'quick_cart_ajax_add_to_cart_handler');

add_action('wp_ajax_bulk_add_to_cart', 'quick_cart_bulk_add_to_cart');
add_action('wp_ajax_nopriv_bulk_add_to_cart', 'quick_cart_bulk_add_to_cart');

/**
 * Add to cart handel by ajax. It includes frontend-script.js
 *
 * @since 1.0.0
 * @return void
 * @throws Exception
 */
function quick_cart_ajax_add_to_cart_handler() {

    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_wpnonce'])), 'woocommerce_ajax_add_to_cart')) {
        wp_send_json_error(['message' => 'Invalid nonce.']);
    }

    if (!isset($_POST['product_id'])) {
        wp_send_json_error(['message' => 'Invalid request. Product ID is missing.']);
    }

    if (!isset($_POST['variation_id'])) {
        wp_send_json_error(['message' => 'Invalid request. Variation ID is missing.']);
    }

    if (!isset($_POST['variation'])) {
        wp_send_json_error(['message' => 'Invalid request. Variation is missing.']);
    }

    $product_id              = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity                = empty($_POST['quantity']) ? 1 : wc_stock_amount(absint(wp_unslash($_POST['quantity'])));
    $variation_id            = absint(wp_unslash($_POST['variation_id']));
    $variation               = array_map('sanitize_text_field', wp_unslash($_POST['variation']));
    $passed_validation       = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $variableSetting         = get_option('quick_variable_all_checked', array());
    $addToCartSuccessMessage = isset($variableSetting['addToCartSuccessMessage']) ? $variableSetting['addToCartSuccessMessage'] : 'Successfully added to cart.';
    $addToCartSuccessColor   = isset($variableSetting['addToCartSuccessColor']) ? $variableSetting['addToCartSuccessColor'] : '#fff';

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation)) {

        $response = array(
                'success' => true,
                'message' => $addToCartSuccessMessage,
                'color'   => $addToCartSuccessColor,
        );
        wp_send_json($response);
    } else {
        $response = array(
                'error' => true,
        );
        wp_send_json($response);
    }

    wp_die();
}

/**
 * Bulk add to cart handel by ajax. It includes frontend-script.js
 *
 * @since 1.0.0
 * @return void
 * @throws Exception
 */
function quick_cart_bulk_add_to_cart() {

    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_wpnonce'])), 'woocommerce_ajax_add_to_cart')) {
        wp_send_json_error(['message' => 'Invalid nonce.']);
    }

    $arrayLength = isset($_POST['arrayLength']) ? absint(wp_unslash($_POST['arrayLength'])): '';
    $variations  = [];

    for ($i = 0; $i < $arrayLength; $i++) {

        $attributes = [];
        if (isset($_POST['attributes'][$i]['attributes']) && is_array($_POST['attributes'][$i]['attributes'])) {

            $unslashed_attributes = array_map( 'sanitize_text_field',wp_unslash($_POST['attributes'][$i]['attributes']) ) ;

            foreach ($unslashed_attributes as $key => $value) {
                $sanitized_key   = sanitize_text_field($key);
                $sanitized_value = sanitize_text_field($value);
                $attributes[$sanitized_key] = $sanitized_value;
            }
        }

        $variations[] = [
            'product_id'   => isset($_POST['product_id'][$i]['product_id']) ? absint(wp_unslash($_POST['product_id'][$i]['product_id'])) : 0,
            'variation_id' => isset($_POST['variation_id'][$i]['variation_id']) ? absint(wp_unslash($_POST['variation_id'][$i]['variation_id'])) : 0,
            'quantity'     => isset($_POST['quantity'][$i]['quantity']) ? wc_stock_amount(absint(wp_unslash($_POST['quantity'][$i]['quantity']))) : 1,
            'attributes'   => $attributes,
        ];
    }

    if (!is_array($variations) || empty($variations)) {
        wp_send_json_error(['message' => 'Invalid variations data.']);
    }

    foreach ($variations as $variation_data) {

        $variation_id = absint($variation_data['variation_id']);
        $quantity     = isset($variation_data['quantity']) ? wc_stock_amount($variation_data['quantity']) : 1;
        $attributes   = isset($variation_data['attributes']) ? $variation_data['attributes'] : [];

        if (WC()->cart->add_to_cart($variation_data['product_id'], $quantity, $variation_id, $attributes)) {
            continue;
        } else {
            wp_send_json_error(['message' => 'Failed to add variation ID ' . $variation_id]);
        }
    }

    $response = array(
        'success' => true,
        'message' => "Successfully added to cart",
    );
    wp_send_json($response);

}