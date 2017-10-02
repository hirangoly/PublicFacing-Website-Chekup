<?php
require("phpMailer/class.phpmailer.php");
include 'connection.php'; 
//Script to send email to the users :
// 1. haven't login since long, 
// 2. Incomplete profile, 
// 3. limited skills

//retrieve parameters from config file
$emailConfFile = 'emailconfig.conf';

if (!is_file($emailConfFile))
    die ('Unable to open emailConfig file, may be the path is wrong');
$fp = fopen($emailConfFile,'r');
$emailConfFileContents = fread ($fp, filesize ($emailConfFile));
fclose ($fp);

//parameters for profile
preg_match('|PFcount = (.*)\n|',$emailConfFileContents,$result);
$profileCount = str_replace('"','',$result[1]);
preg_match('|PFutm_source = (.*)\n|',$emailConfFileContents,$result);
$utmsourcePF = str_replace('"','',$result[1]);

//parameters for skill
preg_match('|SKcount = (.*)\n|',$emailConfFileContents,$result);
$skillCount = str_replace('"','',$result[1]);
preg_match('|SKutm_source = (.*)\n|',$emailConfFileContents,$result);
$utmsourceSK = str_replace('"','',$result[1]);

//parameters for login
preg_match('|LGcount = (.*)\n|',$emailConfFileContents,$result);
$loginCount = str_replace('"','',$result[1]);
preg_match('|LGutm_source = (.*)\n|',$emailConfFileContents,$result);
$utmsourceLG = str_replace('"','',$result[1]);

//parameters for phone update
preg_match('|PHcount = (.*)\n|',$emailConfFileContents,$result);
$phoneCount = str_replace('"','',$result[1]);
preg_match('|PHutm_source = (.*)\n|',$emailConfFileContents,$result);
$utmsourcePH = str_replace('"','',$result[1]);


$querySK = "SELECT t1.username, email, firstname, cnt_cat as cnt FROM (SELECT count( u1.category_id ) AS cnt_cat, u1.username FROM abc.user_experties u1 GROUP BY u1.username)t1 INNER JOIN users t2 WHERE t1.username = t2.username AND t1.cnt_cat <".$skillCount. " LIMIT 1"";

$userarray = array();
$j=-1;
$i = 1;

$query = $querySK;
	
	//retrieve the list of users for activity 
	$userresult = mysql_query($query);
	
	//loop for users
	WHILE($userrow = mysql_fetch_array($userresult, MYSQL_NUM)) 
	{
		$username = $userrow[0];
		$email = $userrow[1];
		//$email = "hirangoly@gmail.com";
		$firstname = $userrow[2];
		$att_count = $userrow[3];
		echo 'users';


		//if email is not sent for this user
		//print "arraysearch:".in_array($username, $userarray).":";
		if(!in_array($username, $userarray))
		{
			echo 'search';
			$timeresult = mysql_query("SELECT max(timestamp) FROM katrina_emails where username = " . $username);
			$timerow = mysql_fetch_row($timeresult);
			$maxtime = $timerow[0];
			
			$date = date("Y-m-j");
			$newdate = strtotime ( '-8 day' , strtotime ( $date ) ) ;
			$newdate = date ( 'Y-m-j' , $newdate );
			//need to multiply $newdate with number of scenarios
		
			
			//if no entry for this user yet or last email sending time is 8 days back
			if($maxtime == null || $maxtime < $newdate)
			{
				echo 'time';
				echo 'timestamp = null or greater than (today - 8)<br>';
				$result = mysql_query("SELECT max(timestamp) FROM katrina_emails where username = " . $username. " and activityname = '" .$activityName."'");
				$row = mysql_fetch_row($result);

				$timestamp = $row[0];
				//if no entry in the table or the last sending email time for the (user+activity) is less than 7 days then send email to the user and Insert the data
				if($timestamp == NULL || $timestamp < $newdate)
				{
					echo 'timestamp for activity = null or last time mail sent 7 days back<br>';
					echo "username:".$username."<br>";
					echo "email:".$email."<br>";
					echo "firstname:".$firstname."<br>";
					
					//send email - begins
					//$to = $email;
					$to = 'hirangoly@gmail.com';
					$from = "communications@mail.ezdea.com";
					echo "to".$to;
					
					try{

					$mail = new PHPMailer();

					$mail->IsSMTP(); // send via SMTP
					$mail->Host = "something.com"; // SMTP servers
					$mail->Port = "25";
					$mail->SMTPAuth = true; // turn on SMTP authentication
					$mail->Username = "communications@mail.something.com"; // SMTP username
					$mail->Password = "abc3312"; // SMTP password

					$mail->From = $from;
					$mail->FromName = "Rangoly";
					
					$mail->AddAddress("$to","");
					$mail->AddReplyTo("verification@something.com","Varsha");

					$subject = 'Lot many oppotunities for you on abc';
					$mail->WordWrap = 50; // set word wrap
					$mail->IsHTML(true); // send as HTML

					$mail->Subject = $subject;
					//$mail->Body = "This is the <b>HTML phpmailer body</b>";

					$message = '<html><body>';
					$message .= '<div style="color:#333; font-size: 12px;">';
					$message .= '<div style="width: 625px; font-family: Verdana,Arial; font-size: 17px; color: white; font-weight: bold; height:31px;">';
					$message .= '<img alt="" src="http://www.company-name.com/static/images/bg.PNG" />';
					$message .= '</div>';
					$message .= '<div style="border: 1px solid rgb(45, 173, 225); padding: 10px; padding-top: 0; height: auto; width: 603px; top: 39px; left: 8px; z-index: 2; float: left; color: rgb(0, 64, 128);">';
					$message .= '<img alt="" height="80" src="http://www.company-name.com/static/images/abcdNewLogo.png" style="float: left; margin-left: 10px;" width="50">';
					$message .= '<div id="layer2" style="font-family: Verdana, Arial; width: 550px; height: auto; position: relative; text-align: left;">';
					$message .= '&nbsp;Dear&nbsp;'.$firstname.',<br><br>';
					$message .= 'Clients are looking for you.<br><br>';
					$message .= 'Many employers posted thier requirement, but your limited mentioned experties is keeping them away.<br><br>';
					$message .= 'We have observed that you have added only&nbsp;'.$att_count.'$nbsp;experties in your profile. <br> You must never miss the opportunity to tell your customers,<br>how much they mean to you.<br><br>';
					$message .= 'Add more experties and update the existing one with proper description now.<br><br>';
					$message .= 'Just 3 steps to go <br>';
					$message .= '&nbsp;&nbsp;Log in to your <a href="company-name.com?utm_source=katrina_sk" target="_blank">abcd account</a>.<br>';
					$message .= '&nbsp;&nbsp;Click on the Edit Profile link at the top<br>';
					$message .= '&nbsp;&nbsp;Scroll Down and Edit the details.<br><br>';
					/*$message .= 'Following are some of our latest projects that may interest you:<br>';
					$message .= '&nbsp;&nbsp;Following are some of our latest projects that may interest you:<br>';
					$message .= '&nbsp;&nbsp;Following are some of our latest projects that may interest you:<br>';
					$message .= '&nbsp;&nbsp;Following are some of our latest projects that may interest you:<br>';
					$message .= '&nbsp;&nbsp;Following are some of our latest projects that may interest you:<br>';
					$message .= '&nbsp;&nbsp;Following are some of our latest projects that may interest you:<br><br>';*/
					$message .= 'With best regards,<br>abcd Team<br>Trusted Experts for your Small Needs<br><br>';
					$message .= '</div>';
					$message .= '<div id="layer4" style="padding-bottom:10px; border-bottom:1px solid rgb(45, 173, 225); border-top: 1px solid rgb(45, 173, 225); position: relative; width: 610px; margin-top: 20px; font-family: Verdana, Arial;">';
					$message .= '<br>Thanks and Regards,<br>abcd Team';
					$message .= '</div>';
					$message .= '</div>';
					$message .= '</div>';
					$message .= '</body></html>';
		
					$mail->Body = $message;

					if(!$mail->Send())
					{
						echo "Message was not sent <p>";
						echo "Mailer Error: " . $mail->ErrorInfo;
						exit;
					}
					else
					{
						echo "Message has been sent"; 
					}
					
					//Insert data with times = 1
					$insertquery = "INSERT INTO katrina_emails (username,activityname,activityflag,timestamp,times) VALUES (".$username.",'".$activityName."',1,curdate(),1)";
					mysql_query($insertquery);
					}
					catch(Exception $e)
					{
						echo 'message: ' . $e->getmessage();
					}
					$j=$j+1;

					$userarray[$j] = $username;
				}
				else
				{
					echo "no action";
				}

			}//end time loop
		}//end search loop		

	}//end users loop

mysql_close($con);

?>
	
