<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link  https://webappick.com
 * @since 1.0.0
 *
 * @package    Woo_Invoice
 * @subpackage Woo_Invoice/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Invoice
 * @subpackage Woo_Invoice/admin
 * @author     Md Ohidul Islam <wahid@webappick.com>
 */
class Woo_Invoice_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $plugin_name The name of this plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_styles() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Woo_Invoice_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Woo_Invoice_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style('slick', CHALLAN_FREE_ADMIN_URL . 'css/minify/slick.min.css', array(), $this->version);
        wp_enqueue_style('slick-theme', CHALLAN_FREE_ADMIN_URL . 'css/minify/slick-theme.min.css', array(), $this->version);
        wp_enqueue_style('webappick-boilerplate', CHALLAN_FREE_ADMIN_URL . 'css/minify/webappick-boilerplate-admin.min.css', array(), $this->version, 'all');
        wp_enqueue_style('flatpickr', CHALLAN_FREE_ADMIN_URL . 'css/minify/flatpickr.min.css', array(), $this->version, 'all');
        wp_enqueue_style('selectize-default', CHALLAN_FREE_ADMIN_URL . 'css/minify/selectize.default.min.css', array(), $this->version, 'all');
        wp_enqueue_style('selectize', CHALLAN_FREE_ADMIN_URL . 'css/minify/selectize.min.css', array(), $this->version, 'all');
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_base_styles() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Woo_Invoice_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Woo_Invoice_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, CHALLAN_FREE_ADMIN_URL . 'css/minify/webappick-pdf-invoice-for-woocommerce-admin.min.css', array(), $this->version, 'all');

    }


    /**
     * Register the JavaScript for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Woo_Invoice_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Woo_Invoice_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, CHALLAN_FREE_ADMIN_URL . 'js/webappick-pdf-invoice-for-woocommerce-admin.min.js', array( 'jquery' ), $this->version, true);
        wp_enqueue_script($this->plugin_name . '_boilerplate', CHALLAN_FREE_ADMIN_URL . 'js/webappick-pdf-invoice-for-woocommerce-bundle.js', array( 'jquery' ), $this->version, true);
        wp_enqueue_script($this->plugin_name . '_flatpickr-js', CHALLAN_FREE_ADMIN_URL . 'js/flatpickr.min.js', array( 'jquery' ), $this->version, false);
        wp_enqueue_script($this->plugin_name . '_jquery-slick', CHALLAN_FREE_ADMIN_URL . 'js/slick.min.js', array( 'jquery', 'jquery-migrate' ), $this->version, true);
        wp_enqueue_script($this->plugin_name . '_jquery-selectize', CHALLAN_FREE_ADMIN_URL . 'js/selectize.min.js', array( 'jquery' ), $this->version, false);

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_common_scripts() {
        wp_enqueue_script($this->plugin_name . 'common', CHALLAN_FREE_ADMIN_URL . 'js/webappick-pdf-invoice-for-woocommerce-common.min.js', array( 'jquery' ), $this->version, false);
        $wpifw_nonce = wp_create_nonce('woo_invoice_ajax_nonce');
        wp_localize_script(
            $this->plugin_name . 'common',
            'woo_invoice_ajax_obj_2',
            array(
				'woo_invoice_ajax_url_2' => admin_url('admin-ajax.php'),
				'nonce'                  => $wpifw_nonce,
            )
        );
        wp_enqueue_script($this->plugin_name . 'common', 'woo_invoice_ajax_obj_2', array( 'jquery' ), $this->version, true);

    }

    /**
     * Register PDF Invoice Menu.
     */
    public function load_admin_menu() {
        $hook = add_menu_page(__('Challan', 'webappick-pdf-invoice-for-woocommerce'), __('Challan', 'webappick-pdf-invoice-for-woocommerce'), 'manage_woocommerce', 'webappick-woo-invoice', 'woo_invoice_settings', 'dashicons-media-spreadsheet');
        add_submenu_page('webappick-woo-invoice', __('Settings', 'webappick-pdf-invoice-for-woocommerce'), __('Settings', 'webappick-pdf-invoice-for-woocommerce'), 'manage_woocommerce', 'webappick-woo-invoice', 'woo_invoice_settings');
        add_submenu_page('webappick-woo-invoice', __('Docs', 'webappick-pdf-invoice-for-woocommerce'), '<span class="woo-invoice-docs">' . __('Docs', 'webappick-pdf-invoice-for-woocommerce') . '</span>', 'manage_woocommerce', 'webappick-woo-docs', 'woo_invoice_docs');
        add_submenu_page('webappick-woo-invoice', __('Premium', 'webappick-pdf-invoice-for-woocommerce'), '<span class="woo-invoice-premium">' . __('Premium', 'webappick-pdf-invoice-for-woocommerce') . '</span>', 'manage_woocommerce', 'webappick-woo-pro-vs-free', 'woo_invoice_pro_vs_free');

        add_action('admin_print_scripts-' . $hook, array( $this, 'enqueue_styles' ));
        add_action('admin_print_scripts-' . $hook, array( $this, 'enqueue_scripts' ));
    }
}
