<?php
$query_title = mysql_query("select*from title where id=1");
$array_title = mysql_fetch_array($query_title);
$title = $array_title["title"];
$brand = $array_title["brand"];
?>