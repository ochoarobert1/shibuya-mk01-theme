jQuery(document).ready(function ($) {
    "use strict";
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

    jQuery('#productModal').on('hidden.bs.modal', function (e) {
        jQuery('#productModal .modal-body').html('');
    })
}); /* end of as page load scripts */




(function ($) {
    $(document).on('click', '#custom_ajax_add_to_cart', function (e) {
        e.preventDefault();
        var $thisbutton = $(this),
            id = jQuery(this).data('id');

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
                    jQuery('.response-ajax-container-' + id).html('<span>Added to Cart</span><a href="'+ admin_url.cart_custom_url + '">View Cart</a>');
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, '']);
                }
            },
        });
    });


})(jQuery);
