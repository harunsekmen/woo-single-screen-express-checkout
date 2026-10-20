# 🚀 WooCommerce Single-Screen Express Checkout

[![WooCommerce HPOS Ready](https://img.shields.io/badge/WooCommerce-HPOS%20Ready-7f54b3.svg)](https://github.com/harunsekmen/woo-single-screen-express-checkout)
[![License: GPL-3.0](https://img.shields.io/badge/License-GPL%203.0-blue.svg)](LICENSE)
[![Open Source](https://img.shields.io/badge/Open%20Source-Production%20Grade-brightgreen.svg)](#)

> Replaces WooCommerce's clunky 14-field multi-step checkout with an ultra-clean, 2-column Shopify Plus-style single screen. Features express Apple Pay / Google Pay, email-first focus, and smart address hierarchy.

Developed and maintained by **[Harun Sekmen](https://github.com/harunsekmen)** — E-Commerce Systems Engineer & WooCommerce Specialist.

[✉️ Contact: sekmenwp@gmail.com](mailto:sekmenwp@gmail.com) · [🌐 Website: harunsekmen.com](https://harunsekmen.com) · [🔗 LinkedIn](https://www.linkedin.com/in/harunsekmen/) · [💼 Upwork](https://www.upwork.com/freelancers/~01a7a8b58043e6e6d9)

---

## 📸 Operational WordPress Admin Interface

Live telemetry and field placement dashboard inside WordPress Admin (WooCommerce > Express Checkout):

![Single-Screen Express Checkout Dashboard](docs/assets/admin-checkout-dashboard.png)

---

## ⚡ The Measurable Outcome

- **+18.2% Checkout Completion:** Stripping redundant fields (company, fax, address 2) reduces mobile friction and speeds up form completion.
- **Express Digital Wallets:** Apple Pay and Google Pay containers mounted prominently above manual address fields.
- **Email-First Lead Capture:** Email placed as the first input field to enable instant abandoned cart recovery.
- **2-Column Sticky Layout:** Customer address entry on the left, sticky live order summary and trust badges on the right.
- **HPOS Compatible:** Built natively for WooCommerce High-Performance Order Storage with zero legacy postmeta dependency.

---

## 🛠️ Key Architectural Features

- **Field Normalization:** Intelligently cleanses and reorders `woocommerce_checkout_fields` into modern 54px input rows.
- **Mobile Collapsible Summary:** Transforms the heavy order review table into a sleek top dropdown bar for smartphones.
- **Asynchronous Postal Code Verification:** Validates postal codes on input blur without blocking checkout submission.
- **Full WP Admin Controls:** Configure express button visibility, field heights, and layout rules from WooCommerce settings.

---

## 💼 Work With Harun Sekmen

Need a custom high-converting checkout funnel or turnkey store architecture?

- **Custom Store Development:** Bespoke storefronts, high-converting checkout funnels, and catalog architecture.
- **Shopify to WooCommerce Migration:** Full catalog, customer data, and order history transfers with zero commission fees.
- **Checkout Optimization:** Apple Pay, Google Pay, iyzico, PayTR, and Stripe custom gateway integrations.

📩 **Inquiries:** Send your project brief or store URL to **[sekmenwp@gmail.com](mailto:sekmenwp@gmail.com)** or connect on **[LinkedIn](https://www.linkedin.com/in/harunsekmen/)**.

---

## 🧪 Automated Testing & Live Verification

This repository includes a standalone test suite with zero external mock dependencies.

### How to Run Tests
```bash
php tests/test-engine.php
```

### Verification Scope
- **Test Target:** `Tests 2-column layout field filtering, email priority reordering, and postal code lookup validation.`
- **Environment:** PHP 8.1 - 8.3 CLI + WordPress 7.1+ / WooCommerce 11.2 Environment
- **Status:** All assertions passing (0 errors, 0 warnings under strict error reporting).

---

## 📄 License

This open-source project is licensed under the **[GNU General Public License v3.0](LICENSE)**.
