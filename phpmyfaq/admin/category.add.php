<?php
/******************************************************************************
 * File:				category.add.php
 * Description:			add a category
 * Author:				Thorsten Rinne <thorsten@phpmyfaq.de>
 * Date:				2003-12-20
 * Last change:			2004-07-26
 * Copyright:           (c) 2001-2004 Thorsten Rinne
 * 
 * The contents of this file are subject to the Mozilla Public License
 * Version 1.1 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 * 
 * Software distributed under the License is distributed on an "AS IS"
 * basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 * License for the specific language governing rights and limitations
 * under the License.
 ******************************************************************************/

print "<h2>".$PMF_LANG["ad_categ_new"]."</h2>\n";
if ($permission["addcateg"]) {
    $cat = new Category;
?>
    <form action="<?php print $_SERVER["PHP_SELF"].$linkext; ?>" method="post">
    <fieldset>
    <legend><?php print $PMF_LANG["ad_categ_new"]; ?></legend>
    <input type="hidden" name="aktion" value="savecategory" />
    <input type="hidden" name="parent_id" value="<?php if (isset($_GET["cat"])) { print $_GET["cat"]; } else { print "0"; } ?>" />
<?php
    if (isset($_REQUEST["cat"])) {
?>
    <p><?php print $PMF_LANG["msgMainCategory"].": ".$cat->categoryName[$_GET["cat"]]["name"]; ?></p>
<?php
        }
?>
	<div class="row"><span class="label"><strong><?php print $PMF_LANG["ad_categ_titel"]; ?>:</strong></span>
    <input class="admin" type="text" name="name" size="30" style="width: 250px;" /></div>
    <div class="row"><span class="label"><strong><?php print $PMF_LANG["ad_categ_lang"]; ?>:</strong></span>
    <select name="lang" size="1">
    <?php print languageOptions($LANGCODE); ?>
    </select></div>
    <div class="row"><span class="label"><strong><?php print $PMF_LANG["ad_categ_desc"]; ?>:</strong></span>
    <input class="admin" type="text" name="description" size="30" style="width: 250px;" /></div>
    <div class="row"><span class="label"><strong>&nbsp;</strong></span>
    <input class="submit" type="submit" name="submit" value="<?php print $PMF_LANG["ad_categ_add"]; ?>" /></div>
    </fieldset>
	</form>
<?php
	}
else {
	print $PMF_LANG["err_NotAuth"];
	}