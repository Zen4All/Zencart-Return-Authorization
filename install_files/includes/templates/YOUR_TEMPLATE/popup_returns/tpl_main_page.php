<?php
/**
 * tpl_main_page.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 2870 2006-01-21 21:36:02Z birdbrain $
 */
$autoRMA = ORDER_STATUS_RMA;
$orderID = $_GET['order_id'];

$getKeys = "SELECT rma_number
            FROM " . TABLE_ORDERS_STATUS_HISTORY . "
            WHERE orders_id = " . (int)$orderID . "
            AND orders_status_id = " . (int)$autoRMA;

$rmaNumber = $db->Execute($getKeys);
?>
<body id="popupReturns">
  <br class="clearBoth" />
  <table border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center">
        <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG; ?>"><?php echo zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base, 'images') . '/' . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT); ?></a>
      </td>
    </tr>
    <tr>
      <td align="center">
          <?php if (RETURN_STORE_NAME_ADDRESS_SUCCESS == 'true') { ?>
          <address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
        <?php } else if (RETURN_STORE_NAME_ADDRESS_SUCCESS == 'false') { ?>
          <address><?php echo nl2br(RETURN_STORE_NAME_ADDRESS_DIFF); ?></address>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td align="center"><div id="returnRMA"><?php echo TEXT_SUCCESS_RMA_ID . $rmaNumber->fields['rma_number']; ?></div></td>
    </tr>
    <tr>
      <td align="center"><div class="buttonRow"><a href="javascript:window.print()">Print</a></div></td>
    </tr>
  </table>
</body>
