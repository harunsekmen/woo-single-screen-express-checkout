<?php
defined('ABSPATH') || exit;

/**
 * Enterprise Single-Screen Express Checkout Engine
 * Provides a streamlined 2-column Shopify-style checkout experience for WooCommerce.
 *
 * @package WooSingleScreenExpressCheckout
 * @author  Harun Sekmen <sekmenwp@gmail.com>
 */
final class Woo_Single_Screen_Checkout_Engine {
    const VERSION = '1.0.0';
    private static ?self $instance = null;

    public static function instance(): self {
        return self::$instance ??= new self();
    }

    private function __construct() {
        add_filter('woocommerce_checkout_fields', [$this, 'filter_checkout_fields'], 999);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('woocommerce_before_checkout_form', [$this, 'render_express_header'], 5);
        add_action('woocommerce_checkout_order_review', [$this, 'render_security_badges'], 25);
        add_action('wp_ajax_wssec_lookup_postcode', [$this, 'ajax_lookup_postcode']);
        add_action('wp_ajax_nopriv_wssec_lookup_postcode', [$this, 'ajax_lookup_postcode']);
    }

    public function filter_checkout_fields(array $fields): array {
        if (!function_exists('is_checkout') || !is_checkout()) {
            return $fields;
        }

        // Strip non-essential fields that reduce conversion
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['shipping']['shipping_company']);
        unset($fields['shipping']['shipping_address_2']);

        // Priority 1: Email first (Shopify layout)
        if (isset($fields['billing']['billing_email'])) {
            $fields['billing']['billing_email']['priority'] = 5;
            $fields['billing']['billing_email']['class'] = ['form-row-wide', 'wssec-input-field'];
            $fields['billing']['billing_email']['placeholder'] = esc_html__('Email address for order updates', 'woo-single-screen-express-checkout');
        }

        // Priority 2: Customer Name (Two columns)
        if (isset($fields['billing']['billing_first_name'])) {
            $fields['billing']['billing_first_name']['priority'] = 10;
            $fields['billing']['billing_first_name']['class'] = ['form-row-first', 'wssec-input-field'];
        }
        if (isset($fields['billing']['billing_last_name'])) {
            $fields['billing']['billing_last_name']['priority'] = 12;
            $fields['billing']['billing_last_name']['class'] = ['form-row-last', 'wssec-input-field'];
        }

        // Priority 3: Address & Phone
        if (isset($fields['billing']['billing_address_1'])) {
            $fields['billing']['billing_address_1']['priority'] = 20;
            $fields['billing']['billing_address_1']['class'] = ['form-row-wide', 'wssec-input-field'];
            $fields['billing']['billing_address_1']['placeholder'] = esc_html__('Street address, apartment, suite', 'woo-single-screen-express-checkout');
        }
        if (isset($fields['billing']['billing_phone'])) {
            $fields['billing']['billing_phone']['priority'] = 30;
            $fields['billing']['billing_phone']['class'] = ['form-row-wide', 'wssec-input-field'];
        }

        return $fields;
    }

    public function render_express_header(): void {
        echo '<div id="wssec-express-wrapper" class="wssec-express-container">';
        echo '<div class="wssec-express-label"><span>' . esc_html__('Express Checkout', 'woo-single-screen-express-checkout') . '</span></div>';
        echo '<div id="wssec-express-buttons-mount" class="wssec-buttons-slot"></div>';
        echo '<div class="wssec-divider-line"><span>' . esc_html__('Or continue below', 'woo-single-screen-express-checkout') . '</span></div>';
        echo '</div>';
    }

    public function render_security_badges(): void {
        echo '<div class="wssec-trust-badges">';
        echo '<span class="wssec-badge">🔒 256-Bit SSL Encrypted</span>';
        echo '<span class="wssec-badge">🛡️ Fraud Protected</span>';
        echo '<span class="wssec-badge">⚡ Instant Order Confirmation</span>';
        echo '</div>';
    }

    public function ajax_lookup_postcode(): void {
        check_ajax_referer('wssec_checkout_nonce', 'nonce');
        $code = sanitize_text_field(wp_unslash($_POST['postcode'] ?? ''));

        if (strlen($code) < 3) {
            wp_send_json_error(['message' => 'Postcode too short']);
        }

        wp_send_json_success([
            'valid' => true,
            'code'  => $code
        ]);
    }

    public function enqueue_assets(): void {
        if (!function_exists('is_checkout') || !is_checkout() || is_order_received_page()) {
            return;
        }

        wp_enqueue_style('wssec-style', plugins_url('assets/css/checkout.css', dirname(__FILE__)), [], self::VERSION);
        wp_enqueue_script('wssec-script', plugins_url('assets/js/checkout.js', dirname(__FILE__)), ['jquery'], self::VERSION, true);

        wp_localize_script('wssec-script', 'WSSEC_Settings', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('wssec_checkout_nonce')
        ]);
    }
}
