<?php
$message = '<html><body>';
$message .= '<div style="color:#333; font-size: 12px;">';
$message .= '<div style="width: 625px; font-family: Verdana,Arial; font-size: 17px; color: white; font-weight: bold; height:31px;">';
$message .= '<img alt="" src="http://www.ezdia.com/static/images/bg.PNG" />';
$message .= '</div>';
$message .= '<div style="border: 1px solid rgb(45, 173, 225); padding: 10px; padding-top: 0; height: auto; width: 603px; top: 39px; left: 8px; z-index: 2; float: left; color: rgb(0, 64, 128);">';
$message .= '<img alt="" height="80" src="http://www.ezdia.com/static/images/eZdiaNewLogo.png" style="float: left; margin-left: 10px;" width="50">';
$message .= '<div id="layer2" style="font-family: Verdana, Arial; width: 550px; height: auto; position: relative; text-align: left;">';
$message .= '&nbsp;Dear&nbsp;'.$firstname.',<br><br>';
$message .= 'Clients are looking for you.<br><br>';
$message .= 'Many employers posted thier requirement, but your limited mentioned experties is keeping them away.<br><br>';
$message .= 'We have observed that you have added only&nbsp;'.$att_count.' experties in your profile. <br> You must never miss the opportunity to tell your customers,<br>how much they mean to you.<br><br>';
$message .= 'Add more experties and update the existing one with proper description now.<br><br>';
$message .= 'Just 3 steps to go <br>';
$message .= '&nbsp;&nbsp;Log in to your <a href="http://www.ezdia.com?utm_source='.$activityutm.'" target="_blank">eZdia account</a>.<br>';
$message .= '&nbsp;&nbsp;Click on the Edit Profile link at the top<br>';
$message .= '&nbsp;&nbsp;Scroll Down and Edit the details.<br><br>';
$message .= '</div>';
$message .= '<div id="layer4" style="padding-bottom:10px; border-bottom:1px solid rgb(45, 173, 225); border-top: 1px solid rgb(45, 173, 225); position: relative; width: 610px; margin-top: 20px; font-family: Verdana, Arial;">';
$message .= '<br>Thanks and Regards,<br>Maya Ray | Project Support Exceutive | eZdia Inc';
$message .= '</div>';
$message .= 'If you do not wish to receive further mails, please <a href="http://www.ezdia.com/jsp/Unsubscribe.jsp?email='.$email. '&id='.sha1($username).'">unsubscribe me </a><br><br>';
$message .= 'If you see any issues with the above link please copy the link on to your browser to unsubscribe  http://www.ezdia.com/jsp/Unsubscribe.jsp?email='.$email. '&id='.sha1($username).'';
$message .= '</div>';
$message .= '</div>';
$message .= '</body></html>';
$subject = 'Your visibilty is limited to ezdia and search engine';
?>
