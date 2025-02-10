<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class QuickDynamicStyle{

    public function __construct(){
        add_action('wp_enqueue_scripts', [$this,'quick_dynamic_styles']);
    }

    function quick_dynamic_styles() {
        // Register dynamic stylesheet stylesheet
        $variableSetting = get_option('quick_variable_all_checked', array());
        $variableHoverClick = isset($variableSetting['hoverClickValue'][0]) ? $variableSetting['hoverClickValue'][0] : '';
        $variableTooltipPosition = isset($variableSetting['boxPositionValue'][0]) ? $variableSetting['boxPositionValue'][0] : '';
        $variableDetailsTitle = isset($variableSetting['variableDetailsTitle'][0]) ? $variableSetting['variableDetailsTitle'][0] : '';
        $variableDetailsImage = isset($variableSetting['variableDetailsImage'][0]) ? $variableSetting['variableDetailsImage'][0] : '';
        $variableDetailsExcerpt = isset($variableSetting['variableDetailsExcerpt'][0]) ? $variableSetting['variableDetailsExcerpt'][0] : '';
        $variableAddToCartIcon = isset($variableSetting['variableAddToCartIcon']) ? $variableSetting['variableAddToCartIcon'] : 'inline-block';
        $cartButtonBg = isset($variableSetting['cartButtonBg']) ? $variableSetting['cartButtonBg'] : '#007cba';
        $cartButtonTextColor = isset($variableSetting['cartButtonTextColor']) ? $variableSetting['cartButtonTextColor'] : '#fff';
        $tooltipBgColor = isset($variableSetting['tooltipBg']) ? $variableSetting['tooltipBg'] : '#000';
        $tooltipTextColor = isset($variableSetting['tooltipTextColor']) ? $variableSetting['tooltipTextColor'] : '#fff';
        $quantityBg = isset($variableSetting['quantityBg']) ? $variableSetting['quantityBg'] : '#007bff';
        $quantityBorderColor = isset($variableSetting['quantityBorderColor']) ? $variableSetting['quantityBorderColor'] : '#ccc';
        $quantityTextColor = isset($variableSetting['quantityTextColor']) ? $variableSetting['quantityTextColor'] : '#fff';
        $quickCarouselAutoplay = isset($variableSetting['quickCarouselAutoplay']) ? $variableSetting['quickCarouselAutoplay'] : 'true';
        $carouselButtonBgColor = isset($variableSetting['CarouselButtonBg']) ? $variableSetting['CarouselButtonBg'] : '#000';
        $carouselButtonIconColor = isset($variableSetting['CarouselButtonIconColor']) ? $variableSetting['CarouselButtonIconColor'] : '#fff';
        $tableHeadBgColor = isset($variableSetting['tableHeadBgColor']) ? $variableSetting['tableHeadBgColor'] : '#007cba';
        $tableHeadTextColor = isset($variableSetting['tableHeadTextColor']) ? $variableSetting['tableHeadTextColor'] : '#fff';
        $tableVariableTitleColor = isset($variableSetting['tableVariableTitleColor']) ? $variableSetting['tableVariableTitleColor'] : '#000';
        $quickTableBorder = isset($variableSetting['quickTableBorder']) ? $variableSetting['quickTableBorder'] : '0';
        $tableBorderColor = isset($variableSetting['tableBorderColor']) ? $variableSetting['tableBorderColor'] : '#e1e8ed';
        $tableBgColorOdd = isset($variableSetting['tableBgColorOdd']) ? $variableSetting['tableBgColorOdd'] : 'transparent';
        $tableBgColorEven = isset($variableSetting['tableBgColorEven']) ? $variableSetting['tableBgColorEven'] : '#f2f2f2';
        $tableBgColorHover = isset($variableSetting['tableBgColorHover']) ? $variableSetting['tableBgColorHover'] : '#ddd';
        $cartButtonBgHover = isset($variableSetting['cartButtonBgHover']) ? $variableSetting['cartButtonBgHover'] : '#045cb4';
        $quantityBgColorHover = isset($variableSetting['quantityBgColorHover']) ? $variableSetting['quantityBgColorHover'] : '#0056b3';
        $quickCarouselOnOff = isset($variableSetting['quickCarouselOnOff']) ? $variableSetting['quickCarouselOnOff'] : '';
        $quickTableOnOff = isset($variableSetting['quickTableOnOff']) ? $variableSetting['quickTableOnOff'] : '';
        
    
        // Prepare dynamic CSS
        ob_start();
        ?>
        .quick-variable-tooltip{
            background-color: <?php echo esc_attr($tooltipBgColor); ?>
        }
        .quick-variable-tooltip #quick-product-content,
        .quick-variable-tooltip #quick-product-content h4{
            color:<?php echo esc_attr($tooltipTextColor); ?>;
        }
        .quick-quantity-container .quick-quantity-decrease,
        .quick-quantity-container .quick-quantity-increase{
            background-color:<?php echo esc_attr($quantityBg); ?>;
            color:<?php echo esc_attr($quantityTextColor); ?>;
        }
        .quick-quantity-container .quick-quantity-increase:hover,
        .quick-quantity-container .quick-quantity-decrease:hover {
            background-color: <?php echo esc_attr($quantityBgColorHover); ?>;
        }
        .quick-quantity-container input.quick-quantity-input {
            border: 1px solid <?php echo esc_attr($quantityBorderColor); ?> !important;
        }
        button.quick-add-to-cart{
            background-color:<?php echo esc_attr($cartButtonBg); ?>;
            color:<?php echo esc_attr($cartButtonTextColor); ?>;
        }
        button.quick-add-to-cart-shop-page{
        background-color:<?php echo esc_attr($cartButtonBg); ?>;
        color:<?php echo esc_attr($cartButtonTextColor); ?>;
        }
        button.quick-add-to-cart:hover{
            background-color:<?php echo esc_attr($cartButtonBgHover); ?>;
        }
        button.quick-add-to-cart-shop-page:hover{
        background-color:<?php echo esc_attr($cartButtonBgHover); ?>;
        }
        button.quick-add-to-cart-shop-page i.fa{
            display:<?php echo esc_attr($variableAddToCartIcon); ?>
        }
        #quick-variable-table th {
            background-color:<?php echo esc_attr( $tableHeadBgColor); ?>;
            color:<?php echo esc_attr($tableHeadTextColor); ?>;
        }
        #quick-variable-table td.quick-variable-title{
            color:<?php echo esc_attr($tableVariableTitleColor); ?>;
        }
        .quick-variable-slide button.slick-custom-arrow.slick-next.slick-arrow,
        .quick-variable-slide button.slick-custom-arrow.slick-prev.slick-arrow {
            background-color:<?php echo esc_attr( $carouselButtonBgColor ); ?>;
            color:<?php echo esc_attr( $carouselButtonIconColor ); ?>;
        }
        #quick-variable-table,
        #quick-variable-table td,
        #quick-variable-table th {
            border: <?php echo esc_attr(($quickTableBorder == "true") ? '1' : '0'); ?>px solid <?php echo esc_attr( $tableBorderColor ); ?>;
        }
        #quick-variable-table tr:nth-child(odd) {
            background-color: <?php echo esc_attr($tableBgColorOdd); ?>;
        }
        #quick-variable-table tr:nth-child(odd) td{
        background-color: <?php echo esc_attr($tableBgColorOdd); ?>;
        }
        #quick-variable-table tr:nth-child(even) {
            background-color: <?php echo esc_attr($tableBgColorEven); ?>;
        }
        #quick-variable-table tr:nth-child(even) td{
        background-color: <?php echo esc_attr($tableBgColorEven); ?>;
        }
        #quick-variable-table tr:hover td{
            background-color: <?php echo esc_attr($tableBgColorHover); ?>;
        }
<!--        #quick-variable-table{-->
<!--            display: --><?php //echo esc_attr(($quickTableOnOff == "false") ? 'none' : ''); ?>
<!--        }-->
<!--        .quick-variable-slide.slick-initialized.slick-slider{-->
<!--            display: --><?php //echo esc_attr(($quickCarouselOnOff == "false") ? 'none' : ''); ?>
<!--        }-->

        <?php
        $dynamic_css = ob_get_clean();
        wp_add_inline_style('main-css', $dynamic_css);
    }

}