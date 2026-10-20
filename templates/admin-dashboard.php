<?php
defined('ABSPATH') || exit;
?>
<div class="wrap woo-single-screen-express-checkout-admin-wrap">
    <h1><?php esc_html_e('Single-Screen Express Checkout Settings', 'woo-single-screen-express-checkout'); ?></h1>
    <p class="description">
        <?php esc_html_e('Configured and maintained by Harun Sekmen — Enterprise WooCommerce Architecture.', 'woo-single-screen-express-checkout'); ?>
    </p>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-top: 24px;">
        <div class="main-settings-column">
            <div class="postbox" style="padding: 24px; background: #fff; border: 1px solid #c3c4c7; border-radius: 4px;">
                <h2><?php esc_html_e('Engine Configuration', 'woo-single-screen-express-checkout'); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields('wssec_settings_group'); ?>
                    <table class="form-table" role="presentation">
                        <tbody>
                            <tr>
                                <th scope="row"><?php esc_html_e('Operational Status', 'woo-single-screen-express-checkout'); ?></th>
                                <td>
                                    <span class="badge" style="background:#10b981;color:#fff;padding:4px 10px;border-radius:12px;font-weight:600;font-size:12px;">Active & HPOS Compatible</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php esc_html_e('Core Parameters', 'woo-single-screen-express-checkout'); ?></th>
                                <td>
                                    <code><?php echo esc_html(wp_json_encode($settings)); ?></code>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php submit_button(__('Save Configuration', 'woo-single-screen-express-checkout')); ?>
                </form>
            </div>
        </div>

        <div class="sidebar-info-column">
            <div class="postbox" style="padding: 20px; background: #fff; border: 1px solid #c3c4c7; border-radius: 4px;">
                <h3><?php esc_html_e('Developer & Support', 'woo-single-screen-express-checkout'); ?></h3>
                <p><?php esc_html_e('Developed by Harun Sekmen. Custom e-commerce engineering, checkout optimization, and high-performance WooCommerce architectures.', 'woo-single-screen-express-checkout'); ?></p>
                <p><strong>Email:</strong> <a href="mailto:sekmenwp@gmail.com">sekmenwp@gmail.com</a></p>
                <p><strong>Web:</strong> <a href="https://harunsekmen.com" target="_blank">harunsekmen.com</a></p>
            </div>
        </div>
    </div>
</div>
