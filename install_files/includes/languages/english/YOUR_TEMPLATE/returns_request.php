<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: J_Schilz for Integrated COWOA - 14 April 2007
 */
//

define('NAVBAR_TITLE', 'Order Status');
define('NAVBAR_TITLE_1', 'My Account');

define('HEADING_TITLE', 'Return Authorization Request');

if($order) {
define('HEADING_TITLE_1', 'Lookup Another Order');
} else {
define('HEADING_TITLE_1', 'Lookup Order Information');
}

define('SUB_HEADING_TITLE', 'Order Information');

define('HEADING_ORDER_NUMBER', 'Order #%s');
define('HEADING_ORDER_DATE', 'Order Date:');
define('HEADING_ORDER_TOTAL', 'Order Total:');

define('HEADING_PRODUCTS', 'Products');
define('HEADING_TAX', 'Tax');
define('HEADING_TOTAL', 'Total');
define('HEADING_QUANTITY', 'Qty.');

define('HEADING_SHIPPING_METHOD', 'Shipping Method');
define('HEADING_PAYMENT_METHOD', 'Payment Method');

define('HEADING_ORDER_HISTORY', 'Status History &amp; Comments');
define('TEXT_NO_COMMENTS_AVAILABLE', 'No comments available.');
define('TABLE_HEADING_STATUS_DATE', 'Date');
define('TABLE_HEADING_STATUS_ORDER_STATUS', 'Order Status');
define('TABLE_HEADING_STATUS_COMMENTS', 'Comments');
define('QUANTITY_SUFFIX', '&nbsp;ea.  ');
define('ORDER_HEADING_DIVIDER', '&nbsp;-&nbsp;');
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');

define('ENTRY_EMAIL', 'E-Mail Address:');
define('ENTRY_ORDER_NUMBER', 'Order Number:');

define('ERROR_INVALID_EMAIL', '<strong>You have entered an invalid e-mail address.</strong><br /><br />');
define('ERROR_INVALID_ORDER', '<strong>You have entered an invalid order number.</strong><br /><br />');
define('ERROR_NO_MATCH', '<strong>No match found for your entry.</strong><br /><br />');

define('TEXT_LOOKUP_INSTRUCTIONS', 'To lookup the status of an order, please enter the order number and the e-mail address with which it was placed.');


define('HEADING_RETURNING_CUSTOMER', 'Returning Customers: Please Log In');
define('TEXT_PASSWORD_FORGOTTEN', 'Forgot your password?');

//Flexible Returns Authorization (RMA) Additions
define('TEXT_ACCOUNT_INFO_RETURNS_BUTTON_HEADER', 'Submit a Returns Authorization Request');
define('TEXT_ACCOUNT_INFO_RETURNS_TEXT_LINK_HEADER', 'Returns');
define('TEXT_DEFINE_BUTTON_LINK2', 'Click here');
define('TEXT_DEFINE_BUTTON_LINK3', ' to create an RMA.');

define('TEXT_RETURN_REQUEST_INTRO', 'To submit a Return Authorization Request, please login to your account or lookup the order for which you have items to return.');

define('TEXT_RETURN_GRACE_PERIOD_EXPIRED', 'The item(s) on this order extend past our <strong>' . RETURN_GRACE_PERIOD . ' Day</strong>' . '<a href="' . zen_href_link(FILENAME_SHIPPING, '', 'SSL') . '">' . ' Return Policy' . '</a>' . '. Please ' . '<a href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '">' . 'contact us' . '</a>' . ' for any further inquiries.');
// eof
