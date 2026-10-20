<?php
defined('ABSPATH') || exit;

final class Woo_Single_Screen_Checkout_Engine {
    const VERSION = '1.0.0';
    private static ?self $instance = null;

    public static function instance(): self {
        return self::$instance ??= new self();
    }

    private function __construct() {
        add_filter('woocommerce_checkout_fields', [$this, 'optimize_checkout_fields'], 999);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_checkout_assets']);
        add_action('woocommerce_before_checkout_form', [$this, 'render_express_buttons_container'], 5);
        add_action('wp_ajax_wssec_validate_postal_code', [$this, 'ajax_validate_postal_code']);
        add_action('wp_ajax_nopriv_wssec_validate_postal_code', [$this, 'ajax_validate_postal_code']);
    }

    public function optimize_checkout_fields(array $fields): array {
        if (!function_exists('is_checkout') || !is_checkout()) {
            return $fields;
        }

        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_address_2']);

        if (isset($fields['billing']['billing_email'])) {
            $fields['billing']['billing_email']['priority'] = 5;
            $fields['billing']['billing_email']['class'] = ['form-row-wide', 'wssec-field'];
        }
        if (isset($fields['billing']['billing_first_name'])) {
            $fields['billing']['billing_first_name']['priority'] = 10;
            $fields['billing']['billing_first_name']['class'] = ['form-row-first', 'wssec-field'];
        }
        if (isset($fields['billing']['billing_last_name'])) {
            $fields['billing']['billing_last_name']['priority'] = 20;
            $fields['billing']['billing_last_name']['class'] = ['form-row-last', 'wssec-field'];
        }
        if (isset($fields['billing']['billing_phone'])) {
            $fields['billing']['billing_phone']['priority'] = 30;
            $fields['billing']['billing_phone']['class'] = ['form-row-wide', 'wssec-field'];
        }

        return $fields;
    }

    public function enqueue_checkout_assets(): void {
        if (!function_exists('is_checkout') || !is_checkout() || is_order_received_page()) {
            return;
        }

        wp_enqueue_style(
            'wssec-checkout-styles',
            plugins_url('assets/css/checkout.css', dirname(__FILE__)),
            [],
            self::VERSION
        );

        wp_enqueue_script(
            'wssec-checkout-script',
            plugins_url('assets/js/checkout.js', dirname(__FILE__)),
            ['jquery'],
            self::VERSION,
            true
        );

        wp_localize_script('wssec-checkout-script', 'WSSEC_Config', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('wssec_checkout_nonce')
        ]);
    }

    public function render_express_buttons_container(): void {
        echo '<div id="wssec-express-checkout-wrapper" class="wssec-express-box">';
        echo '<div class="wssec-express-title"><span>' . esc_html__('Express Checkout', 'woo-single-screen-express-checkout') . '</span></div>';
        echo '<div id="wssec-express-payment-buttons"></div>';
        echo '<div class="wssec-divider"><span>' . esc_html__('OR', 'woo-single-screen-express-checkout') . '</span></div>';
        echo '</div>';
    }

    public function ajax_validate_postal_code(): void {
        check_ajax_referer('wssec_checkout_nonce', 'nonce');
        $code = sanitize_text_field(wp_unslash($_POST['postal_code'] ?? ''));

        if (empty($code)) {
            wp_send_json_error(['message' => 'Empty postal code']);
        }

        wp_send_json_success(['valid' => true, 'code' => $code]);
    }
}
