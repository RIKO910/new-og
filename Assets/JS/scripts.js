jQuery(document).ready(function () {
  //Variable hover/click option Checkboxes Click
  var quickHoverClick = jQuery('.quick-hover-click input[type="checkbox"]');
  var quickBoxPosition = jQuery(
    '.quick-box-position-click input[type="checkbox"]'
  );
  var quickBoxPositionFieldWrapper = jQuery(".quick-box-position-click");
  var quickAdminAlert = jQuery(".quick-variable-dashboard .alert.adminAlert");
  var quickActivateAlert = jQuery(
    ".quick-variable-dashboard .alert.activateAlert"
  );
  var quickAdminButton = jQuery(".quick-variable-dashboard .buttonload");
  var quickCartIcon = jQuery('.quick-add-to-cart-icon input[type="checkbox"]');
  var quickSelections = jQuery(".quick-selections");
  var quickCarouselAutoplay = jQuery(
    '.quick-carousel-autoplay input[type="checkbox"]'
  );

  var nameImageRedirect = jQuery(
      '.name-image-redirect input[type="checkbox"]'
  );

  var quickTableBorder = jQuery('.quick-table-border input[type="checkbox"]');
  var showPopUpImage = jQuery('.show-popup-image input[type="checkbox"]');
  var quickCarouselOnOff = jQuery(
    '.quick-carousel-on-off input[type="checkbox"]'
  );

  var quickTableOnOff       = jQuery('.quick-table-on-off input[type="checkbox"]');
  var variationGalleryOnOff = jQuery('.variation-gallery-on-off input[type="checkbox"]');
  var bulkSelectionHideShow = jQuery('.bulk-selection-hide-show input[type="checkbox"]');
  var imageHideShow         = jQuery('.image-hide-show input[type="checkbox"]');
  var skuHideShow           = jQuery('.sku-hide-show input[type="checkbox"]');
  var allAttributeHideShow  = jQuery('.all-attribute-hide-show input[type="checkbox"]');
  var priceHideShow         = jQuery('.price-hide-show input[type="checkbox"]');
  var quantityHideShow      = jQuery('.quantity-hide-show input[type="checkbox"]');
  var actionHideShow        = jQuery('.action-hide-show input[type="checkbox"]');
  var onSaleHideShow        = jQuery('.on-sale-hide-show input[type="checkbox"]');
  var searchOptionHideShow  = jQuery('.search-option-hide-show input[type="checkbox"]');

  var quickCartExcerpt = jQuery(
    '.quick-box-content-click:nth-child(3) input[type="checkbox"]'
  );

  // Lock Pro Features
  if (quick_ajax_obj.pro_key != "1") {
    jQuery("[name=add-to-cart-text]").prop("disabled", true);
    jQuery("#add-to-cart-text").removeAttr("id");

    jQuery("[name=tooltip-text]").prop("disabled", true);
    jQuery("#tooltip-text").removeAttr("id");

    jQuery("[name=add-to-cart-success-color]").prop("disabled", true);
    jQuery("#add-to-cart-success-color").removeAttr("id");

    jQuery("[name=quantity-text-color]").prop("disabled", true);
    jQuery("#quantity-text-color").removeAttr("id");

    jQuery("[name=add-to-cart-bg-hover]").prop("disabled", true);
    jQuery("#add-to-cart-bg-hover").removeAttr("id");

    jQuery("[name=quantity-bg-color-hover]").prop("disabled", true);
    jQuery("#quantity-bg-color-hover").removeAttr("id");

    jQuery("[name=quick-carousel-button-icon-color]").prop("disabled", true);
    jQuery("#quick-carousel-button-icon-color").removeAttr("id");

    jQuery("[name=quick-table-head-bg-color]").prop("disabled", true);
    jQuery("#quick-table-head-bg-color").removeAttr("id");

    jQuery("[name=quick-table-head-text-color]").prop("disabled", true);
    jQuery("#quick-table-head-text-color").removeAttr("id");

    jQuery("[name=quick-table-variable-title-color]").prop("disabled", true);
    jQuery("#quick-table-variable-title-color").removeAttr("id");

    jQuery("[name=quick-carousel-autoplay]").prop("disabled", true);
    jQuery("[name=quick-carousel-autoplay]").prop("checked", false);
    jQuery(".quick-carousel-autoplay").removeClass("quick-carousel-autoplay");


    jQuery("[name=name-image-redirect]").prop("disabled", true);
    jQuery("[name=name-image-redirect]").prop("checked", false);
    jQuery(".name-image-redirect").removeClass("name-image-redirect");

    // jQuery("[name=quick-carousel-on-off]").prop("disabled", true);

    // jQuery(document).ready(function() {
    //   // Set the checkbox as checked
    //   jQuery("[name=quick-carousel-on-off]").prop("checked", true);
    //
    //   // Make the checkbox unclickable by preventing default action on click
    //   jQuery("[name=quick-carousel-on-off]").on("click", function(event) {
    //     event.preventDefault();  // Prevents changes to the checked state
    //   });
    // });

    jQuery("[name=quick-carousel-on-off]").prop("checked", false);
    jQuery(".quick-carousel-autoplay").removeClass("quick-carousel-on-off");


    jQuery("[name=variation-gallery-on-off]").prop("disabled", true);
    jQuery("[name=variation-gallery-on-off]").prop("checked", false);
    jQuery(".variation-gallery-on-off").removeClass("variation-gallery-on-off");

    jQuery("[name=quick-table-border]").prop("disabled", true);
    jQuery("[name=quick-table-border]").prop("checked", false);
    jQuery(".quick-table-border").removeClass("quick-table-border");

    jQuery("[name=show-popup-image]").prop("disabled", true);
    jQuery("[name=show-popup-image]").prop("checked", false);
    jQuery(".show-popup-image").removeClass("quick-table-border");

    jQuery("[name=quick-table-border-color]").prop("disabled", true);
    jQuery("#quick-table-border-color").removeAttr("id");

    jQuery("[name=quick-table-variable-bg-color-odd]").prop("disabled", true);
    jQuery("#quick-table-variable-bg-color-odd").removeAttr("id");

    jQuery("[name=quick-table-variable-bg-color-even]").prop("disabled", true);
    jQuery("#quick-table-variable-bg-color-even").removeAttr("id");

    jQuery("[name=quick-table-variable-hover-color]").prop("disabled", true);
    jQuery("#quick-table-variable-hover-color").removeAttr("id");

    jQuery("[name=on-sale-name-change]").prop("disabled", true);
    jQuery("#on-sale-name-change").removeAttr("id");

    jQuery("[name=search-option-text-change]").prop("disabled", true);
    jQuery("#search-option-text-change").removeAttr("id");

    jQuery("[name=add-to-cart-success-message]").prop("disabled", true);
    jQuery("#add-to-cart-success-message").removeAttr("id");

    // jQuery("[name=bulk-selection-hide-show]").prop("disabled", true);
    // jQuery("[name=bulk-selection-hide-show]").prop("checked", false);
    // jQuery(".bulk-selection-hide-show").removeClass("bulk-selection-hide-show");


    jQuery(document).ready(function() {
      // Set the checkbox as checked
      jQuery("[name=bulk-selection-hide-show]").prop("checked", true);
      jQuery("[name=image-hide-show]").prop("checked", true);
      jQuery("[name=sku-hide-show]").prop("checked", true);
      jQuery("[name=all-attribute-hide-show]").prop("checked", true);
      jQuery("[name=price-hide-show]").prop("checked", true);
      jQuery("[name=quantity-hide-show]").prop("checked", true);
      jQuery("[name=action-hide-show]").prop("checked", true);

      // Make the checkbox unclickable by preventing default action on click
      jQuery("[name=bulk-selection-hide-show]").on("click", function(event) {
        event.preventDefault();  // Prevents changes to the checked state
      });
      jQuery("[name=image-hide-show]").on("click", function(event) {
        event.preventDefault();  // Prevents changes to the checked state
      });
      jQuery("[name=sku-hide-show]").on("click", function(event) {
        event.preventDefault();  // Prevents changes to the checked state
      });
      jQuery("[name=all-attribute-hide-show]").on("click", function(event) {
        event.preventDefault();  // Prevents changes to the checked state
      });
      jQuery("[name=price-hide-show]").on("click", function(event) {
        event.preventDefault();  // Prevents changes to the checked state
      });
      jQuery("[name=quantity-hide-show]").on("click", function(event) {
        event.preventDefault();  // Prevents changes to the checked state
      });
      jQuery("[name=action-hide-show]").on("click", function(event) {
        event.preventDefault();  // Prevents changes to the checked state
      });
    });


    // jQuery("[name=image-hide-show]").prop("disabled", true);
    // jQuery("[name=image-hide-show]").prop("checked", false);
    // jQuery(".image-hide-show").removeClass("image-hide-show");

    // jQuery("[name=sku-hide-show]").prop("disabled", true);
    // jQuery("[name=sku-hide-show]").prop("checked", false);
    // jQuery(".sku-hide-show").removeClass("sku-hide-show");

    // jQuery("[name=all-attribute-hide-show]").prop("disabled", true);
    // jQuery("[name=all-attribute-hide-show]").prop("checked", false);
    // jQuery(".all-attribute-hide-show").removeClass("all-attribute-hide-show");

    // jQuery("[name=price-hide-show]").prop("disabled", true);
    // jQuery("[name=price-hide-show]").prop("checked", false);
    // jQuery(".price-hide-show").removeClass("price-hide-show");

    // jQuery("[name=quantity-hide-show]").prop("disabled", true);
    // jQuery("[name=quantity-hide-show]").prop("checked", false);
    // jQuery(".quantity-hide-show").removeClass("quantity-hide-show");

    // jQuery("[name=action-hide-show]").prop("disabled", true);
    // jQuery("[name=action-hide-show]").prop("checked", false);
    // jQuery(".action-hide-show").removeClass("action-hide-show");

    jQuery("[name=on-sale-hide-show]").prop("disabled", true);
    jQuery("[name=on-sale-hide-show]").prop("checked", false);
    jQuery(".on-sale-hide-show").removeClass("on-sale-hide-show");

    jQuery("[name=search-option-hide-show]").prop("disabled", true);
    jQuery("[name=search-option-hide-show]").prop("checked", false);
    jQuery(".search-option-hide-show").removeClass("search-option-hide-show");


    quickCartIcon.prop("disabled", true);
    quickCartIcon.prop("checked", false);
    quickCartIcon.removeAttr("name");

    quickCartExcerpt.prop("disabled", true);
    quickCartExcerpt.prop("checked", false);
    quickCartExcerpt.removeAttr("value");

    // Correct way using variable without template strings
    quickBoxPositionFieldWrapper
      .eq(1)
      .find('input[type="checkbox"]')
      .prop("disabled", true);

    quickBoxPositionFieldWrapper
      .eq(1)
      .find('input[type="checkbox"]')
      .prop("checked", false);
    quickBoxPositionFieldWrapper
      .eq(1)
      .find('input[type="checkbox"]')
      .removeAttr("value");

    quickBoxPositionFieldWrapper
      .eq(2)
      .find('input[type="checkbox"]')
      .prop("disabled", true);

    quickBoxPositionFieldWrapper
      .eq(2)
      .find('input[type="checkbox"]')
      .prop("checked", false);
    quickBoxPositionFieldWrapper
      .eq(2)
      .find('input[type="checkbox"]')
      .removeAttr("value");

    jQuery("input[value|='variable-click']").prop("disabled", true);
    jQuery("input[value|='variable-click']").removeAttr("value");

    quickSelections
      .find("select.quick-carousel-position")
      .prop("disabled", true);
    quickSelections
      .find("select.quick-carousel-position")
      .removeClass("quick-carousel-position");

    quickSelections.find("select.quick-table-position").prop("disabled", true);
    quickSelections
      .find("select.quick-table-position")
      .removeClass("quick-table-position");

    quickSelections.find("select.pop-up-image-show").prop("disabled", true);
    quickSelections
        .find("select.pop-up-image-show")
        .removeClass("pop-up-image-show");

    quickSelections.find("select.bulk-add-to-cart-position").prop("disabled", true);
    quickSelections
      .find("select.bulk-add-to-cart-position")
      .removeClass("bulk-add-to-cart-position");

    quickSelections.find("select.design-single-product-page-mobile").prop("disabled", true);
    quickSelections
        .find("select.design-single-product-page-mobile")
        .removeClass("design-single-product-page-mobile");

  }
  // Lock Pro Features End

  if (jQuery("input[value|='variable-click']").length) {
    quickHoverClick.on("change", function () {

      if (jQuery(this).is(":checked")) {
        quickHoverClick.prop("checked", true);
        quickHoverClick.not(this).prop("checked", false);
      } else {
        quickHoverClick.prop("checked", false);
        quickHoverClick.not(this).prop("checked", true);
      }
    });
  }
  //Variable Details Box Position Checkboxes Click
  if (
    jQuery("input[value|='quick-tooltip-position-left']").length &&
    jQuery("input[value|='quick-tooltip-position-right']").length
  ) {
    quickBoxPosition.on("change", function () {
      if (jQuery(this).is(":checked")) {
        quickBoxPosition.prop("checked", true);
        quickBoxPosition.not(this).prop("checked", false);
      } else {
        jQuery(".quick-box-position-click");
        jQuery(".quick-box-position-click")
          .first()
          .find('input[type="checkbox"]')
          .prop("checked", true);
      }
    });
  }

  // On click Setting Save button Collect all checked fields Of variable
  quickAdminButton.on("click", function () {
    //Save button Spinner
    quickAdminButton.html(
      '<span><i class="fa fa-refresh fa-spin"></i></span>Loading...'
    );

    //Get Checked Fields Values
    let variableAllChecked = {};

    if (jQuery("input[value|='variable-click']").length) {
      variableAllChecked.hoverClickValue = jQuery(
        '.quick-hover-click input[type="checkbox"]:checked'
      )
        .map(function () {
          return jQuery(this).val();
        })
        .get();
    }

    if (jQuery("input[value|='variable-hover']").length) {
      variableAllChecked.hoverClickValue = jQuery(
          '.quick-hover-click input[type="checkbox"]:checked'
      )
          .map(function () {
            return jQuery(this).val();
          })
          .get();
    }

    if (
      jQuery("input[value|='quick-tooltip-position-left']").length &&
      jQuery("input[value|='quick-tooltip-position-right']").length
    ) {
      variableAllChecked.boxPositionValue = jQuery(
        '.quick-box-position-click input[type="checkbox"]:checked'
      )
        .map(function () {
          return jQuery(this).val();
        })
        .get();
    }

    variableAllChecked.variableDetailsTitle = jQuery(
      '.quick-box-content-click:nth-child(1) input[type="checkbox"]:checked'
    )
      .map(function () {
        return jQuery(this).val();
      })
      .get();

    variableAllChecked.variableDetailsImage = jQuery(
      '.quick-box-content-click:nth-child(2) input[type="checkbox"]:checked'
    )
      .map(function () {
        return jQuery(this).val();
      })
      .get();

    if (quickCartExcerpt.attr("value")) {
      variableAllChecked.variableDetailsExcerpt = jQuery(
        '.quick-box-content-click:nth-child(3) input[type="checkbox"]:checked'
      )
        .map(function () {
          return jQuery(this).val();
        })
        .get();
    }



    // SKU Start

    variableAllChecked.variableDetailsSKU = jQuery(
        '.quick-box-content-click:nth-child(4) input[type="checkbox"]:checked'
    )
        .map(function () {
          return jQuery(this).val();
        })
        .get();

    // SKU end

    // Id Start

    // variableAllChecked.variableID = jQuery(
    //     '.quick-box-content-click:nth-child(5) input[type="checkbox"]:checked'
    // )
    //     .map(function () {
    //       return jQuery(this).val();
    //     })
    //     .get();

    // ID end

    //Check Add to cart Icon
    if (quickCartIcon.attr("name")) {
      if (quickCartIcon.is(":checked")) {
        variableAllChecked.variableAddToCartIcon = "inline-block";
      } else {
        variableAllChecked.variableAddToCartIcon = "none";
      }
    }
    // Carousel Autoplay On/Off
    if (quickCarouselAutoplay.is(":checked")) {
      variableAllChecked.quickCarouselAutoplay = "true";
    } else {
      variableAllChecked.quickCarouselAutoplay = "false";
    }

    // Carousel Autoplay On/Off
    if (nameImageRedirect.is(":checked")) {
      variableAllChecked.nameImageRedirect = "true";
    } else {
      variableAllChecked.nameImageRedirect = "false";
    }

    // Table Border Hide/Show
    if (quickTableBorder.is(":checked")) {
      variableAllChecked.quickTableBorder = "true";
    } else {
      variableAllChecked.quickTableBorder = "false";
    }

    if (showPopUpImage.is(":checked")) {
      variableAllChecked.showPopUpImage = "true";
    } else {
      variableAllChecked.showPopUpImage = "false";
    }

    // Quick Carousel Hide/Show
    if (quickCarouselOnOff.is(":checked")) {
      console.log("true")
      variableAllChecked.quickCarouselOnOff = "true";
    } else {
      console.log("false")
      variableAllChecked.quickCarouselOnOff = "false";
    }


    // Quick Table Hide/Show
    if (quickTableOnOff.is(":checked")) {
      variableAllChecked.quickTableOnOff = "true";
    } else {
      variableAllChecked.quickTableOnOff = "false";
    }


    // Quick Variation Gallery
    // Hide/Show
    if (variationGalleryOnOff.is(":checked")) {
      variableAllChecked.variationGalleryOnOff = "true";
    } else {
      variableAllChecked.variationGalleryOnOff = "false";
    }



    // Bulk Selection Hide/Show
    if (bulkSelectionHideShow.is(":checked")) {
      variableAllChecked.bulkSelectionHideShow = "true";
    } else {
      variableAllChecked.bulkSelectionHideShow = "false";
    }

    // image Hide/Show
    if (imageHideShow.is(":checked")) {
      variableAllChecked.imageHideShow = "true";
    } else {
      variableAllChecked.imageHideShow = "false";
    }

    // SKU Hide/Show
    if (skuHideShow.is(":checked")) {
      variableAllChecked.skuHideShow = "true";
    } else {
      variableAllChecked.skuHideShow = "false";
    }

    // Attribute Hide/Show
    if (allAttributeHideShow.is(":checked")) {
      variableAllChecked.allAttributeHideShow = "true";
    } else {
      variableAllChecked.allAttributeHideShow = "false";
    }

    // Price Hide/Show
    if (priceHideShow.is(":checked")) {
      variableAllChecked.priceHideShow = "true";
    } else {
      variableAllChecked.priceHideShow = "false";
    }

    // Quantity Hide/Show
    if (quantityHideShow.is(":checked")) {
      variableAllChecked.quantityHideShow = "true";
    } else {
      variableAllChecked.quantityHideShow = "false";
    }

    // Action Hide/Show
    if (actionHideShow.is(":checked")) {
      variableAllChecked.actionHideShow = "true";
    } else {
      variableAllChecked.actionHideShow = "false";
    }

    // On Sale Hide/Show
    if (onSaleHideShow.is(":checked")) {
      variableAllChecked.onSaleHideShow = "true";
    } else {
      variableAllChecked.onSaleHideShow = "false";
    }

    // Search Option Hide/Show
    if (searchOptionHideShow.is(":checked")) {
      variableAllChecked.searchOptionHideShow = "true";
    } else {
      variableAllChecked.searchOptionHideShow = "false";
    }


    variableAllChecked.cartButtonText = jQuery(
      'input.quick-add-to-cart-text[type="text"]'
    ).val();

    variableAllChecked.addToCartSuccessMessage = jQuery(
      'input.add-to-cart-success-message[type="text"]'
    ).val();

    //Popup Colors Check
    variableAllChecked.cartButtonBg = quickSelections
      .find("input#add-to-cart-bg")
      .val();
    variableAllChecked.cartButtonBgHover = quickSelections
      .find("input#add-to-cart-bg-hover")
      .val();
    variableAllChecked.cartButtonTextColor = quickSelections
      .find("input#add-to-cart-text")
      .val();

    variableAllChecked.tooltipBg = quickSelections
      .find("input#tooltip-bg")
      .val();

    variableAllChecked.tooltipTextColor = quickSelections
      .find("input#tooltip-text")
      .val();

    variableAllChecked.addToCartSuccessColor = quickSelections
        .find("input#add-to-cart-success-color")
        .val();

    variableAllChecked.quantityBg = quickSelections
      .find("input#quantity-bg-color")
      .val();
    variableAllChecked.quantityBgColorHover = quickSelections
      .find("input#quantity-bg-color-hover")
      .val();
    variableAllChecked.quantityBorderColor = quickSelections
      .find("input#quantity-border-color")
      .val();
    variableAllChecked.quantityTextColor = quickSelections
      .find("input#quantity-text-color")
      .val();
    variableAllChecked.CarouselButtonBg = quickSelections
      .find("input#quick-carousel-button-bg-color")
      .val();
    variableAllChecked.CarouselButtonIconColor = quickSelections
      .find("input#quick-carousel-button-icon-color")
      .val();
    variableAllChecked.tableHeadBgColor = quickSelections
      .find("input#quick-table-head-bg-color")
      .val();
    variableAllChecked.tableHeadTextColor = quickSelections
      .find("input#quick-table-head-text-color")
      .val();
    variableAllChecked.tableVariableTitleColor = quickSelections
      .find("input#quick-table-variable-title-color")
      .val();
    variableAllChecked.tableBorderColor = quickSelections
      .find("input#quick-table-border-color")
      .val();
    variableAllChecked.tableBgColorOdd = quickSelections
      .find("input#quick-table-variable-bg-color-odd")
      .val();
    variableAllChecked.tableBgColorEven = quickSelections
      .find("input#quick-table-variable-bg-color-even")
      .val();
    variableAllChecked.tableBgColorHover = quickSelections
      .find("input#quick-table-variable-hover-color")
      .val();

    variableAllChecked.onSaleNameChange = jQuery(
        'input.on-sale-name-change[type="text"]'
    ).val();

    variableAllChecked.searchOptionTextChange = jQuery(
        'input.search-option-text-change[type="text"]'
    ).val();

    variableAllChecked.quickCarouselPosition = jQuery(
      ".quick-carousel-position"
    ).val();
    variableAllChecked.quickTablePosition = jQuery(
      ".quick-table-position"
    ).val();

    variableAllChecked.popUPImageShow = jQuery(
        ".pop-up-image-show"
    ).val();

    variableAllChecked.bulkAddToCartPosition = jQuery(
        ".bulk-add-to-cart-position"
    ).val();

    variableAllChecked.designSingleProductPageMobile = jQuery(
        ".design-single-product-page-mobile"
    ).val();

    var quickAdminNonce = jQuery('input[name="quick_admin_nonce"]').val();

    //Store variable Field Settings in DB
    let jsonData = JSON.stringify(variableAllChecked);
    console.log(jsonData);

    jQuery.ajax({
      url: quick_ajax_obj.ajax_url,
      type: "POST",
      data: {
        action: "quickAdminAjaxHandler",
        variable_data: jsonData,
        nonce: quickAdminNonce,
        identifier: "adminSetting",
      },
      success: function (response) {
        quickAdminAlert.fadeIn();

        if (response.trim() === "true") {
          quickAdminAlert.css("background-color", "#4CAF50");

          quickAdminAlert.html(
            "<span class='closebtn'>&times;</span><strong>Success!</strong> Product Variations Table With Quick Cart plugins item saved successfully."
          );
        } else {
          quickAdminAlert.css("background-color", "#f44336");

          quickAdminAlert.html(
            "<span class='closebtn'>&times;</span><strong>Danger!!</strong> Something wrong,try again later."
          );
        }

        jQuery(".quick-variable-dashboard .buttonload span").addClass(
          "quick-hidden"
        );

        quickAdminButton.text("Save");

        setTimeout(function () {
          quickAdminAlert.fadeOut();
        }, 3000);
      },
    });

    //On Click Notification Cross Icon
    quickAdminAlert.on("click", ".closebtn", function () {
      quickAdminAlert.fadeOut();
    });
  });

  // License Pro
  jQuery("#quickAuthenticateWrapper input[type='submit']").on(
    "click",
    function (event) {
      event.preventDefault();

      var quickAdminNonce = jQuery('input[name="quick_admin_nonce"]').val();
      var activationKey = jQuery("#quickSecretKey").val();

      if (activationKey == "") {
        quickActivateAlert.fadeIn();
        quickActivateAlert.css("background-color", "#f44336");
        quickActivateAlert.html(
          "<span class='closebtn'>&times;</span><strong>Danger!! </strong>Please Insert Activation Key and Try Again."
        );
        return;
      }

      jQuery.ajax({
        url: quick_ajax_obj.ajax_url,
        type: "POST",
        data: {
          action: "quickAdminAjaxHandler",
          activation_key: activationKey,
          nonce: quickAdminNonce,
          identifier: "activationKey",
        },
        success: function (response) {
          var response = JSON.parse(response);
          quickActivateAlert.fadeIn();
          if (response.status == "ok") {
            quickActivateAlert.css("background-color", "#4CAF50");
            quickActivateAlert.html(
              "<span class='closebtn'>&times;</span><strong></strong>" +
                response.message
            );
            location.reload();
          } else {
            quickActivateAlert.css("background-color", "#f44336");
            quickActivateAlert.html(
              "<span class='closebtn'>&times;</span><strong> </strong>" +
                response.message
            );
          }
        },
      });
    }
  );

  //On Click Notification Cross Icon
  quickActivateAlert.on("click", ".closebtn", function () {
    quickActivateAlert.fadeOut();
  });
});
