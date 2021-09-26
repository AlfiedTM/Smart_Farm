<?php

$Conn = new mysqli("localhost", "root", "1Bervin@6154", "smart farm");

if($Conn->connect_errno){
    die("Connection error ".$Conn->connect_error);
}
?>