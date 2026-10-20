<?php
require_once __DIR__ . '/bootstrap.php';

require_once dirname(__DIR__) . '/includes/class-checkout-engine.php';

echo "Testing Woo_Single_Screen_Checkout_Engine...
";
$engine = Woo_Single_Screen_Checkout_Engine::instance();
assert($engine instanceof Woo_Single_Screen_Checkout_Engine, "Instance check failed");
$sample = [
    'billing' => [
        'billing_company' => ['label' => 'Company'],
        'billing_address_2' => ['label' => 'Address 2'],
        'billing_first_name' => ['label' => 'First'],
        'billing_last_name' => ['label' => 'Last'],
        'billing_email' => ['label' => 'Email']
    ]
];
$res = $engine->optimize_checkout_fields($sample);
assert(is_array($res), "Result must be array");
echo "PASS: Woo_Single_Screen_Checkout_Engine verified.
";
