Contribution: Flexible Returns Authorization

For Zen-Cart 1.5.6c
Version: 1.6a
Original Author: Clyde Jones
Updated by: 
Thomas McCaffery
Crystal Jones (http://overthehillweb.com) 
Raymond A Barbour (http://ZCadditions.com)
Scott Wilson (http://www.thatsoftwareguy.com) 

License: under the GPL - See attached License for info.
Support: Only given via the Zen Cart forums. (Please DO NOT email or PM contributors for "private" support)

------------------------------------------------------------------------------
Fixes for V1.6a
1. Corrected PHP Notice account-history-info (virtual) YOUR_TEMPLATE/tpl_account_history_info.php
2. Removed double heading from checkout-success page YOUR_TEMPLATE/tpl_account_history_info.php

New Features in v1.4
1. Ensure order was actually placed by the customer who's posting an RMA.

New Features in v1.3
1. Updated ./includes/init_includes/init_ra_config.php to 
explicitly call out fields being updated in Configuration.

New Features in v1.2
1. The Returns Page is no longer being accessed directly. 
2. Order info gathering: A customer or COWOA customer is now taken to a new page (Return Authorization Request) where they can login or lookup order for which the item is on to request a RMA#.
For less confusion, customers that login are taken right to their (My Account > History) page where they are prompted on how to Request a RMA#.
COWOA customers are taken right to the (Order Information) page for the Order Number they entered.
3. Completed Order Status: A new configuration has been added so you can set the (Order Status) for completed/shipped orders.
3A. The Date Added for Completed Order Status is used to allow/deny RMA Request submissions.
4. Returns Grace Period: A new configuration has been added to enter the amount of days that you allow your customers to return items.
4A. The value (example "30") will represent a 30 Day return policy. If the order in question is older than 30 days it will disable form submission and prompt customer to contact store otherwise it will allow submission for a RMA#. 
5. RMA Popup Package Label: Upon Success of the RMA# Request Form, the customer is directed to a success page where they are issued a RMA# and instruction to return items along with a link to a Popup Package Label with Returns Address and RMA#.
6. RMA# Grace Period: A new configuration has been added to enter the amount of days before the RMA# expires.
6A. The value (example "15") will represent 15 Days, this value is included in the email confirmation sent to the customer.
7. Customer Email: We added the RMA# to the subject line and changed the text to reflect the new RMA process.
8. Admin Email: We changed display so it was easier to read.
9. DateBase Columns Added: We added (2) database columns to orders_status_history to save RMA# and Reason for Return.
10. Admin Orders Edit Page: We merged the Reason for Return with the comments and added a RMA# column next to the comments column.

Fixes for v1.1
1. Updated the auto install file to include missing configuration to return "Reason for Return" to admin>orders>edit>comments
------------------------------------------------------------------------------

Flexible Return Authorization v1.1

Minor updates/fixes to the header.php and tpl_returns_default.php files.. 

------------------------------------------------------------------------------

Flexible Return Authorization v1.0

WHAT DOES THIS MODULE DO?

Flexible Return Authorization is based on the original Returns Authorization by Clyde Jones (http://www.zen-cart.com/downloads.php?do=file&id=288). This module adds a Returns Authorization Request page to your store where your customer can read your returns policy and fill in a form to obtain a return authorization request. The contents of the form are emailed to the store owner. A confirmation e-mail is also sent to the customer.

Flexible Returns Authorization expands the original Returns Authorization functionality by adding a number of admin configurable options including:
1.	Field display options:
	a.	Display as Optional
	b.	Display as Required
	c.	Do not Display
2.	Error Message Display options:
	a.	Inline Display
	b.	Message Stack Display
3.	Show Store Name, Address and Phone for Returns (ship to) on Returns Page
4.	Show Store Name, Address and Phone for Returns (ship to) on Returns Success Page
5.	Show Different Returns (ship to) Address on Returns Success Page
6.	Add RMA link or button to the account History page
7.	Option to have Order Status updated upon RMA Submission
8.	Option to have Order Comments updated upon RMA Submission
9.	Auto Generates RMA# on Success Page for (Logged in Customers) & Visitors

------------------------------------------------------------------------------

Return Authorization v2.0
This module adds a Return Authorization Request page to your store where your customer can read your returns policy and fill in a form to obtain a return authorization request. The contents of the form are emailed to the store owner. 

This update removes the tables that were in the previous versions and has been updated to be compatible with Zen Cart version 1.3.6. 

------------------------------------------------------------------------------

FILES INCLUDED:

email\email_template_returns.html
includes\extra_datafiles\popup_returns.php
includes\extra_datafiles\returns_filenames.php
includes\extra_datafiles\returns_request_filenames.php
includes\languages\english\YOUR_TEMPLATE\account_history.php
includes\languages\english\YOUR_TEMPLATE\account_history_info.php
includes\languages\english\YOUR_TEMPLATE\popup_returns.php
includes\languages\english\YOUR_TEMPLATE\returns.php
includes\languages\english\YOUR_TEMPLATE\returns_request.php
includes\languages\english\extra_definitions\returns_request.php
includes\languages\english\extra_definitions\YOUR_TEMPLATE\returns_defines.php
includes\languages\english\html_includes\define_returns.php
includes\languages\english\html_includes\YOUR_TEMPLATE\define_returns.php
includes\modules\pages\popup_returns\header_php.php
includes\modules\pages\popup_returns\jscript_main.php
includes\modules\pages\returns\header_php.php
includes\modules\pages\returns\jscript_main.php
includes\modules\pages\returns\on_load_main.js
includes\modules\pages\returns_request\header_php.php
includes\modules\pages\returns_request\jscript_main.php
includes\modules\sideboxes\classic\YOUR_TEMPLATE\information.php
includes\modules\sideboxes\classic\YOUR_TEMPLATE\more_information.php
includes\templates\YOUR_TEMPLATE\css\popup_returns.css
includes\templates\YOUR_TEMPLATE\css\returns.css
includes\templates\YOUR_TEMPLATE\images\exclamation.gif
includes\templates\YOUR_TEMPLATE\images\optional.png
includes\templates\YOUR_TEMPLATE\images\star.png
includes\templates\YOUR_TEMPLATE\popup_returns\tpl_main_page.php
includes\templates\YOUR_TEMPLATE\templates\tpl_account_history_default.php
includes\templates\YOUR_TEMPLATE\templates\tpl_returns_default.php
includes\templates\YOUR_TEMPLATE\templates\tpl_account_history_info_default.php
includes\templates\YOUR_TEMPLATE\templates\tpl_returns_request_default.php

YOUR_ADMIN\orders.php
YOUR_ADMIN\includes\auto_loaders\config.ra.php
YOUR_ADMIN\includes\extra_datafiles\return_authorization_defines.php
YOUR_ADMIN\includes\init_includes\init_ra_config.php

------------------------------------------------------------------------------

DATABASE MODIFICATIONS:

New configuration options are added to the zen_configuration table.
New Table columns are add to TABLE_ORDERS_STATUS_HISTORY

------------------------------------------------------------------------------

VERSION HISTORY:

Flexible RMA Version: 1.6a
Date Added: 23 Aug 2019
Author: Thomas McCaffery

Flexible RMA Version: 1.2
Date Added: 	27 Jul 2013
Author: 	C Jones & Raymond A Barbour

Flexible RMA Version: 1.1
Date Added: 	7 Jul 2013
Author: 	C Jones & Raymond A Barbour

Flexible RMA Version: 1.0
Date Added: 	7 Jul 2013
Author: 	C Jones & Raymond A Barbour
 
RMA Version: 3.0.0
Date Added: 	7 Apr 2013
Author: 	alray10
 
RMA Version: v2.3.3a
Date Added: 	28 Apr 2010
Author: 	clydejones
 
RMA Version: v2.3.3
Date Added: 	19 Apr 2010
Author: 	clydejones
 
RMA Version: v2.3.2
Date Added: 	28 Jan 2010
Author: 	clydejones
 
RMA Version: 2.3.1
Date Added: 	22 Jan 2010
Author: 	mprough
 
RMA Version: 2.3.0
Date Added: 	7 Apr 2009
Author: 	clydejones
 
RMA Version: v2.2.2
Date Added: 	27 Mar 2008
Author: 	clydejones
 
RMA Version: v2.2.1a
Date Added: 	29 Jan 2008
Author: 	clydejones
 
RMA Version: v2.2.1
Date Added: 	17 Jan 2008
Author: 	clydejones
 
RMA Version: 2.2
Date Added: 	27 Jun 2007
Author: 	clydejones
 
RMA Version: 2.1.3
Date Added: 	4 Apr 2007
Author: 	clydejones
 
RMA Version: 2.1.2
Date Added: 	2 Mar 2007
Author: 	clydejones
 
RMA Version: 2.1.1
Date Added: 	1 Mar 2007
Author: 	clydejones
 
RMA Version: 2.1
Date Added: 	28 Feb 2007
Author: 	clydejones
 
RMA Version: 2.0.3a
Date Added: 	12 Jan 2007
Author: 	clydejones
 
RMA Version: 2.0.3
Date Added: 	11 Jan 2007
Author: 	Unknown
 
RMA Version: 2.0.2
Date Added: 	8 Jan 2007
Author: 	clydejones
 
RMA Version: 2.0.1
Date Added: 	6 Jan 2007
Author: 	clydejones
 
RMA Version: 2.0
Date Added: 	28 Dec 2006
Author: 	clydejones
 
RMA Version: 2.0
Date Added: 	27 Dec 2006
Author: 	clydejones
 
Version: 2.0.3
Date Added: 	11 Jan 2007
Author: 	Unknown
 
Version: 2.0.2
Date Added: 	8 Jan 2007
Author: 	clydejones
 
Version: 2.0.1
Date Added: 	6 Jan 2007
Author: 	clydejones
 
Version: 2.0
Date Added: 	28 Dec 2006
Author: 	clydejones
 
Version: 2.0
Date Added: 	27 Dec 2006
Author: 	clydejones

