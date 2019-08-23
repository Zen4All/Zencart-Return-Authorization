<?php
/**
 * Flexible Returns Authorization (RMA) Install
 * For Zen-Cart 1.5.6
 * Last Updated: 08/12/2019
 *
 * @copyright Copyright 2009-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_ra_config.php 3.2 08/12/2019 T McCaffery $
 */
 
    $ra_menu_title = 'Return Authorization';
    $ra_menu_text = 'Return Authorization Display Settings';
			
    /* find if Return Authorization Configuration Group Exists */
    $sql = "SELECT * FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_title = '".$ra_menu_title."'";
    $original_config = $db->Execute($sql);
		
    if($original_config->RecordCount())
    {
        // if exists updating the existing Return Authorization configuration group entry
        $sql = "UPDATE ".TABLE_CONFIGURATION_GROUP." SET 
                configuration_group_description = '".$ra_menu_text."' 
                WHERE configuration_group_title = '".ra_menu_title."'";
        $db->Execute($sql);
        $sort = $original_config->fields['sort_order'];

    }else{
        /* Find max sort order in the configuation group table -- add 2 to this value to create the Return Authorization configuration group ID */
        $sql = "SELECT (MAX(sort_order)+2) as sort FROM ".TABLE_CONFIGURATION_GROUP;
        $result = $db->Execute($sql);
        $sort = $result->fields['sort'];

        /* Create Return Authorization configuration group */
        $sql = "INSERT INTO ".TABLE_CONFIGURATION_GROUP." (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (NULL, '".$ra_menu_title."', '".$ra_menu_text."', ".$sort.", '1')";
        $db->Execute($sql);
   }
	 
    /* Find configuation group ID of Return Authorization */
    $sql = "SELECT configuration_group_id FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_title='".$ra_menu_title."' LIMIT 1";
    $result = $db->Execute($sql);
        $ra_configuration_id = $result->fields['configuration_group_id'];

    /* Remove Return Authorization items from the configuration table */
    $sql = "DELETE FROM ".DB_PREFIX."configuration WHERE configuration_group_id ='".$ra_configuration_id."'";
        $db->Execute($sql);

//-- ADD VALUES TO RETURN AUTHORIZATION CONFIGURATION GROUP (Admin > Configuration > Return Authorization) --
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Name field options','RETURN_NAME','1','Display Name field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."',1, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Email field options', 'RETURN_EMAIL', '1', 'Display Email field as as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 2, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Phone Number field options', 'RETURN_PHONE', '0', 'Display Phone Number field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 3, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Street Address field options', 'RETURN_STREET', '1', 'Display Street Address field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 4, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display City field options', 'RETURN_CITY', '1', 'Display City field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 5, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display State field options', 'RETURN_STATE', '1', 'Display State field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 6, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Postal Code field options', 'RETURN_POSTCODE', '1', 'Display Postal Code field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 7, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Country field options', 'RETURN_COUNTRY', '1', 'Display Country field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 8, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Order Number field options', 'RETURN_ORDER_NUMBER', '1', 'Display Order Number field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 9, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Item Name field options', 'RETURN_ITEM_NAME', '2', 'Display Item Name field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 10, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Item Number field options', 'RETURN_ITEM_NUMBER', '2', 'Display Item Number field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 11, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Total Value field options', 'RETURN_VALUE', '2', 'Display Total Value field as:<br />0 = Display as Optional<br />1 = Display as Required<br />2 = Do not Display', '".$ra_configuration_id."', 12, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Action Dropdown List options', 'RETURN_ACTION_LIST', '1', 'Return Action Dropdown List as:<br />0 = Display as Optional<br />1 = Display as Required<br />', '".$ra_configuration_id."', 13, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Display Reason Text Area options', 'RETURN_REASON', '1', 'Is Reason Text Area as:<br />0 = Display as Optional<br />1 = Display as Required', '".$ra_configuration_id."', 14, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Error Message Display options</strong>', 'RETURN_ERROR_DISPLAY_OPTION', 'true', 'true = Inline Display<br />false = Messagestack Display', '".$ra_configuration_id."', 15, NULL, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), ')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Set Return Action Dropdown List', 'RETURN_ACTION_LIST_OPTIONS', 'Get a Refund, Get a Replacement, Exchange for another item, Repair under warranty', 'Format: Action 1,  Action 2', '".$ra_configuration_id."', 16, NULL, NOW(), NULL, 'zen_cfg_textarea(')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Show Store Name, Address and Phone for Returns (ship to) on Returns Page', 'RETURN_STORE_NAME_ADDRESS', 'true', '(Admin>Configuration>My Store>Store Name & Store Address and Phone)', '".$ra_configuration_id."', 17, NULL, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), ')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Show Store Name, Address and Phone for Returns (ship to) on Returns Success Page', 'RETURN_STORE_NAME_ADDRESS_SUCCESS', 'false', '(Admin>Configuration>My Store>Store Name & Store Address and Phone)', '".$ra_configuration_id."', 18, NULL, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), ')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Show Different Returns (ship to) Address on Returns Success Page', 'RETURN_STORE_NAME_ADDRESS_DIFF', 'Your Store<br />123 North Main Street<br />Your Town, Your State #####', 'Include a Store Name & Store Address and Phone<br />Show Store Name, Address and Phone for Returns (ship to) on Returns Success Page (Set to false)', '".$ra_configuration_id."', 19, NULL, NOW(), NULL, 'zen_cfg_textarea(')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Define Page options', 'DEFINE_RETURNS_STATUS', '1', '(Admin>Tools>Define Pages Editor>define_returns.php)<br />Enable the Defined Return Authorization Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '".$ra_configuration_id."', 20, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Order History Info</strong> RMA Button/Link Display options', 'DEFINE_BUTTON_LINK', '1', 'Display Order History (GoTo) as:<br />0 = Display as Button<br />1 = Display as Link', '".$ra_configuration_id."', 21, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Order History Info</strong> RMA Link Display', 'TEXT_DEFINE_BUTTON_LINK', 'If you wish to return any of the above items to us, please do not send any items before obtaining a Return Authorization Number.', 'Include text which preceeds RMA text link', '".$ra_configuration_id."', 22, NULL, NOW(), NULL, 'zen_cfg_textarea(')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Admin</strong> Registered Customers Only?', 'REGISTERED_RETURN', 'false', 'Only Registered Customers may submit a return request', '".$ra_configuration_id."', 23, NULL, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), ')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Admin</strong> Update Order Status option', 'ORDER_STATUS_RMA_OPTION', 'true', 'Update <strong>Admin</strong> Order Status upon RMA Success', '".$ra_configuration_id."', 24, NULL, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), ')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Admin</strong> Order Status', 'ORDER_STATUS_RMA', '2', 'Number of the order status assigned when an RMA is submitted.', '".$ra_configuration_id."', 25, NULL, NOW(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Admin</strong> Order Status for Delivered Items', 'ORDER_STATUS_COMPARE', '3', 'Number of the order status assigned when an order is (Complete - Shipped).', '".$ra_configuration_id."', 26, NULL, NOW(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Admin</strong> Return Grace Period', 'RETURN_GRACE_PERIOD', '30', '<strong>Numeric Number Only</strong> This represents your <strong>30</strong> Day Return Policy or how ever many days you allow a customer to return an item.', '".$ra_configuration_id."', 27, NULL, NOW(), NULL, 'zen_cfg_textarea(')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Admin</strong> Update Order Comments option', 'ORDER_COMMENTS_RMA_OPTION', 'true', 'Update <strong>Admin</strong> Order Comments upon RMA Success',  '".$ra_configuration_id."', 28, NULL, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), ')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Email</strong> RMA Grace Period', 'RMA_GRACE_PERIOD', '15', 'This tells your customer how many days till the RMA# expires.', '".$ra_configuration_id."', 29, NULL, NOW(), NULL, 'zen_cfg_textarea(')";
    $db->Execute($sql);
    $sql = "INSERT INTO ".DB_PREFIX."configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '<strong>Admin Flexible Returns Authorization (RMA) Version</strong>', 'RA_VERSION', '1.6', 'Flexible Returns Authorization (RMA) Version',  '".$ra_configuration_id."', 30, NULL, NOW(), NULL, NULL)";
    $db->Execute($sql);
		
   if(file_exists(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'auto_loaders/config.ra.php'))
    {
        if(!unlink(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'auto_loaders/config.ra.php'))
	{
		$messageStack->add('The auto-loader file '.DIR_FS_ADMIN.'includes/auto_loaders/config.ra.php has not been deleted. For this module to work you must delete the '.DIR_FS_ADMIN.'includes/auto_loaders/config.ra.php file manually. Now, BEFORE you post on the Zen Cart forum to ask, YES you are REALLY supposed to follow these instructions and delete the '.DIR_FS_ADMIN.'includes/auto_loaders/config.ra.php file.','error');
	};
    }

       $messageStack->add('Flexible Returns Authorization v1.0 install completed!','success');
	 
		 $sql = "ALTER TABLE " . TABLE_ORDERS_STATUS_HISTORY . " ADD rma_number VARCHAR( 255 ) NOT NULL DEFAULT ''"; 
	  $db->Execute($sql);
		 $sql = "ALTER TABLE " . TABLE_ORDERS_STATUS_HISTORY . " ADD action VARCHAR( 255 ) NOT NULL DEFAULT ''"; 
		$db->Execute($sql);	 
	 
    // find next sort order in admin_pages table
    $sql = "SELECT (MAX(sort_order)+2) as sort FROM ".TABLE_ADMIN_PAGES;
    $result = $db->Execute($sql);
    $admin_page_sort = $result->fields['sort'];

    // now register the admin pages
    // Admin Menu for Flexible Returns Authorization Configuration Menu
    zen_deregister_admin_pages('configReturnAuth');
    zen_deregister_admin_pages('configReturnAuthorization');
    zen_register_admin_page('configReturnAuth',
        'BOX_CONFIGURATION_RETURN_AUTH', 'FILENAME_CONFIGURATION',
        'gID=' . $ra_configuration_id, 'configuration', 'Y',
        $admin_page_sort);
