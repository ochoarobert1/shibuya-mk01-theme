var passd = true;

function isValidEmailAddress(emailAddress) {
    'use strict';
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

// Restricts input for each element in the set of matched elements to the given inputFilter.
(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
}(jQuery));

function reCAPTCHA_execute() {
    // grecaptcha instantiated by external script from Google
    // reCAPTCHA_site_key comes from backend
    grecaptcha.execute(admin_url.google_site_key, {
        action: 'homepage'
    }).then(function (token) {
        jQuery('#g-recaptcha-response').val(token);
    }, function (reason) {
        console.log(reason);
    });
}

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") {
        return;
    }

    // original length
    var original_len = input_val.length;

    // initial caret position
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "$ " + left_side + "." + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = "$ " + input_val;

        // final formatting
        if (blur === "blur") {
            input_val += ".00";
        }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

jQuery(document).ready(function ($) {
    "use strict";

    var d1 = new Date ();
    var d2 = new Date ( d1 );
    d2.setMinutes ( d1.getMinutes() + 30 );

    jQuery('#time_takeout').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        defaultTime: 'now',
        minTime: new Date(0,0,0,d2.getHours(),d2.getMinutes(),0),
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    jQuery("input[data-type='currency']").on({
        keyup: function () {
            formatCurrency(jQuery(this));
        },
        blur: function () {
            formatCurrency(jQuery(this), "blur");
        },
        focusout: function () {
            jQuery('body').trigger('update_checkout');
        }
    });

    jQuery('#tip_selection').on('change', function (e) {
        e.preventDefault();
        var selectedTip = jQuery(this).children("option:selected").val();
        if (selectedTip == 'custom') {
            jQuery('#tip_custom').val('');
            jQuery('.tip_custom_class').removeClass('tip_custom_hidden');
            jQuery('body').trigger('update_checkout');

        } else {
            jQuery('#tip_custom').val('');
            jQuery('.tip_custom_class').addClass('tip_custom_hidden');
            jQuery('body').trigger('update_checkout');

        }

    });





    jQuery('.btn-show-menu').on('click', function () {
        jQuery('.product-sidebar').toggleClass('product-sidebar-show');
        if (jQuery('.product-sidebar').hasClass('product-sidebar-show')) {
            jQuery(this).html('Hide Menu');
        } else {
            jQuery(this).html('Show Menu');
        }

    });

    grecaptcha.ready(function () {
        reCAPTCHA_execute();
        setInterval(reCAPTCHA_execute, 60000);
    });

    var limit = jQuery('input[name=limit_combinations]').val();
    var qty_check = 0;

    jQuery('.wc-pao-addon-toppings input[type=checkbox]').on('change', function (evt) {
        qty_check = jQuery(".wc-pao-addon-toppings input[type=checkbox]:checked").length;
        if (qty_check > limit) {
            this.checked = false;
        }
    });

    jQuery('.product_cat-poke-bowls .wc-pao-addon-toppings input[type=checkbox]').on('change', function (evt) {
        qty_check = jQuery(".wc-pao-addon-toppings input[type=checkbox]:checked").length;
        if (qty_check > 4) {
            jQuery(this).data('raw-price', 1);
            jQuery(this).data('price', 1);
        } else {
            jQuery('.product_cat-poke-bowls .wc-pao-addon-toppings input[type=checkbox]').each(function () {
                jQuery(this).data('raw-price', '');
                jQuery(this).data('price', '');
            });
        }
    });




    jQuery('.wc-pao-addon-combinations input[type=checkbox]').on('change', function (evt) {
        qty_check = jQuery(".wc-pao-addon-combinations input[type=checkbox]:checked").length;
        if (qty_check > limit) {
            this.checked = false;
        }
    });

    jQuery('.qty').before('<span class="product_quantity_minus">-</span>');
    jQuery('.qty').after('<span class="product_quantity_plus">+</span>');
    jQuery('.qty').inputFilter(function (value) {
        return /^\d*$/.test(value); // Allow digits only, using a RegExp
    });

    jQuery(".product_quantity_minus").click(function (e) {
        var quantityInput = $(this).closest(".quantity").children("input");
        var currentQuantity = parseInt($(quantityInput).val());
        if (isNaN(currentQuantity)) {
            currentQuantity = 0;
        }
        var newQuantity = (currentQuantity > 1) ? (currentQuantity - 1) : 1;
        $(quantityInput).val(newQuantity);
        if (('button[name=update_cart]').length) {
            jQuery('button[name=update_cart]').prop('disabled', false);
        }
    });

    jQuery(".product_quantity_plus").click(function (e) {
        var max_quantity = 99999;
        var quantityInput = $(this).closest(".quantity").children("input");
        var currentQuantity = parseInt($(quantityInput).val());
        if (isNaN(currentQuantity)) {
            currentQuantity = 0;
        }
        var newQuantity = (currentQuantity >= max_quantity) ? max_quantity : (currentQuantity + 1);
        $(quantityInput).val(newQuantity);
        if (('button[name=update_cart]').length) {
            jQuery('button[name=update_cart]').prop('disabled', false);
        }
    });

    jQuery('.btn-quickview').on('click', function (e) {
        e.preventDefault();
        jQuery('#productModal').modal('show');
        jQuery.ajax({
            type: 'POST',
            url: admin_url.ajax_custom_url,
            data: {
                action: 'ajax_product_quickview',
                product_id: jQuery(this).data('productid')
            },
            beforeSend: function () {
                jQuery('#productModal .modal-body').html('<div class="modal-loader"><div class="lds-ripple"><div></div><div></div></div></div>');
            },
            success: function (response) {
                jQuery('#productModal .modal-body').html(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    });

    jQuery('.btn-opentable').on('click', function () {
        jQuery('.opentable-container').toggleClass('opentable-container-hidden');
    });

    jQuery('.btn-opentable-close').on('click', function () {
        jQuery('.opentable-container').toggleClass('opentable-container-hidden');
    });

    jQuery('.menu-mobile-button').on('click', function () {
        jQuery(this).toggleClass('menu-mobile-button-opened');
        jQuery('.menu-mobile-content').toggleClass('menu-mobile-hidden');
    });

    jQuery('#productModal').on('hidden.bs.modal', function (e) {
        jQuery('#productModal .modal-body').html('');
    });

    var scroll = new SmoothScroll('a[href*="#contact"]', {

        // Selectors
        ignore: '[data-scroll-ignore]', // Selector for links to ignore (must be a valid CSS selector)
        header: null, // Selector for fixed headers (must be a valid CSS selector)
        topOnEmptyHash: true, // Scroll to the top of the page for links with href="#"

        // Speed & Duration
        speed: 500, // Integer. Amount of time in milliseconds it should take to scroll 1000px
        speedAsDuration: false, // If true, use speed as the total duration of the scroll animation
        durationMax: null, // Integer. The maximum amount of time the scroll animation should take
        durationMin: null, // Integer. The minimum amount of time the scroll animation should take
        clip: true,
        easing: 'easeInOutCubic', // Easing pattern to use
        // History
        updateURL: true, // Update the URL on scroll
        popstate: true, // Animate scrolling with the forward/backward browser buttons (requires updateURL to be true)
        // Custom Events
        emitEvents: true // Emit custom events

    });

    var scroll = new SmoothScroll('a[href*="#top"]', {

        // Selectors
        ignore: '[data-scroll-ignore]', // Selector for links to ignore (must be a valid CSS selector)
        header: null, // Selector for fixed headers (must be a valid CSS selector)
        topOnEmptyHash: true, // Scroll to the top of the page for links with href="#"

        // Speed & Duration
        speed: 500, // Integer. Amount of time in milliseconds it should take to scroll 1000px
        speedAsDuration: false, // If true, use speed as the total duration of the scroll animation
        durationMax: null, // Integer. The maximum amount of time the scroll animation should take
        durationMin: null, // Integer. The minimum amount of time the scroll animation should take
        clip: true,
        easing: 'easeInOutCubic', // Easing pattern to use
        // History
        updateURL: true, // Update the URL on scroll
        popstate: true, // Animate scrolling with the forward/backward browser buttons (requires updateURL to be true)
        // Custom Events
        emitEvents: true // Emit custom events

    });

    jQuery('input[name=fullname]').on('change', function () {
        if (jQuery('input[name=fullname]').val() == '') {
            jQuery('input[name=fullname]').next('small').removeClass('d-none').html('error');
        } else {
            if (jQuery('input[name=fullname]').val().length < 3) {

                jQuery('input[name=fullname]').next('small').removeClass('d-none').html(admin_url.invalid_name);
            } else {
                jQuery('input[name=fullname]').next('small').addClass('d-none');
            }
        }
    });

    jQuery('input[name=email]').on('change', function () {
        if (jQuery('input[name=email]').val() == '') {

            jQuery('input[name=email]').next('small').removeClass('d-none').html(admin_url.error_email);
        } else {
            if (!isValidEmailAddress(jQuery('input[name=email]').val())) {
                jQuery('input[name=email]').next('small').removeClass('d-none').html(admin_url.invalid_email);
            } else {
                jQuery('input[name=email]').next('small').addClass('d-none');
            }
        }
    });

    jQuery('input[name=subject]').on('change', function () {
        if (jQuery('input[name=subject]').val() == '') {
            jQuery('input[name=subject]').next('small').removeClass('d-none').html('error');
            jQuery('input[name=subject]').next('small').removeClass('d-none').html(admin_url.error_subject);
        } else {
            if (jQuery('input[name=subject]').val().length < 3) {
                jQuery('input[name=subject]').next('small').removeClass('d-none').html(admin_url.invalid_subject);
            } else {
                jQuery('input[name=subject]').next('small').addClass('d-none');
            }
        }
    });

    jQuery('textarea[name=message]').on('change', function () {
        if (jQuery('textarea[name=message]').val() == '') {
            jQuery('textarea[name=message]').next('small').removeClass('d-none').html(admin_url.error_message);
        } else {
            jQuery('textarea[name=message]').next('small').addClass('d-none');
        }
    });

    jQuery('form.contact-form-container').on('submit', function (e) {
        "use strict";
        passd = true;
        e.preventDefault();

        if (jQuery('input[name=fullname]').val() == '') {
            passd = false;
            jQuery('input[name=fullname]').next('small').removeClass('d-none').html(admin_url.error_name);
        } else {
            if (jQuery('input[name=fullname]').val().length < 3) {
                passd = false;
                jQuery('input[name=fullname]').next('small').removeClass('d-none').html(admin_url.invalid_name);
            } else {
                jQuery('input[name=fullname]').next('small').addClass('d-none');
            }
        }

        if (jQuery('input[name=email]').val() == '') {
            passd = false;
            jQuery('input[name=email]').next('small').removeClass('d-none').html(admin_url.error_email);
        } else {
            if (!isValidEmailAddress(jQuery('input[name=email]').val())) {
                passd = false;
                jQuery('input[name=email]').next('small').removeClass('d-none').html(admin_url.invalid_email);
            } else {
                jQuery('input[name=email]').next('small').addClass('d-none');
            }
        }

        if (jQuery('input[name=subject]').val() == '') {
            passd = false;
            jQuery('input[name=subject]').next('small').removeClass('d-none').html(admin_url.error_subject);
        } else {
            if (jQuery('input[name=subject]').val().length < 3) {
                passd = false;
                jQuery('input[name=subject]').next('small').removeClass('d-none').html(admin_url.invalid_subject);
            } else {
                jQuery('input[name=subject]').next('small').addClass('d-none');
            }
        }

        if (jQuery('textarea[name=message]').val() == '') {
            passd = false;
            jQuery('textarea[name=message]').next('small').removeClass('d-none').html(admin_url.error_message);
        } else {
            jQuery('textarea[name=message]').next('small').addClass('d-none');
        }

        if (passd == true) {
            jQuery.ajax({
                type: 'POST',
                url: admin_url.ajax_custom_url,
                data: {
                    action: 'ajax_send_contact_form',
                    info: jQuery('.contact-form-container').serialize()
                },
                beforeSend: function () {
                    jQuery('.contact-form-loader').append('<div class="ajax-loader"><div class="lds-ripple"><div></div><div></div></div></div>');
                },
                success: function (response) {
                    jQuery('.contact-form-loader').html('');
                    if (response == 'true') {
                        jQuery('.contact-form-response').html('<div>' + admin_url.success_form + '<div>');
                    } else {
                        jQuery('.contact-form-response').html('<div>' + admin_url.success_form + '<div>');
                        //                        jQuery('.contact-form-response').html('<div>' + admin_url.error_form + '<div>');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    });
}); /* end of as page load scripts */




(function ($) {
    $(document).on('click', '#custom_ajax_add_to_cart', function (e) {
        e.preventDefault();
        var $thisbutton = $(this),
            id = jQuery(this).data('id');

        if (jQuery(this).hasClass('disabled')) {
            console.log('true');
            var custom_url = jQuery(this).data('url');
            location.href = custom_url;
        } else {
            console.log('false');
            var data = {
                action: 'woocommerce_ajax_add_to_cart',
                product_id: jQuery(this).data('id'),
                product_sku: jQuery(this).data('sku'),
                quantity: 1,
                variation_id: 0
            };

            $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

            $.ajax({
                type: 'post',
                url: wc_add_to_cart_params.ajax_url,
                data: data,
                beforeSend: function (response) {
                    jQuery('.response-ajax-container-' + id).html('<div class="ajax-loader"><div class="lds-ripple"><div></div><div></div></div></div>');
                },
                success: function (response) {
                    if (response.error & response.product_url) {
                        window.location = response.product_url;
                        return;
                    } else {
                        jQuery('.response-ajax-container-' + id).html('<span>Added to Cart</span><a href="' + admin_url.cart_custom_url + '">View Cart</a>');
                        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, '']);
                    }
                },
            });
        }
    });
})(jQuery);
