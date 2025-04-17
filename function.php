<?php
include "config.php";

function getUrl($url='')
{
    if($url!="")
         return $url = URL.$url;
    else
        return URL;
}
function getAdminUrl($url)
{
    if($url!="")
         return $url = URL."admin/".$url;  
    else
        return URL."admin/";
}




$mysql = new mysqli(DBServername, DBUsername, DBPassword, DBName);

// Check connection
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}
