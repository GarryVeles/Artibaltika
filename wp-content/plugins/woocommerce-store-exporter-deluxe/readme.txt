=== WooCommerce - Store Exporter Deluxe ===

Contributors: visser
Donate link: http://www.visser.com.au/#donations
Tags: e-commerce, woocommerce, shop, cart, ecommerce, export, csv
Requires at least: 2.9.2
Tested up to: 3.8.1
Stable tag: 1.4.6

== Description ==

Export store details out of WooCommerce into a CSV-formatted file.

Features include:

* Export Products (*)
* Export Categories
* Export Tags
* Export Orders
* Export Customers
* Export Coupons

(*) Compatible with Product Importer Deluxe, All in One SEO Pack, Advanced Google Product Feed, Product Addons, Sequential Order Number Pro, WooCommerce Checkout Manager, Cost of Goods, Per-Product Shipping and more.

For more information visit: http://www.visser.com.au/woocommerce/

== Installation ==

1. Upload the folder 'woocommerce-exporter-deluxe' to the '/wp-content/plugins/' directory

2. Activate 'WooCommerce - Exporter' through the 'Plugins' menu in WordPress

3. See Usage section

== Usage ==

1. Open WooCommerce > Export from the WordPress Administration

2. Select which WooCommerce details you would like to export and click Export

3. Open Archives to re-download previous exports *

That's it!

(*) Archiving works if 'Delete temporary CSV after export' is disabled under Export Options

== Support ==

If you have any problems, questions or suggestions please join the members discussion on our WooCommerce dedicated forum.

http://www.visser.com.au/woocommerce/forums/

== Changelog ==

= 1.4.6 =
* Added: Support for multiple variation within Order Items: Product Variation
* Added: Order Items: Category and Tags to Orders export
* Fixed: Empty Quantity in Order Items: Quantity for unique order items formatting

= 1.4.5 =
* Added: Advanced Custom Fields support for Products export
* Changed: Dropped $wpsc_ce global
* Added: Using Plugin constants
* Added: Cost of Goods integration for Orders export

= 1.4.4 =
* Changed: Removed functions-alternatives.php
* Fixed: Compatibility with legacy WooCommerce 1.6

= 1.4.3 =
* Fixed: Formatting of Order Items: Type for tax
* Added: Memory optimisations for get_posts()
* Changed: Removed functions-alternatives.php
* Added: Custom Product Fields support
* Fixed: Filter Orders by Date option

= 1.4.2 =
* Fixed: PHP error affecting Coupons export
* Fixed: Date Format support for Purchase Date and Expiry Date

= 1.4.1 =
* Added: Cost of Goods integration for Products export
* Added: Per-Product Shipping integration for Products export
* Fixed: Export Orders by User Roles
* Added: Formatting of User Role

= 1.4 =
* Fixed: User Role not displaying within Customers export in WordPress 3.8
* Added: New automatic Plugin updater

= 1.3.9 =
* Added: Payment Gateway ID to Orders export
* Added: Shipping Method ID to Orders export
* Added: Shipping Cost to Orders export
* Added: Checkout IP Address to Orders export
* Added: Checkout Browser Agent to Orders export
* Added: Filter Orders by User Role for Orders export
* Added: User Role to Orders export
* Added: User Role to Customers export

= 1.3.8 =
* Added: Support for Sequential Order Numbers Pro
* Fixed: Fatal error affecting Order exports

= 1.3.7 =
* Changed: Added Docs, Premium Support, Export link to Plugins screen

= 1.3.6 =
* Fixed: Fatal error affecting Order exports

= 1.3.5 =
* Changed: Display detection notices only on Plugins screen
* Added: Display notice when WooCommerce isn't detected
* Fixed: Admin icon on Store Exporter screen
* Added: Export Details widget to Media Library for debug
* Fixed: Fatal error affecting Custom Order Items

= 1.3.4 =
* Fixed: Order Notes on Orders export
* Added: Notice when Store Exporter Plugin is not installed
* Changed: Purchase Date to exclude time
* Added: Total excl. GST
* Added: Purchase Time
* Added: Commenting to each function

= 1.3.3 =
* Changed: Ammended Custom Order Fields note
* Changed: Store Export menu to Export
* Added: Custom Order Items meta support
* Changed: Extended Custom Order meta support
* Added: Help suggestions for Custom Order and Custom Order Item meta
* Added: Product Add Ons integration

= 1.3.2 =
* Added: jQuery Chosen support to Orders Customer dropdown

= 1.3.1 =
* Fixed: Column issue in unique Order Items formatting

= 1.3 =
* Added: New Order date filtering methods
* Added: Order Items formatting
* Added: Order Item Tax Class option
* Added: Order Item Type option
* Added: Formatting of Order Item Tax Class labels
* Added: Formatting of Order Item Type labels
* Fixed: Notices under WP_DEBUG
* Added: N/A value for manual Order creation

= 1.2.8 =
* Fixed: Error notice under WP_DEBUG

= 1.2.7 =
* Added: Escape field formatting option
* Added: Payment Status (number) option
* Added: Filter Orders by Customer option
* Added: Filter Orders by Order Status option

= 1.2.6 =
* Fixed: Order Date to include todays Orders
* Fixed: Removed excess separator at end of each line
* Moved: Order Dates to Order Options
* Added: Order Options section

= 1.2.5 =
* Fixed: Coupons export

= 1.2.4 =
* Changed: Added formatting to Purchase Date
* Fixed: Limit Volume and Offset affecting Orders

= 1.2.3 =
* Fixed: Error on landing page for non-base Plugin users
* Fixed: Link on landing page to Install Plugins

= 1.2.2 =
* Fixed: Customers report
* Added: Total Spent to Customers report
* Added: Completed Orders to Customers report
* Added: Total Orders to Customers report
* Fixed: Customers counter
* Added: Prefix and full Country and State name support

= 1.2.1 =
* Added: Custom Sale meta support

= 1.2 =
* Fixed: Sale export

= 1.1 =
* Added: Admin notice if Store Exporter is not activated
* Added: WordPress Plugin search link to Store Exporter
* Added: Export link to Plugins screen
* Fixed: Duplicate Store Export menu links

= 1.0 =
* Added: First working release of the Plugin

== Disclaimer ==

It is not responsible for any harm or wrong doing this Plugin may cause. Users are fully responsible for their own use. This Plugin is to be used WITHOUT warranty.