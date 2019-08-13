<?php
/**
 * Flexible Returns Authorization (RMA) Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_returns_default.php 2.3.3 4/13/2010 Clyde Jones $
 */
?>

<div class="centerColumn" id="returnAuthorization">
<h1 id="returnAuthorizationHeading"><?php echo HEADING_TITLE; ?></h1>
<?php echo zen_draw_form('returns', zen_href_link(FILENAME_RETURNS, 'action=send', 'SSL')); ?>



<?php if (RETURN_STORE_NAME_ADDRESS == 'true' && ($_GET['action'] == 'success')) { ?>
<?php
/**
show nothing
 */
} else if (RETURN_STORE_NAME_ADDRESS == 'true') { ?>
<address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
<?php } ?>

<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>
<br class="clearBoth" />

<div class="mainContent success">
<?php 

$order_number = $_GET['order_id']; 

// validate order number 
if(!$_SESSION['customer_id']) {
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}
$customer_info_query = "SELECT customers_id
                        FROM   " . TABLE_ORDERS . "
                        WHERE  orders_id = :ordersID";

$customer_info_query = $db->bindVars($customer_info_query, ':ordersID', $_GET['order_id'], 'integer');
$customer_info = $db->Execute($customer_info_query);

// Now let's ensure this order was posted by this customer
if ($customer_info->fields['customers_id'] != $_SESSION['customer_id']) {
    zen_redirect(zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
}
?>
	<?php echo '<div id="returnSuccess">' . TEXT_SUCCESS . TEXT_SUCCESS_RMA_REFERENCE . '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_RETURNS, 'action=success' . '&order_id=' . $order_number) . '\')">' . TEXT_SUCCESS_POPUP . '</a>' . TEXT_SUCCESS_RMA_REFERENCE1 . '</div>';
         echo '<br /><br />';
         echo '<div id="returnAddressWrapper">' . TEXT_SUCCESS_RMA_ID . '<span id="returnRMA">' . $order_number . $rma_number . '</span>' . '<div id="returnAddress">' . TEXT_SUCCESS_RMA_RETURN_ADDRESS . '</div>'; 
         echo '<br /><br />';
         if (RETURN_STORE_NAME_ADDRESS_SUCCESS == 'true') { 
            echo '<address>' . nl2br(STORE_NAME_ADDRESS) . '</address>'; 
         } else if (RETURN_STORE_NAME_ADDRESS_SUCCESS == 'false') { 
            echo '<address>' . nl2br(RETURN_STORE_NAME_ADDRESS_DIFF) . '</address>'; } 
         echo TEXT_SUCCESS_RMA_THANKS . '</div>'; 
        ?>

<?php
$orderID = $_GET['order_id'];
$autoRMA = ORDER_STATUS_RMA;
$reason = $_SESSION['comments'];
$action = $_SESSION['action'];
if (ORDER_STATUS_RMA_OPTION == 'true') {
$db->Execute("update " . TABLE_ORDERS . " set orders_status = $autoRMA, last_modified = now() where orders_id = '" . (int)$orderID . "'");
}

if (ORDER_COMMENTS_RMA_OPTION == 'true') {
$returnRMA = $orderID . $rma_number;
$db->Execute("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (comments, orders_status_id, orders_id, date_added, rma_number, action) values ('" . $reason ."', '" . $autoRMA ."', '" . (int)$orderID ."', now(), '" . $returnRMA ."', '" . $action ."')");
}
?>
<?php
  } else {
?> 

<?php if (DEFINE_RETURNS_STATUS >= '1' and DEFINE_RETURNS_STATUS <= '2') { ?>
<div id="returnAuthorizationMainContent">
<?php  
/**
 * require html_define for the Returns page
 */
require($define_page);
?>
</div>
<?php } ?>


<?php if ($messageStack->size('returns') > 0) echo $messageStack->output('returns'); ?>
<div class="alert" id="back"><?php echo RETURN_REQUIRED_IMAGE . RETURN_REQUIRED_INFORMATION . RETURN_OPTIONAL_IMAGE . RETURN_OPTIONAL_INFORMATION; ?></div>
<br class="clearBoth" />

<fieldset>
<legend class="personal"><?php echo CONTACT_INFORMATION; ?></legend>
<ol>

<?php
switch (RETURN_NAME) {
    case 0:
        echo '<li><label class="inputLabel"  for="contactname">' . ENTRY_NAME . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('name', '', 'size="40" id="name"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="contactname">' . (($error == true && $entry_name_error == true) ? ENTRY_NAME . RETURN_WARNING_IMAGE : ENTRY_NAME . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_name_error == true) ? zen_draw_input_field('contactname', $name, 'size="40" id="contactname"') . ENTRY_NAME_ERROR : zen_draw_input_field('contactname', $name, 'size="40" id="contactname"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
switch (RETURN_EMAIL) {
    case 0:
        echo '<li><label class="inputLabel"  for="emailaddress">' . ENTRY_EMAIL . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('email', '', 'size="40" id="email"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="emailaddress">' . (($error == true && $entry_email_error == true)? ENTRY_EMAIL . RETURN_WARNING_IMAGE : ENTRY_EMAIL . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_email_error == true)? zen_draw_input_field('email', ($error ? $_POST['email'] : $email), ' size="40" id="emailaddress"') . ENTRY_EMAIL_ERROR : zen_draw_input_field('email', ($error ? $_POST['email'] : $email), ' size="40" id="emailaddress"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
switch (RETURN_PHONE) {
    case 0:
        echo '<li><label class="inputLabel"  for="telephone">' . ENTRY_TELEPHONE . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('telephone', '', 'size="40" id="telephone"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="telephone">' . (($error == true && $entry_telephone_error == true) ? ENTRY_TELEPHONE . RETURN_WARNING_IMAGE : ENTRY_TELEPHONE . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_telephone_error == true) ? zen_draw_input_field('telephone', $telephone, 'size="40" id="telephone"') . ENTRY_TELEPHONE_ERROR : zen_draw_input_field('telephone', $telephone, 'size="40" id="telephone"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
switch (RETURN_STREET) {
    case 0:
        echo '<li><label class="inputLabel"  for="address">' . ENTRY_ADDRESS . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('address', '', 'size="40" id="address"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="address">' . (($error == true && $entry_street_address_error == true) ? ENTRY_ADDRESS . RETURN_WARNING_IMAGE : ENTRY_ADDRESS . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_street_address_error == true) ? zen_draw_input_field('address', $address, 'size="40" id="address"') . ENTRY_ADDRESS_ERROR : zen_draw_input_field('address', $address, 'size="40" id="address"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
switch (RETURN_CITY) {
    case 0:
        echo '<li><label class="inputLabel"  for="city">' . RETURNS_ENTRY_CITY . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('city', '', 'size="40" id="city"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="city">' . (($error == true && $entry_city_error == true) ? RETURNS_ENTRY_CITY . RETURN_WARNING_IMAGE : RETURNS_ENTRY_CITY . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_city_error == true) ? zen_draw_input_field('city', $city, 'size="40" id="city"') . ENTRY_CITY_TEXT_ERROR : zen_draw_input_field('city', $city, 'size="40" id="city"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
switch (RETURN_STATE) {
    case 0:
        echo '<li><label class="inputLabel"  for="state">' . RETURNS_ENTRY_STATE . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('state', '', 'size="40" id="state"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="state">' . (($error == true && $entry_state_error == true) ? RETURNS_ENTRY_STATE . RETURN_WARNING_IMAGE : RETURNS_ENTRY_STATE . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_state_error == true) ? zen_draw_input_field('state', $state, 'size="40" id="state"') . ENTRY_STATE_TEXT_ERROR : zen_draw_input_field('state', $state, 'size="40" id="state"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
switch (RETURN_POSTCODE) {
    case 0:
        echo '<li><label class="inputLabel"  for="postcode">' . ENTRY_POSTCODE . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('postcode', '', 'size="40" id="postcode"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="postcode">' . (($error == true && $entry_postcode_error == true) ? ENTRY_POSTCODE . RETURN_WARNING_IMAGE : ENTRY_POSTCODE . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_postcode_error == true) ? zen_draw_input_field('postcode', $postcode, 'size="40" id="postcode"') . ENTRY_POSTCODE_ERROR : zen_draw_input_field('postcode', $postcode, 'size="40" id="postcode"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
switch (RETURN_COUNTRY) {
    case 0:
        echo '<li><label class="inputLabel"  for="country">' . RETURNS_ENTRY_COUNTRY . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('country', '', 'size="40" id="country"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="country">' . (($error == true && $entry_country_error == true) ? RETURNS_ENTRY_COUNTRY . RETURN_WARNING_IMAGE : RETURNS_ENTRY_COUNTRY . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_country_error == true) ? zen_draw_input_field('country', $country, 'size="40" id="country"') . ENTRY_COUNTRY_TEXT_ERROR : zen_draw_input_field('country', $country, 'size="40" id="order_number"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

</ol>
</fieldset>

<fieldset>
<legend class="order"><?php echo ORDER_INFORMATION; ?></legend>
<ol>

<?php
switch (RETURN_ORDER_NUMBER) {
    case 0:
        echo '<li><label class="inputLabel"  for="order_number">' . ENTRY_ORDER_NUMBER . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('order_number', '', 'size="40" id="order_number"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="order_number">' . (($error == true && $entry_order_number_error == true) ? ENTRY_ORDER_NUMBER . RETURN_WARNING_IMAGE : ENTRY_ORDER_NUMBER . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_order_number_error == true) ? zen_draw_input_field('order_number', $order_number, 'size="40" id="order_number"') . ENTRY_ORDER_NUMBER_ERROR : zen_draw_input_field('order_number', $order_number, 'size="40" id="order_number"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php  echo '<input type="hidden" name="rma_number" value="'.$rma_number.'">'; ?> 

<?php
switch (RETURN_ITEM_NAME) {
    case 0:
        echo '<li><label class="inputLabel"  for="item_name">' . ENTRY_ITEM_NAME . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('item_name', '', 'size="40" id="item_name"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="item_name">' . (($error == true && $entry_item_name_error == true) ? ENTRY_ITEM_NAME . RETURN_WARNING_IMAGE : ENTRY_ITEM_NAME . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_item_name_error == true) ? zen_draw_input_field('item_name', $item_name, 'size="40" id="item_name"') . ENTRY_ITEM_NAME_ERROR : zen_draw_input_field('item_name', $item_name, 'size="40" id="item_name"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
switch (RETURN_ITEM_NUMBER) {
    case 0:
        echo '<li><label class="inputLabel"  for="item_number">' . ENTRY_ITEM_NUMBER . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('item_number', '', 'size="40" id="item_number"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="item_number">' . (($error == true && $entry_item_number_error == true) ? ENTRY_ITEM_NUMBER . RETURN_WARNING_IMAGE : ENTRY_ITEM_NUMBER . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_item_number_error == true) ? zen_draw_input_field('item_number', $item_number, 'size="40" id="item_number"') . ENTRY_ITEM_NUMBER_ERROR : zen_draw_input_field('item_number', $item_number, 'size="40" id="item_number"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
switch (RETURN_VALUE) {
    case 0:
        echo '<li><label class="inputLabel"  for="total_value">' . ENTRY_VALUE . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_input_field('total_value', '', 'size="40" id="total_value"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="total_value">' . (($error == true && $entry_value_error == true) ? ENTRY_VALUE . RETURN_WARNING_IMAGE : ENTRY_VALUE . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_value_error == true) ? zen_draw_input_field('order_number', $order_number, 'size="40" id="order-number"') . ENTRY_VALUE_ERROR : zen_draw_input_field('order_number', $order_number, 'size="40" id="order-number"')) . '</li>';
        break;
    case 2:
        echo '';
        break;
}
?>

<?php
if (RETURN_ACTION_LIST_OPTIONS != ''){
foreach(explode(",", RETURN_ACTION_LIST_OPTIONS) as $k => $v) {
$entry_action_array[] = array('id' => $v, 'text' => preg_replace('/\<[^*]*/', '', $v));
}
?>

<?php
switch (RETURN_ACTION_LIST) {
    case 0:
        echo '<li><h4><?php echo ENTRY_ACTION_INFO; ?></h4><label class="inputLabel">' . ENTRY_ACTION . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_pull_down_menu('action', $entry_action_array) . '</li>';
        break;
    case 1:
        echo '<li><h4><?php echo ENTRY_ACTION_INFO; ?></h4><label class="inputLabel">' . ENTRY_ACTION . RETURN_REQUIRED_IMAGE . '</label>' . zen_draw_pull_down_menu('action', $entry_action_array) . '</li>';
        break;
}
?>
<?php
  }
?>

</ol>
</fieldset>


<fieldset>
<legend class="write"><?php echo ENTRY_REASON; ?></legend>
<ol>
<?php
switch (RETURN_REASON) {
    case 0:
        echo '<li><label class="inputLabel"  for="reason">' . ENTRY_REASON_TEXT . RETURN_OPTIONAL_IMAGE . '</label>' . zen_draw_textarea_field('reason', '30', '7', $reason, 'id="reason"') . '</li>';
        break;
    case 1:
        echo '<li><label class="inputLabel"  for="reason">' . (($error == true && $entry_reason_error == true) ? ENTRY_REASON_TEXT . RETURN_WARNING_IMAGE : ENTRY_REASON_TEXT . RETURN_REQUIRED_IMAGE) . '</label>' . (($error == true && $entry_reason_error == true) ? zen_draw_textarea_field('reason', '30', '7', $reason, 'id="reason"') . ENTRY_REASON_TEXT_ERROR : zen_draw_textarea_field('reason', '30', '7', $reason, 'id="reason"')) . '</li>';
        break;
}
?>
</ol>
</fieldset>

<br class="clearBoth" />

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<?php
  }
?>
</form>
</div>
