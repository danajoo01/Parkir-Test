<?php
$db = new mysqli("localhost", "root", "", "parkir");

if ($db->connect_errno)
{
	echo "Koneksi Error $db->connect_error";
}