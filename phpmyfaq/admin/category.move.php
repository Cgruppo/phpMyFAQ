<?php
/******************************************************************************
 * File:				category.move.php
 * Description:			select a category to move
 * Author:				Thorsten Rinne <thorsten@phpmyfaq.de>
 * Date:				2004-04-29
 * Last change:			2004-06-18
 * Copyright:           (c) 2004 Thorsten Rinne
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

if ($permission["editcateg"]) {
    $cat = new category;
    $categories = $cat->getAllCategories();
    unset($cat->categories);
    $cat->getCategories(0);
    $cat->buildTree();
    $id = $_GET["cat"];
    print "<h2>".$PMF_LANG["ad_categ_edit_1"]." <em>".$categories[$id]["name"]."</em> ".$PMF_LANG["ad_categ_edit_2"]."</h2>\n";
?>
	<form action="<?php print $_SERVER["PHP_SELF"].$linkext; ?>" method="post">
	<input type="hidden" name="aktion" value="changecategory" />
	<input type="hidden" name="cat" value="<?php print $id; ?>" />
	<div class="row"><span class="label"><strong><?php print $PMF_LANG["ad_categ_change"]; ?>:</strong></span>
    <select name="change" size="1">
    <?php print $cat->printCategoryOptions(); ?>
    </select></div>
    <div class="row"><span class="label"><strong>&nbsp;</strong></span>
    <input class="submit" type="submit" name="submit" value="<?php print $PMF_LANG["ad_categ_updatecateg"]; ?>" /></div>
    </form>
<?php
	}
else {
	print $PMF_LANG["err_NotAuth"];
	}
?>