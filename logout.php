<?php
include_once "header.inc.php";
session_destroy();
header("location: index.php");
exit();