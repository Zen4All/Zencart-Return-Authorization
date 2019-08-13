<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: J_Schilz for Integrated COWOA - 14 April 2007
 */

// this is used to display the text link in the "information" or other sidebox
define('BOX_INFORMATION_ORDER_STATUS', 'Order Status');
define('TEXT_ACCOUNT_INFO_RETURNS_BUTTON_HEADER', 'Submit a Returns Authorization Request');
define('TEXT_ACCOUNT_INFO_RETURNS_TEXT_LINK_HEADER', 'Returns');
define('TEXT_DEFINE_BUTTON_LINK2', 'Click here');
define('TEXT_DEFINE_BUTTON_LINK3', ' to create an RMA.');
define('TEXT_RETURN_GRACE_PERIOD_EXPIRED', 'The item(s) on this order extend past our <strong>' . RETURN_GRACE_PERIOD . ' Day</strong>' . '<a href="' . zen_href_link(FILENAME_SHIPPING, '', 'SSL') . '">' . ' Return Policy' . '</a>' . '. Please ' . '<a href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '">' . 'contact us' . '</a>' . ' for any further inquiries.');
define('TEXT_RETURN_INFO_FROM_RETURNS_REQUEST_PAGE', '<h2>Return Authorization Request</h2>To submit a Return Authorization Request please select the order for which the items you want to return are on.');
