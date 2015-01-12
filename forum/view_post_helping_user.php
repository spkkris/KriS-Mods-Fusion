<?php
/*---------------------------------------------------+
| PHP-Fusion 6 Content Management System
+----------------------------------------------------+
| Copyright _ 2002 - 2006 Nick Jones
| http://www.php-fusion.co.uk/
+----------------------------------------------------+
| Released under the terms & conditions of v2 of the
| GNU General Public License. For details refer to
| the included gpl.txt file or visit http://gnu.org
+----------------------------------------------------*/  
require_once "../maincore.php";
require_once INCLUDES."forum_include.php";
require_once THEMES."templates/header.php";
include LOCALE.LOCALESET."forum/view_post_helping_user.php";   
   
   
if ($_GET['action'] == "view_help") {

if (!isset($_GET['user_id']) || !isNum($_GET['user_id'])) redirect("index.php");
$result2 = dbquery("SELECT * FROM ".DB_USERS." WHERE user_id=".$_GET['user_id']."");
$result = dbquery("SELECT * FROM ".DB_POSTS." p
LEFT JOIN ".DB_THREADS." t ON (p.thread_id=t.thread_id)
WHERE post_help='".$_GET['user_id']."' ORDER BY post_help AND post_datestamp");
$udata = dbarray($result2);   

$is_mod = "";

opentable("".$locale['001']." ".$udata['user_name']." ".$locale['002']."");
   
      if (dbrows($result)) {
         while ($pdata = dbarray($result)) {
                        
            echo"<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>               
                  <tr>
                     <td width='145' class='tbl2'>
                        Autor:
                     </td>
                     <td class='tbl2'>
                        ".$pdata['thread_subject']."
                     </td>
                  </tr>
                  <tr>
                     <td class='tbl1' valign='top'>
                         <span class='alt'><a href='../profile.php?lookup=".$udata['user_id']."'>".$udata['user_name']."</a></span> <br>
                         <span class='alt'>".($is_mod ? $locale['userf1'] : getuserlevel($udata['user_level']))."
                        </span><br>"; 
                        
                        if ($udata['user_avatar'] != "") {
                        echo " <img src='".IMAGES."avatars/".$udata['user_avatar']."' alt=''> <br>\n";
                           $height = "105";
                        } else {
                           $height = "70";
                        }
                        echo" <span class='alt'>".$locale['003']."</span> ".$udata['user_posts']."<br>";
                        if ($udata['user_location']) echo "<span class='alt'>".$locale['004']."</span> ".$udata['user_location']."<br>";                  
                        echo" <span class='alt'><b>".$locale['005']."</b></span> ".$udata['user_help_point']." <br>
                         <span class='alt'>".$locale['006']."</span> ".showdate("%d.%m.%y", $udata['user_joined'])."                     
                     </td>
                     <td class='tbl1' valign='top'>
                        <table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>
                           <tr>
                           

                              <td class='tbl1' style='background-color: #FFFF99'>

                                 <span class='alt'>".$locale['006']." ".showdate("%d.%m.%y - %H:%M", $pdata['post_datestamp'])."</span>
                              </td>
                           </tr>
                           <tr>
                              <td class='tbl1' valign='top' height='$height' style='background-color: #FFFF99'>";
                              $mesage = parseubb($pdata['post_message']);
                              $mesage = nl2br($mesage);
                              if ($pdata['post_smileys'] == 1) {
                              $mesage = parsesmileys($pdata['post_message']);
                              }
                              echo $mesage;
                              echo"</td>
                           </tr>
                           <tr>
                              <td class='tbl1' style='background-color: #FFFF99'>";
                                 if ($udata['user_aim'] && file_exists(THEME."forum/aim.gif")) {
                                    echo "<a href=';aim:goim?screenname=".str_replace(" ", "+", $udata['user_aim'])."' target='_blank'><img src='".THEME."forum/aim.gif' alt='".$udata['user_aim']."' style='border:0px;'></a> ";
                                 }
                                 if ($udata['user_icq']) {
                                    echo "<a href='http://web.icq.com/wwp?Uin=".$udata['user_icq']."' target='_blank'><img src='".THEME."forum/icq.gif' alt='".$udata['user_icq']."' style='border:0px;'></a> ";
                                 }
                                 if ($udata['user_msn']) {
                                    echo "<a href='mailto:$udata[user_msn]'><img src='".THEME."forum/msn.gif' alt='".$udata['user_msn']."' style='border:0px;'></a> ";
                                 }
                                 if ($udata['user_yahoo']) {
                                    echo "<a href='http://uk.profiles.yahoo.com/$udata[user_yahoo]' target='_blank'><img src='".THEME."forum/yahoo.gif' alt='".$udata['user_yahoo']."' style='border:0px;'></a> ";
                                 }
                                 if ($udata['user_web']) {
                                 if (!strstr($udata['user_web'], "http://")) { $urlprefix = "http://"; } else { $urlprefix = ""; }
                                    echo "<a href='".$urlprefix."".$udata['user_web']."' target='_blank'><img src='".THEME."forum/web.gif' alt='".$udata['user_web']."' style='border:0px;'></a> ";
                                 }
                                 echo "<a href='".BASEDIR."messages.php?msg_send=".$udata['user_id']."'><img src='".THEME."forum/pm.gif' alt='' style='border:0px;'></a>
                              </td>
                           </tr>
                        </table>
                     </td>                  
                  </tr>
               </table> <br>";
            }
         } 
      else { redirect("index.php"); }
            
   closetable();   
} 

require_once THEMES."templates/footer.php";
?>
