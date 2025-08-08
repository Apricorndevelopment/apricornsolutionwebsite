<?php
require 'db_connect.php';

$id = $_GET['id'];
$conn->query("DELETE FROM followup WHERE id=$id");

header("Location: followup.php");
exit();
