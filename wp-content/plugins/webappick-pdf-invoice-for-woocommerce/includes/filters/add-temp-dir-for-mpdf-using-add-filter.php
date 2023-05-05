<?php
/**
 * Scripts for plugin activation hook
 *
 * @since      3.3.25
 * @package    Challan_Free
 * @subpackage Challan_Free/filters
 * @author     Anwar <anwar.webappick@gmail.com>
 * @link       https://webappick.com
 */
// If this file is called directly, abort.
if ( ! defined('ABSPATH') ) {
    exit;
}
/**
 * Moved MPDF temp dir outside MPDF library dir by modifying configuration
 */
add_filter("woo_invoice_mpdf_settings", function ( $mpdfConfig ) {
    $mpdfConfig["tempDir"] = rtrim(CHALLAN_FREETEMP_DIR, "/");
    return $mpdfConfig;
});

////testing MPDF config and settings
//function Challan_TestMpdfConfig() {
//    $html = "<h1>Test MDF config </h1>";
//    $file_name = "test-mpdf-".time().".pdf";
//    $order_id = '1';
//    $template="default";
//    $paper_size="A4";
//    $pdf = new Woo_Invoice_PDF($html, $file_name, $order_id, $template, $paper_size );
//}
//Challan_TestMpdfConfig();

