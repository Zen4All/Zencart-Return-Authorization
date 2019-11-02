<?php

/**
 * Flexible Returns Authorization (RMA) Page
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: returns_defines.php 2.3.3 4/13/2010 Clyde Jones $
 */
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

//require('includes/application_top.php');
if (REGISTERED_RETURN == 'true' && $_GET['action'] == 'returns_request') {
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
}

$error = false;
if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
  $name = zen_db_prepare_input($_POST['contactname']);
  $email_address = zen_db_prepare_input($_POST['email']);
  $telephone = zen_db_prepare_input($_POST['telephone']);
  $address = zen_db_prepare_input($_POST['address']);
  $city = zen_db_prepare_input($_POST['city']);
  $state = zen_db_prepare_input($_POST['state']);
  $country = zen_db_prepare_input($_POST['country']);
  $postcode = zen_db_prepare_input($_POST['postcode']);
  $order_number = zen_db_prepare_input($_POST['order_number']);
  $rma_number = zen_db_prepare_input($_POST['rma_number']);
  $value = zen_db_prepare_input($_POST['total_value']);
  $item_number = zen_db_prepare_input($_POST['item_number']);
  $item_name = zen_db_prepare_input($_POST['item_name']);
  $action = zen_db_prepare_input($_POST['action']);
  $reason = zen_db_prepare_input(strip_tags($_POST['reason']));
  $_SESSION['comments'] = zen_db_prepare_input($_POST['reason']);
  $_SESSION['action'] = zen_db_prepare_input($_POST['action']);

  $zc_validate_email = zen_validate_email($email_address);

  if (RETURN_NAME != '1' || !empty($name) && RETURN_EMAIL != '1' || !empty($email_address) && RETURN_PHONE != '1' || !empty($telephone) && RETURN_STREET != '1' || !empty($address) && RETURN_CITY != '1' || !empty($city) && RETURN_STATE != '1' || !empty($state) && RETURN_POSTCODE != '1' || !empty($postcode) && RETURN_COUNTRY != '1' || !empty($country) && RETURN_ORDER_NUMBER != '1' || !empty($order_number) && RETURN_ITEM_NAME != '1' || !empty($item_name) && RETURN_ITEM_NUMBER != '1' || !empty($item_number) and RETURN_VALUE != '1' || !empty($value) && RETURN_ACTION_LIST != '1' || !empty($action) && RETURN_REASON != '1' || !empty($reason)) {

    $send_to_email = EMAIL_FROM;
    $send_to_name = STORE_NAME;

    // Prepare extra-info details
    $extra_info = email_collect_extra_info($name, $email_address, $customer_name, $customer_email, $telephone);
    // Prepare Text-only portion of message
    $text_message = OFFICE_FROM . ". . . . . . . . . ." . $name . "\n" .
        OFFICE_EMAIL . ". . . . . . . . . ." . $email_address . "\n" .
        "Phone Number:" . ". . ." . $telephone . "\n" .
        "Address:" . ". . . . . . . ." . $address . "\n" .
        "City:" . ". . . . . . . . . . ." . $city . "\n" .
        "Post Code:" . ". . . . . ." . $postcode . "\n" .
        "Country:" . ". . . . . . . ." . $country . "\n" .
        "State:" . ". . . . . . . . . ." . $state . "\n" .
        "Order Number:" . ". . . ." . $order_number . "\n" .
        "RMA Number:" . ". . . ." . $order_number . $rma_number . "\n" .
        "Total Value:" . ". . . . . ." . $value . "\n" .
        "Item Number:" . ". . . . ." . $item_number . "\n" .
        "Item Name:" . ". . . . . ." . $item_name . "\n" .
        "Action Requested:" . "." . $action . "\n" . "\n" .
        '------------------------------------------------------' . "\n" .
        "Reason:" . "\n" .
        $reason . "\n" .
        '------------------------------------------------------' . "\n" .
        $extra_info['TEXT'];
    $email_text = sprintf(EMAIL_GREET_NONE, $name);
    $email_text .= EMAIL_WELCOME;
    $email_text .= EMAIL_TEXT;
    $email_text .= EMAIL_CONTACT;
    $email_text .= EMAIL_SHIPPING_URL_BOF . zen_href_link(FILENAME_SHIPPING) . EMAIL_SHIPPING_URL_EOF;
    $email_text .= "\n\n" . EMAIL_WARNING . "\n" . EMAIL_CONTACT_URL_BOF . zen_href_link(FILENAME_SHIPPING) . EMAIL_CONTACT_URL_EOF . "\n\n";

    // Prepare HTML-portion of message
    $html_msg['EMAIL_GREETING'] = str_replace('\n', '', $email_text);
    $html_msg['EMAIL_WELCOME'] = str_replace('\n', '', EMAIL_WELCOME);
    $html_msg['EMAIL_MESSAGE_HTML'] = $email_text;
    $html_msg['CONTACT_US_OFFICE_FROM'] = OFFICE_FROM . ' ' . $name . '<br>' . OFFICE_EMAIL . '(' . $email_address . ')';
    $html_msg['EXTRA_INFO'] = $extra_info['HTML'];

    // Send message
    $email_subject = EMAIL_SUBJECT . ' RMA# ' . $order_number . $rma_number;

    zen_mail($name, $email_address, $email_subject, $email_text, $send_to_name, $send_to_email, $html_msg, 'returns');
    $html_msg['EMAIL_MESSAGE_HTML'] = $text_message;
    $html_msg['EMAIL_GREETING'] = '';
    $html_msg['EMAIL_WELCOME'] = '';
    $html_msg['CONTACT_US_OFFICE_FROM'] = OFFICE_FROM . ' ' . $name . '<br>' . OFFICE_EMAIL . '(' . $email_address . ')';
    $html_msg['EXTRA_INFO'] = '';

    zen_mail(STORE_OWNER, EMAIL_FROM, EMAIL_SUBJECT, $text_message, $name, $email_address, $html_msg, 'contact_us');

    zen_redirect(zen_href_link(FILENAME_RETURNS, 'action=success' . '&order_id=' . $order_number));
  } else {
    $error = true;
    if (RETURN_ERROR_DISPLAY_OPTION == 'true') {
      if ($zc_validate_email == false) {
        $entry_email_error = true;
      }
    }
    if ($error == true) {
      $messageStack->add('returns', ENTRY_ERROR_OCCURED);
    }
  }
} // end action==send	
// default email and name if customer is logged in
if (zen_is_logged_in()) {
  $sql = "SELECT c.customers_id, c.customers_firstname, c.customers_lastname, c.customers_email_address, c.customers_default_address_id, c.customers_telephone,
                 ab.customers_id, ab.entry_street_address, ab.entry_city, ab.entry_postcode, ab.entry_state, ab.entry_zone_id, ab.entry_country_id,
                 z.zone_id, z.zone_code,
                 cn.countries_id, cn.countries_name
          FROM " . TABLE_CUSTOMERS . " c,
               " . TABLE_ADDRESS_BOOK . " ab,
               " . TABLE_ZONES . " z,
               " . TABLE_COUNTRIES . " cn
          WHERE c.customers_id = " . (int)$_SESSION['customer_id'] . "
          AND ab.customers_id = c.customers_id
          AND ab.entry_country_id = cn.countries_id";

  $check_customer = $db->Execute($sql);
  $name = $check_customer->fields['customers_firstname'] . ' ' . $check_customer->fields['customers_lastname'];
  $email = $check_customer->fields['customers_email_address'];
  $telephone = $check_customer->fields['customers_telephone'];
  $address = $check_customer->fields['entry_street_address'];
  $city = $check_customer->fields['entry_city'];
  $cID = $check_customer->fields['customers_id'];

  if (isset($check_customer->fields['zone_id']) && zen_not_null($check_customer->fields['zone_id'])) {
    $state = zen_get_zone_code($check_customer->fields['entry_country_id'], $check_customer->fields['entry_zone_id'], $check_customer->fields['entry_state']);
  }

//  $state = $check_customer->fields['entry_state'];
  $country = $check_customer->fields['countries_name'];
  $postcode = $check_customer->fields['entry_postcode'];
} else {
  // Should never happen because login checked at top
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

$customer_info_query = "SELECT customers_id
                        FROM   " . TABLE_ORDERS . "
                        WHERE  orders_id = " . (int)$_GET['order_id'];

$customer_info = $db->Execute($customer_info_query);

// Now let's ensure this order was posted by this customer
if ($customer_info->fields['customers_id'] != $_SESSION['customer_id']) {
  zen_redirect(zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
}

$order_number = $_GET['order_id'];
$rma_request_date = date('mdY');
if (zen_is_logged_in()) {
  $rma_number = $cID . $rma_request_date;
} else {
  $rma_number = $rma_request_date;
}

// include template specific file name defines
$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_RETURNS, 'false');

$breadcrumb->add(NAVBAR_TITLE);
//EOF
