<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_edit.<br />
 * Displays information related to a single specific order
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: J_Schilz for Integrated COWOA - 14 April 2007
 */
?>
<div class="centerColumn" id="accountHistInfo">

<h1 id="orderHistoryHeading"><?php echo HEADING_TITLE; ?></h1><br />

<?php if($order || $_SESSION['customer_id']) { ?>
<?php echo ''; ?>
<?php } else { ?>
<?php echo TEXT_RETURN_REQUEST_INTRO; ?>
<?php } ?>


<?php if($order || $_SESSION['customer_id']) { ?>
<?php echo ''; ?>
<?php } else { ?>
<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', 'id="loginForm"'); ?>
<fieldset>
<legend><?php echo HEADING_RETURNING_CUSTOMER; ?></legend>

<label class="inputLabel" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address"'); ?>
<br class="clearBoth" />

<label class="inputLabel" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password') . ' id="login-password"'); ?>
<br class="clearBoth" />
<?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
</fieldset>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT); ?></div>
<div class="buttonRow back important"><?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></div>
</form>
<br class="clearBoth" />
<?php } ?>

<?php if($order) { ?>

  <table border="0" width="100%" cellspacing="0" cellpadding="0" summary="Itemized listing of previous order, includes number ordered, items and prices">
  <h2 id="orderHistoryDetailedOrder"><?php echo SUB_HEADING_TITLE . ORDER_HEADING_DIVIDER . sprintf(HEADING_ORDER_NUMBER, $_POST['order_id']); ?></h2>
  <div class="forward"><?php echo HEADING_ORDER_DATE . ' ' . zen_date_long($order->info['date_purchased']); ?></div>
  <br class="clearBoth" />
      <tr class="tableHeading">
          <th scope="col" id="myAccountQuantity"><?php echo HEADING_QUANTITY; ?></th>
          <th scope="col" id="myAccountProducts"><?php echo HEADING_PRODUCTS; ?></th>
  <?php
    if (sizeof($order->info['tax_groups']) > 1) {
  ?>
          <th scope="col" id="myAccountTax"><?php echo HEADING_TAX; ?></th>
  <?php
   }
  ?>
          <th scope="col" id="myAccountTotal"><?php echo HEADING_TOTAL; ?></th>
      </tr>
  <?php
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    ?>
      <tr>
          <td class="accountQuantityDisplay"><?php echo  $order->products[$i]['qty'] . QUANTITY_SUFFIX; ?></td>
          <td class="accountProductDisplay"><?php echo  $order->products[$i]['name'];

      if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
        echo '<ul id="orderAttribsList">';
        for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
          echo '<li>' . $order->products[$i]['attributes'][$j]['option'] . TEXT_OPTION_DIVIDER . nl2br($order->products[$i]['attributes'][$j]['value']) . '</li>';
        }
          echo '</ul>';
      }
  ?>
          </td>
  <?php
      if (sizeof($order->info['tax_groups']) > 1) {
  ?>
          <td class="accountTaxDisplay"><?php echo zen_display_tax_value($order->products[$i]['tax']) . '%' ?></td>
  <?php
      }
  ?>
          <td class="accountTotalDisplay"><?php echo $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') ?></td>
      </tr>
  <?php
    }
  ?>
  </table>
  <hr />
  <div id="orderTotals">
  <?php
    for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
  ?>
       <div class="amount larger forward"><?php echo $order->totals[$i]['text'] ?></div>
       <div class="lineTitle larger forward"><?php echo $order->totals[$i]['title'] ?></div>
  <br class="clearBoth" />
  <?php
    }
  ?>

  </div>

  <?php
  /**
   * Used to display any downloads associated with the cutomers account
   */
    if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
  ?>


  <?php
  /**
   * Used to loop thru and display order status information
   */
  if (sizeof($statusArray)) {
  ?>

  <table border="0" width="100%" cellspacing="0" cellpadding="0" id="myAccountOrdersStatus" summary="Table contains the date, order status and any comments regarding the order">
  <caption><h2 id="orderHistoryStatus"><?php echo HEADING_ORDER_HISTORY; ?></h2></caption>
      <tr class="tableHeading">
          <th scope="col" id="myAccountStatusDate"><?php echo TABLE_HEADING_STATUS_DATE; ?></th>
          <th scope="col" id="myAccountStatus"><?php echo TABLE_HEADING_STATUS_ORDER_STATUS; ?></th>
          <th scope="col" id="myAccountStatusComments"><?php echo TABLE_HEADING_STATUS_COMMENTS; ?></th>
         </tr>
  <?php
    foreach ($statusArray as $statuses) {
  ?>
      <tr>
          <td><?php echo zen_date_short($statuses['date_added']); ?></td>
          <td><?php echo $statuses['orders_status_name']; ?></td>
          <td><?php echo (empty($statuses['comments']) ? '&nbsp;' : nl2br(zen_output_string_protected($statuses['comments']))); ?></td> 
      </tr>
  <?php
    }
  ?>
  </table>
  <?php } ?>

  <hr />
  <div id="myAccountShipInfo" class="floatingBox back">


  <?php
      if (zen_not_null($order->info['shipping_method'])) {
  ?>
  <h4><?php echo HEADING_SHIPPING_METHOD; ?></h4>
  <div><?php echo $order->info['shipping_method']; ?></div>
  <?php } else { // temporary just remove these 4 lines ?>
  <div>WARNING: Missing Shipping Information</div>
  <?php
      }
  ?>
  </div>

  <div id="myAccountPaymentInfo" class="floatingBox forward">
  <h4><?php echo HEADING_PAYMENT_METHOD; ?></h4>
  <div><?php echo $order->info['payment_method']; ?></div>
  </div>
  <br class="clearBoth" />
  <br />
<?php } ?>


<?php if($order || $_SESSION['customer_id']) { ?>
<?php
$orderID = $_POST['order_id'];
$compareDate = ORDER_STATUS_COMPARE;
$getDate = ("select date_added from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . $orderID . "' and orders_status_id = '" . $compareDate . "'");
$comparing = $db->Execute($getDate);

$currentDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-RETURN_GRACE_PERIOD, date("Y") ));

if ($comparing->fields['date_added'] <= $currentDate && zen_not_null($comparing->fields['date_added'])) {
?>


<?php
echo '<div id="returnSuccess">' . TEXT_RETURN_GRACE_PERIOD_EXPIRED . '</div>';

} else {
?>


<!--  BOF Flexible Returns Authorization (RMA) -->
<?php if (DEFINE_BUTTON_LINK == '0') { ?> <div class="rmaRequestButton"><h4><?php echo TEXT_ACCOUNT_INFO_RETURNS_BUTTON_HEADER; ?></h4><?php echo '<a href="' .
zen_href_link(FILENAME_RETURNS, (isset($_GET['page']) ? 'page=' .
$_GET['page'] . '&' : '') . 'order_id=' . $_POST['order_id'], 'SSL') . '">'
. zen_image_button(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT) . '</a>'; ?></div> <?php } else { ?> <div class="rmaRequestButton"><h4><?php echo TEXT_ACCOUNT_INFO_RETURNS_TEXT_LINK_HEADER; ?></h4><?php echo TEXT_DEFINE_BUTTON_LINK; ?>&nbsp;&nbsp;<?php echo '<a href="' . zen_href_link(FILENAME_RETURNS,
(isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'order_id=' .
$_POST['order_id'], 'SSL') . '">' . TEXT_DEFINE_BUTTON_LINK2 . '</a>'; ?><?php echo TEXT_DEFINE_BUTTON_LINK3; ?></div> <?php } ?>
<br class="clearBoth" />
<!--  EOF Flexible Returns Authorization (RMA) -->
<?php } ?>
<?php } ?>



<?php 
echo zen_draw_form('rma_request', zen_href_link(FILENAME_RETURNS_REQUEST, '', 'SSL'), 'post') . zen_draw_hidden_field('action', 'process');
?>
<fieldset>

<legend><?php echo HEADING_TITLE_1; ?></legend>
<?php
if(isset($_POST['action']) && $_POST['action'] == "process") {
  if($errorInvalidID) echo ERROR_INVALID_ORDER;
  if($errorInvalidEmail) echo ERROR_INVALID_EMAIL;
  if($errorNoMatch) echo ERROR_NO_MATCH; 
}?>

<?php echo TEXT_LOOKUP_INSTRUCTIONS; ?><br /><br />
<label class="inputLabel"><?php echo ENTRY_EMAIL; ?></label>
<?php echo zen_draw_input_field('query_email_address', '' , 'size="35" id="query_email_address"'); ?> 
<br class="clearBoth" />
<label class="inputLabel"><?php echo ENTRY_ORDER_NUMBER; ?></label>
<?php echo zen_draw_input_field('order_id', '', 'size="20" id="order_id"'); ?> 

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT); ?></div>
</fieldset>
</form>
</div>
