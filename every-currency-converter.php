<?php

/**
 * Plugin Name: Every currency converter
 * Description: The Every Currency Converter: Seamlessly convert currencies in your WooCommerce store, providing accurate and convenient shopping experiences for global customers.
 * Plugin URI: https://elementor.com/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Version: 1.0.0
 */
include 'woo-added.php';

if (!session_id()) {
    session_start();
}

add_action('wp_enqueue_scripts', 'my_enqueue_scripts');
function my_enqueue_scripts()
{
    wp_enqueue_script('my-ajax-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), '3.4.0', true);
    wp_enqueue_style( 'my-ajax-style', plugins_url( 'assets/css/style.css', __FILE__ ), array(), '1.0.0', 'all' );
    // Localize AJAX URL and other variables
    wp_localize_script('my-ajax-script', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('my_ajax_nonce')
    ));
}

function get_currency()
{
    echo '<div id="every_currency_converter"><select id="change_currency_by_harsh" data-currency="' . get_woocommerce_currency() . '">
     <option value="">Change Currency</option>';
    foreach (get_option('wc_every_currency_converter_selector', array()) as $data) {
        echo '<option value="' . explode("|", $data)[0] . '" ' . (explode("|", $data)[0] == get_woocommerce_currency() ? 'selected' : '') . '>' . explode("|", $data)[1] . '</option>';
    }
    echo '</select></div>';
}
add_shortcode('every_currency_converter', 'get_currency');

function change_currency_select_widget()
{
    require_once plugin_dir_path(__FILE__) . 'widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Class_change_currency_select_widget());
}
add_action('elementor/widgets/widgets_registered', 'change_currency_select_widget');
// Register AJAX action
add_action('wp_ajax_my_ajax_action', 'my_ajax_action_callback');
add_action('wp_ajax_nopriv_my_ajax_action', 'my_ajax_action_callback'); // For non-logged in users


// AJAX callback function
function my_ajax_action_callback()
{    
    $from = get_woocommerce_currency();
    $to = $_POST['to'];
    $api = get_option('wc_every_currency_converter_title', true);
    $url = "https://flightbulk.com/currency-converter/?api=$api&from=$from&to=$to";
    $ch = curl_init();
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL, $url);
    // Execute
    $result = curl_exec($ch);
    // Closing
    curl_close($ch);
    $rate = json_decode($result, true)['data']['rate'];
    $_SESSION['typeOfCurrencySet'] = json_decode($result, true)['data']['rate'];
    $_SESSION['typeOfCurrencyTO'] = $to;
    exit;
}

if (isset($_SESSION['typeOfCurrencySet']) && $_SESSION['typeOfCurrencyTO'] && !is_admin()) {
    add_filter('woocommerce_product_get_price', 'add_usd_to_product_price', 10, 2);
    add_filter('woocommerce_product_variation_get_price', 'add_usd_to_product_price', 10, 2);
    add_filter('woocommerce_format_price_range', 'add_usd_to_variable_price_range', 10, 3);
    add_filter('woocommerce_currency', 'change_woocommerce_currency', 10, 1);
}

function add_usd_to_product_price($price, $product)
{
    if (!empty($price) && is_numeric($price)) {
        $price = isset($_SESSION['typeOfCurrencySet']) ? $price * $_SESSION['typeOfCurrencySet'] : $price;
    }
    return $price;
}

function add_usd_to_variable_price_range($price, $from, $to)
{
    $from = $from * $_SESSION['typeOfCurrencySet'];
    $to = $to * $_SESSION['typeOfCurrencySet'];
    // Format the price range with the currency symbol
    $price = sprintf('%1$s - %2$s', wc_price($from), wc_price($to));
    return $price;
}

function change_woocommerce_currency($currency)
{
    $currency = $_SESSION['typeOfCurrencyTO'];
    return $currency;
}
