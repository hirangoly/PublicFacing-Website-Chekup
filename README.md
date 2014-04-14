PublicFacing-Website-Chekup
===========================
Every public facing needs to keep track of user's involvement/activities to the website.
This project keeps track following user's activities and notify them timely:
* Users who haven't login for long 
* Users whose profile summary are less than 100 words
* Users who have limited skills
* Users whose phone numbers are not mentined


Basic steps: (Attached script is focus on limited skills users)
* Find out list of users for the above mentioned activities using already stored queries. e.g limitedSkills.php
* Create an emailTemplate for above activities. For Instance create email template to tell user to add more skill in thier profile in order get attention by employers. e.g limitedSkillsEmailTemplate.php
* Send email to all users using already stored query and emailTemplate. e.g users-Tracking.php
 

These script will be scheduled to run daily. The users will recieve same notification once a week.
