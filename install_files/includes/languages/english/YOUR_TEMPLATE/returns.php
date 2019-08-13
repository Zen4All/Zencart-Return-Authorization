<?php
/**
 * Flexible Returns Authorization (RMA) Defines
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: returns.php 2.3.3 4/13/2010 Clyde Jones $
 */

define('HEADING_TITLE', 'Return Authorization Request');
define('NAVBAR_TITLE', 'Return Authorization Request');
define('TEXT_SUCCESS_RMA_REQUIRED', 'The below RMA# is required for all Returns');
define('TEXT_SUCCESS_RMA_POLICY_BOF', 'You can view our ');
define('TEXT_SUCCESS_RMA_POLICY_LINK', 'Returns Policy');
define('TEXT_SUCCESS_RMA_POLICY_EOF', ' here.');
define('TEXT_SUCCESS_RMA_ID', 'Your RMA# is: ');
define('TEXT_SUCCESS_DASH', '-');
define('TEXT_SUCCESS_RMA_RETURN_ADDRESS', 'Please ship all returns to this address:');
define('TEXT_SUCCESS_RMA_RETURN_PHONE', '');

define('TEXT_SUCCESS', 'Your request was successfully submitted and a RMA# has been issued, a confirmation email has been sent to your email address.<br /><br />For additional information, you may view our <a href="' . zen_href_link(FILENAME_SHIPPING, '', 'SSL') . '">Return Policy</a> or <a href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '">Contact Us</a> with any questions, comments or concerns that you may have.<br /><br />');

define('TEXT_SUCCESS_RMA_REFERENCE', 'Your RMA# for this request is below, this RMA# is valid for ' . RMA_GRACE_PERIOD . ' days. Please make sure that the RMA# is visible on the package. We have also provided a'); 
define('TEXT_SUCCESS_POPUP', ' Returns Package Label '); 
define('TEXT_SUCCESS_RMA_REFERENCE1', 'that you can print out and use.');

define('TEXT_SUCCESS_RMA_THANKS', 'Thank you for your request.<br /><br />');

define('EMAIL_SUBJECT', 'Return Authorization Request');
define('EMAIL_GREET_NONE', 'Dear %s' . "\n\n");
define('EMAIL_WELCOME', 'Thank you for contacting ' . STORE_NAME . '.' . "\n\n");

define('EMAIL_TEXT', 'Your request for a Return Authorization Number was received and a RMA# was issued. Please Remember that this RMA# is only valid for ' . RMA_GRACE_PERIOD . ' days. Please make sure that the RMA# is visible on the package or use the Returns Package Label that was provided upon submission of the Return Authorization Request.' . "\n\n");

define('EMAIL_CONTACT', 'For additional information, you may view our Return Policy.' . "\n");
define('EMAIL_SHIPPING_URL_BOF', '');
define('EMAIL_SHIPPING_URL_EOF', '');

define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us during a Return Authorization Request submission. For questions, comments or concerns that you may have, please feel free to Contact Us.');
define('EMAIL_CONTACT_URL_BOF', '');
define('EMAIL_CONTACT_URL_EOF', '');

define('STORE_TEXT', 'The following request has been received:<br />');
define('SEND_TO_TEXT','Send Email To:');

define('ENTRY_NAME', 'Full Name: ');
define('ENTRY_EMAIL', 'Email Address: ');
define('ENTRY_TELEPHONE', 'Phone Number: ');
define('ENTRY_ADDRESS', 'Address: ');
define('RETURNS_ENTRY_CITY', 'City: ');
define('RETURNS_ENTRY_STATE', 'State: ');
define('ENTRY_POSTCODE', 'Post Code: ');
define('RETURNS_ENTRY_COUNTRY', 'Country: ');
define('ENTRY_ORDER_NUMBER', 'Order Number: ');
define('ENTRY_VALUE', 'Total Value: ');
define('ENTRY_ITEM_NUMBER', 'Item Number: ');
define('ENTRY_ITEM_NAME', 'Item Name: ');
define('ENTRY_ACTION', 'Action Requested: ');
define('ENTRY_ACTION_INFO', 'Select the type of return you are requesting.');
define('ENTRY_ACTION_REFUND', 'Refund');
define('ENTRY_ACTION_REPLACE', 'Replacement');
define('ENTRY_REASON', 'Reason for Return');
define('ENTRY_REASON_TEXT', 'Reason Text: ');
define('ENTRY_ACTION_DEFAULT', 'Replacement');

define('CONTACT_INFORMATION', 'Contact Information');
define('ORDER_INFORMATION', 'Order Information');

define('RETURN_REQUIRED_INFORMATION', ' = Required Information<br />');
define('RETURN_OPTIONAL_INFORMATION', ' = Optional Information');

define('RETURN_OPTIONAL_IMAGE', zen_image(DIR_WS_TEMPLATE . 'images' . '/optional.png', 'optional information'));
define('RETURN_WARNING_IMAGE', zen_image(DIR_WS_TEMPLATE . 'images' . '/exclamation.gif', 'warning'));
define('RETURN_REQUIRED_IMAGE', zen_image(DIR_WS_TEMPLATE . 'images' . '/star.png', 'required information'));

define('ENTRY_NAME_ERROR', '<div class="alert">You must include your Full Name</div>');
define('ENTRY_EMAIL_ERROR', '<div class="alert">You must include your Email Address</div>');
define('ENTRY_TELEPHONE_ERROR', '<div class="alert">You must include your Telephone Number (000-000-0000)</div>');
define('ENTRY_ADDRESS_ERROR', '<div class="alert">You must include your Address</div>');
define('ENTRY_CITY_TEXT_ERROR', '<div class="alert">You must include your City</div>');
define('ENTRY_STATE_TEXT_ERROR', '<div class="alert">You must include your State</div>');
define('ENTRY_POSTCODE_ERROR', '<div class="alert">You must include your Post Code</div>');
define('ENTRY_COUNTRY_TEXT_ERROR', '<div class="alert">You must include your Country</div>');
define('ENTRY_ORDER_NUMBER_ERROR', '<div class="alert">You must include your Order Number</div>');
define('ENTRY_ITEM_NAME_ERROR', '<div class="alert">You must include the Item Name</div>');
define('ENTRY_ITEM_NUMBER_ERROR', '<div class="alert">You must include the Item Number</div>');
define('ENTRY_VALUE_ERROR', '<div class="alert">You must include the Item\'s Total Value ($1.00)</div>');
define('ENTRY_REASON_TEXT_ERROR','<div class="alert" id="reason">You must include a Reason for your Return</div>');
define('ENTRY_ERROR_OCCURED', 'Errors have occured on your submission! Please correct and re-submit!');
define('ENTRY_NAME_ERROR_STACK', '<span class="alert_stack">You must include your Full Name</span>');
define('ENTRY_EMAIL_ERROR_STACK', '<span class="alert_stack">You must include your Email Address</span>');
define('ENTRY_TELEPHONE_ERROR_STACK', '<span class="alert_stack">You must include your Telephone Number (000-000-0000)</span>');
define('ENTRY_ADDRESS_ERROR_STACK', '<span class="alert_stack">You must include your Address</span>');
define('ENTRY_CITY_TEXT_ERROR_STACK', '<span class="alert_stack">You must include your City</span>');
define('ENTRY_STATE_TEXT_ERROR_STACK', '<span class="alert_stack">You must include your State</span>');
define('ENTRY_POSTCODE_ERROR_STACK', '<span class="alert_stack">You must include your Post Code</span>');
define('ENTRY_COUNTRY_TEXT_ERROR_STACK', '<span class="alert_stack">You must include your Country</span>');
define('ENTRY_ORDER_NUMBER_ERROR_STACK', '<span class="alert_stack">You must include your Order Number</span>');
define('ENTRY_ITEM_NAME_ERROR_STACK', '<span class="alert_stack">You must include the Item Name</span>');
define('ENTRY_ITEM_NUMBER_ERROR_STACK', '<span class="alert_stack">You must include the Item Number</span>');
define('ENTRY_VALUE_ERROR_STACK', '<span class="alert_stack">You must include the Item\'s Total Value ($1.00)</span>');
define('ENTRY_REASON_TEXT_ERROR_STACK','<span class="alert_stack" id="reason">You must include a Reason for your Return</span>');
//EOF