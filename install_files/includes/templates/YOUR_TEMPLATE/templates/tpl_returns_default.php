<?php
/**
 * Flexible Returns Authorization (RMA) Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_returns_default.php 2.3.3 4/13/2010 Clyde Jones $
 */
?>

<div class="centerColumn" id="returnAuthorization">
  <h1 id="returnAuthorizationHeading"><?php echo HEADING_TITLE; ?></h1>
  <?php echo zen_draw_form('returns', zen_href_link(FILENAME_RETURNS, 'action=send', 'SSL')); ?>
  <?php
  if (RETURN_STORE_NAME_ADDRESS == 'true' && ($_GET['action'] == 'success')) {
    
  } else if (RETURN_STORE_NAME_ADDRESS == 'true') {
    ?>
    <address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
  <?php } ?>

  <?php if (isset($_GET['action']) && ($_GET['action'] == 'success')) { ?>
    <br class="clearBoth" />
    <div class="mainContent success">
      <?php
      $order_number = $_GET['order_id'];

// validate order number 
      if (!$_SESSION['customer_id']) {
        zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
      }
      $customer_info_query = "SELECT customers_id
                                FROM " . TABLE_ORDERS . "
                                WHERE orders_id = " . (int)$_GET['order_id'];

      $customer_info = $db->Execute($customer_info_query);

// Now let's ensure this order was posted by this customer
      if ($customer_info->fields['customers_id'] != $_SESSION['customer_id']) {
        zen_redirect(zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
      }
      ?>
      <div id="returnSuccess"><?php echo TEXT_SUCCESS . TEXT_SUCCESS_RMA_REFERENCE; ?><a href="javascript:popupWindow('<?php echo zen_href_link(FILENAME_POPUP_RETURNS, 'action=success' . '&order_id=' . $order_number); ?>')"><?php echo TEXT_SUCCESS_POPUP; ?></a><?php echo TEXT_SUCCESS_RMA_REFERENCE1; ?></div>
      <br /><br />
      <div id="returnAddressWrapper">
        <?php echo TEXT_SUCCESS_RMA_ID; ?>
        <span id="returnRMA"><?php echo $order_number . $rma_number; ?></span>
        <div id="returnAddress"><?php echo TEXT_SUCCESS_RMA_RETURN_ADDRESS; ?></div>
        <br /><br />
        <?php if (RETURN_STORE_NAME_ADDRESS_SUCCESS == 'true') { ?>
          <address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
        <?php } else if (RETURN_STORE_NAME_ADDRESS_SUCCESS == 'false') { ?>
          <address><?php echo nl2br(RETURN_STORE_NAME_ADDRESS_DIFF); ?></address>
        <?php } ?>
        <?php echo TEXT_SUCCESS_RMA_THANKS; ?>
      </div>

      <?php
      $orderID = $_GET['order_id'];
      $autoRMA = ORDER_STATUS_RMA;
      $reason = $_SESSION['comments'];
      $action = $_SESSION['action'];
      if (ORDER_STATUS_RMA_OPTION == 'true') {
        $db->Execute("UPDATE " . TABLE_ORDERS . "
                      SET orders_status = " . $autoRMA . ",
                          last_modified = now()
                      WHERE orders_id = " . (int)$orderID);
      }

      if (ORDER_COMMENTS_RMA_OPTION == 'true') {
        $returnRMA = $orderID . $rma_number;
        $db->Execute("INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . " (comments, orders_status_id, orders_id, date_added, rma_number, action)
                      VALUES ('" . $reason . "', " . $autoRMA . ", " . (int)$orderID . ", now(), '" . $returnRMA . "', '" . $action . "')");
      }
    } else {
      if (DEFINE_RETURNS_STATUS >= '1' and DEFINE_RETURNS_STATUS <= '2') {
        ?>
        <div id="returnAuthorizationMainContent">
          <?php
          /**
           * require html_define for the Returns page
           */
          require($define_page);
          ?>
        </div>
      <?php } ?>


      <?php
      if ($messageStack->size('returns') > 0) {
        echo $messageStack->output('returns');
      }
      ?>
      <div class="alert"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
      <br class="clearBoth" />
      <fieldset>
        <legend class="personal"><?php echo CONTACT_INFORMATION; ?></legend>
        <?php if (RETURN_NAME == 0 || RETURN_NAME == 1) { ?>
          <label class="inputLabel" for="contactname"><?php echo ENTRY_NAME; ?></label>
          <?php echo zen_draw_input_field('contactname', $name, 'size="40" id="contactname"' . (RETURN_NAME == 1 ? 'required' : '')) . (RETURN_NAME == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php if (RETURN_EMAIL == 0 || RETURN_EMAIL == 1) { ?>
          <label class="inputLabel" for="emailaddress"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
          <?php echo zen_draw_input_field('email', $email, 'size="40" id="emailaddress"' . (RETURN_EMAIL == 1 ? 'required' : '')) . (RETURN_EMAIL == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php if (RETURN_PHONE == 0 || RETURN_PHONE == 1) { ?>
          <label class="inputLabel" for="telephone"><?php echo ENTRY_TELEPHONE_NUMBER; ?></label>
          <?php echo zen_draw_input_field('telephone', $telephone, 'size="40" id="telephone"' . (RETURN_PHONE == 1 ? 'required' : '')) . (RETURN_PHONE == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php if (RETURN_STREET == 0 || RETURN_STREET == 1) { ?>
          <label class="inputLabel" for="address"><?php echo ENTRY_STREET_ADDRESS; ?></label>
          <?php echo zen_draw_input_field('address', $address, 'size="40" id="address"' . (RETURN_STREET == 1 ? 'required' : '')) . (RETURN_STREET == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php if (RETURN_CITY == 0 || RETURN_CITY == 1) { ?>
          <label class="inputLabel" for="city"><?php echo ENTRY_CITY; ?></label>
          <?php echo zen_draw_input_field('city', $city, 'size="40" id="city"' . (RETURN_CITY == 1 ? 'required' : '')) . (RETURN_CITY == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php if (RETURN_STATE == 0 || RETURN_STATE == 1) { ?>
          <label class="inputLabel" for="state"><?php echo ENTRY_STATE; ?></label>
          <?php echo zen_draw_input_field('state', $state, 'size="40" id="state"' . (RETURN_STATE == 1 ? 'required' : '')) . (RETURN_STATE == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php if (RETURN_POSTCODE == 0 || RETURN_POSTCODE == 1) { ?>
          <label class="inputLabel" for="postcode"><?php echo ENTRY_POST_CODE; ?></label>
          <?php echo zen_draw_input_field('postcode', $postcode, 'size="40" id="postcode"' . (RETURN_POSTCODE == 1 ? 'required' : '')) . (RETURN_POSTCODE == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php if (RETURN_COUNTRY == 0 || RETURN_COUNTRY == 1) { ?>
          <label class="inputLabel" for="country"><?php echo ENTRY_COUNTRY; ?></label>
          <?php echo zen_draw_input_field('country', $country, 'size="40" id="country"' . (RETURN_COUNTRY == 1 ? 'required' : '')) . (RETURN_COUNTRY == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
      </fieldset>

      <fieldset>
        <legend class="order"><?php echo ORDER_INFORMATION; ?></legend>
        <?php if (RETURN_ORDER_NUMBER == 0 || RETURN_ORDER_NUMBER == 1) { ?>
          <label class="inputLabel" for="order_number"><?php echo ENTRY_ORDER_NUMBER; ?></label>
          <?php echo zen_draw_input_field('order_number', $order_number, 'size="40" id="order_number"' . (RETURN_ORDER_NUMBER == 1 ? 'required' : '')) . (RETURN_ORDER_NUMBER == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php echo zen_draw_hidden_field('rma_number', $rma_number); ?> 
        <?php if (RETURN_ITEM_NAME == 0 || RETURN_ITEM_NAME == 1) { ?>
          <label class="inputLabel" for="item_name"><?php echo ENTRY_ITEM_NAME; ?></label>
          <?php echo zen_draw_input_field('item_name', $item_name, 'size="40" id="item_name"' . (RETURN_ITEM_NAME == 1 ? 'required' : '')) . (RETURN_ITEM_NAME == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php if (RETURN_ITEM_NUMBER == 0 || RETURN_ITEM_NUMBER == 1) { ?>
          <label class="inputLabel" for="item_number"><?php echo ENTRY_ITEM_NUMBER; ?></label>
          <?php echo zen_draw_input_field('item_number', $item_number, 'size="40" id="item_number"' . (RETURN_ITEM_NUMBER == 1 ? 'required' : '')) . (RETURN_ITEM_NUMBER == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php if (RETURN_VALUE == 0 || RETURN_VALUE == 1) { ?>
          <label class="inputLabel" for="total_value"><?php echo ENTRY_VALUE; ?></label>
          <?php echo zen_draw_input_field('total_value', $value, 'size="40" id="order-number"' . (RETURN_VALUE == 1 ? 'required' : '')) . (RETURN_VALUE == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
        <br class="clearBoth">
        <?php
        if (RETURN_ACTION_LIST_OPTIONS != '') {
          foreach (explode(",", RETURN_ACTION_LIST_OPTIONS) as $k => $v) {
            $entry_action_array[] = array(
              'id' => $v,
              'text' => preg_replace('/\<[^*]*/', '', $v)
            );
          }
          ?>
          <?php if (RETURN_ACTION_LIST == 0 || RETURN_ACTION_LIST == 1) { ?>
            <h4><?php echo ENTRY_ACTION_INFO; ?></h4>
            <label class="inputLabel" for="action"><?php echo ENTRY_ACTION; ?></label>
            <?php echo zen_draw_pull_down_menu('action', $entry_action_array) . (RETURN_ACTION_LIST == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
          <?php } ?>
        <?php } ?>
      </fieldset>


      <fieldset>
        <legend class="write"><?php echo ENTRY_REASON; ?></legend>
        <?php if (RETURN_REASON == 0 || RETURN_REASON == 1) { ?>
          <label class="inputLabel" for="reason"><?php echo ENTRY_REASON_TEXT; ?></label>
          <?php echo zen_draw_textarea_field('reason', '30', '7', $reason, 'id="reason"' . (RETURN_VALUE == 1 ? 'required' : '')) . (RETURN_VALUE == 1 ? '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>' : ''); ?>
        <?php } ?>
      </fieldset>
      <br class="clearBoth">
      <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
      <div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
    <?php } ?>
    <?php echo '</form>'; ?>
  </div>
