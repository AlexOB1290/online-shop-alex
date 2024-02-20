<?php
//$str = "HITMAN";
//$res = "";
//for($i = 0; $i < strlen($str); $i++) {
//    echo $res = $str[$i];
//    echo "<br>";
//}
//echo "RingoStar";
//phpinfo();
$db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");
$db->exec("CREATE TABLE users (id SERIAL PRIMARY KEY, name varchar(255) NOT NULL)");
$db->exec("INSERT INTO users VALUES (3, 'Vitya')");