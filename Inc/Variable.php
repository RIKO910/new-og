<?php

if ( ! defined( 'ABSPATH' ) ) exit;
class Quickvariables
{
    public function __construct()
    {
       
        $variableSetting       = get_option('quick_variable_all_checked', array());
        $quickCarouselPosition = isset($variableSetting['quickCarouselPosition']) ? $variableSetting['quickCarouselPosition'] : 'woocommerce_after_shop_loop_item';
        $quickTablePosition    = isset($variableSetting['quickTablePosition']) ? $variableSetting['quickTablePosition'] : 'woocommerce_after_single_product_summary';

        //variations Carousel
        add_action( $quickCarouselPosition, [$this,"quick_display_product_variations",]);

        //Quick variable TableSingle Page
        add_action( 'woocommerce_after_single_product', [$this,"test",]);



        add_action( $quickTablePosition, [ $this,"quick_variables_single_page",]);
    }

    public  function test()
    {
        echo "test";
    }

    // Get all variations of the variable products
    public function quick_display_product_variations()
    {
        require plugin_dir_path(__FILE__) . "/Templates/Variable-slider.php";

    }

    // Variations Table Single Page
    function quick_variables_single_page()
    {
      global $product;
      if ( is_product() && $product->is_type('variable') ) {
          require_once plugin_dir_path(__FILE__) . "/Templates/Variable-single-table.php";
      }
    }

    // Variations Slide Popup
    public function quickVariablePopup()
    {
      require plugin_dir_path(__FILE__) . "/Templates/Variable-popup.php";

    }
}
