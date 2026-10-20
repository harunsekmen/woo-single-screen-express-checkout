<?php
/**
 * Plugin Name:       WooCommerce Single-Screen Express Checkout
 * Plugin URI:        https://github.com/harunsekmen/woo-single-screen-express-checkout
 * Description:       Shopify Plus-style 2-column single-screen checkout with express Apple Pay/Google Pay and smart address hierarchy.
 * Version:           1.0.0
 * Author:            Harun Sekmen
 * Author URI:        https://github.com/harunsekmen
 * License:           GPL-3.0
 * Requires at least: 6.2
 * Requires PHP:      8.1
 * WC requires at least: 8.0
 */

defined('ABSPATH') || exit;

add_action('before_woocommerce_init', function () {
    if (class_exists(AutomatticWooCommerceUtilitiesFeaturesUtil::class)) {
        AutomatticWooCommerceUtilitiesFeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
    }
});

require_once __DIR__ . '/includes/class-checkout-engine.php';

add_action('plugins_loaded', ['Woo_Single_Screen_Checkout_Engine', 'instance']);
