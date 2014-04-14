<?php
$query = "SELECT t1.username, email, firstname, cnt_cat as cnt FROM (SELECT count( u1.category_id ) AS cnt_cat, u1.username FROM ezdia.user_experties u1 GROUP BY u1.username)t1 INNER JOIN users t2 WHERE t1.username = t2.username AND t1.cnt_cat <2 and t2.email_notifications = 10 and t2.status_active != 2 and t2.status_verified != 0 and t2.email not like '%hotmail.com' AND t2.email not like '%live.com' AND t2.email not like '%msn.com'";
?>
