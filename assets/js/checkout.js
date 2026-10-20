(function($) {
  'use strict';
  $(document).ready(function() {
    // Mobile Collapsible Order Summary Bar
    if ($(window).width() < 992) {
      const $review = $('#order_review');
      if ($review.length && !$('#wssec-mobile-bar').length) {
        const bar = $('<div id="wssec-mobile-bar" class="wssec-mobile-summary" style="background:#f3f4f6;padding:14px 18px;border-radius:6px;margin-bottom:16px;cursor:pointer;display:flex;justify-content:space-between;align-items:center;font-weight:600;">' +
          '<span>🛒 ' + (window.WSSEC_Settings ? 'View Order Summary' : 'Order Summary') + '</span>' +
          '<span class="wssec-chevron">▼</span>' +
        '</div>');
        $review.before(bar);
        bar.on('click', function() {
          $review.slideToggle(200);
          $(this).toggleClass('is-open');
        });
      }
    }

    // Auto-formatting postcode lookup on blur
    $('#billing_postcode').on('blur', function() {
      const code = $(this).val().trim();
      if (code.length >= 4 && window.WSSEC_Settings) {
        $.post(WSSEC_Settings.ajax_url, {
          action: 'wssec_lookup_postcode',
          postcode: code,
          nonce: WSSEC_Settings.nonce
        }).done(function(res) {
          if (res && res.success) {
            $('#billing_postcode').addClass('is-validated');
          }
        });
      }
    });
  });
})(jQuery);
