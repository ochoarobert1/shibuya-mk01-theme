jQuery(document).ready(function ($) {
    "use strict";
    jQuery('.btn-quickview').on('click', function (e) {
        e.preventDefault();
        jQuery('#productModal').modal('show');
        jQuery.ajax({
            type: 'POST',
            url: admin_url.ajax_url,
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
