(function($) {
  'use strict';
  $(document).ready(function() {
    if ($(window).width() < 992) {
      const $orderReview = $('#order_review');
      if ($orderReview.length && !$('#wssec-mobile-toggle').length) {
        const toggleHtml = '<div id="wssec-mobile-toggle" class="wssec-mobile-bar" style="background:#f3f4f6;padding:14px;border-radius:6px;margin-bottom:16px;cursor:pointer;display:flex;justify-content:space-between;font-weight:600;">' +
          '<span>Order Summary</span><span class="wssec-toggle-icon">▼</span>' +
          '</div>';
        $orderReview.before(toggleHtml);
        $('#wssec-mobile-toggle').on('click', function() {
          $orderReview.slideToggle(200);
        });
      }
    }
  });
})(jQuery);
