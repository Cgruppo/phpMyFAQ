<?php
/******************************************************************************
 * File:				adminlog.php
 * Description:			shows admin log
 * Authors:				Thorsten Rinne <thorsten@phpmyfaq.de>
 * Date:				2003-02-23
 * Last change:			2004-07-23
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

if ($permission["adminlog"]) {
	$perpage = 15;
	if(!isset($_REQUEST["pages"])) {
		$pages = round(($db->num_rows($db->query("SELECT id FROM ".SQLPREFIX."faqadminlog"))+($perpage/3)) / $perpage,0);
		}
	else {
		$pages = $_REQUEST["pages"];
		}
	
	if(!isset($_REQUEST["page"])) {
		$page = 1;
		}
	else {
		$page = $_REQUEST["page"];
		}
	
	$start = ($page-1) * $perpage;
	$ende = $start + $perpage;
	
	$PageSpan = PageSpan("<a href=\"".$_SERVER["PHP_SELF"].$linkext."&amp;aktion=adminlog&amp;pages=".$pages."&amp;page=<NUM>\">", 1, $pages, $page);
	
	$result = $db->query("SELECT id, time, usr, text, ip FROM ".SQLPREFIX."faqadminlog ORDER BY id DESC LIMIT ".$start.", ".$perpage);
?>
	<h2><?php print $PMF_LANG["ad_adminlog"]; ?></h2>
    <table class="list">
    <thead>
        <tr>
            <th class="list"><?php print $PMF_LANG["ad_categ_id"]; ?></th>
            <th class="list"><?php print $PMF_LANG["ad_adminlog_date"]; ?></th>
            <th class="list"><?php print $PMF_LANG["ad_adminlog_user"]; ?></th>
            <th class="list"><?php print $PMF_LANG["ad_adminlog_ip"]; ?></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
		    <td class="list" colspan="4"><?php print $PageSpan; ?></td>
        </tr>
    </tfoot>
    <tbody>
<?php
	while (list($id,$tim,$usr,$text,$ip) = $db->fetch_row($result)) {
		list($usr) = $db->fetch_row($db->query("SELECT NAME FROM ".SQLPREFIX."faquser WHERE ID='".$usr."'"));
?>
        <tr class="cell">
            <td class="list"><?php print $id; ?></td>
            <td class="list"><?php print date("Y-m-d H:i:s",$tim); ?></td>
            <td class="list"><?php print $usr; ?></td>
            <td class="list"><?php print $ip; ?></td>
        </tr>
        <tr class="cell">
            <td colspan="4" class="list"><?php
		$text = str_replace("Loginerror", $PMF_LANG["ad_log_lger"], $text);
		$text = str_replace("Session expired", $PMF_LANG["ad_log_sess"], $text);
		$text = str_replace("Useredit, ", $PMF_LANG["ad_log_edit"], $text);
		$text = str_replace("Beitragcreatesave", $PMF_LANG["ad_log_crsa"], $text);
		$text = str_replace("Beitragcreate", $PMF_LANG["ad_log_crea"], $text);
		$text = str_replace("Usersave, ", $PMF_LANG["ad_log_ussa"], $text);
		$text = str_replace("Userdel, ", $PMF_LANG["ad_log_usde"], $text);
		$text = str_replace("Beitragedit, ", $PMF_LANG["ad_log_beed"], $text);
		$text = str_replace("Beitragdel, ", $PMF_LANG["ad_log_bede"], $text);
		print $text;
?></td>
        </tr>
<?php
		}
?>
	</tbody>
	</table>
<?php
	}
else {
	print $PMF_LANG["err_NotAuth"];
	}
?>
