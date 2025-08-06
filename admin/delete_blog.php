<?php
require 'db_connect.php';

$id = $_GET['id'];
$conn->query("DELETE FROM addedblogs WHERE id=$id");

header("Location: manage_blogs.php");
exit();
