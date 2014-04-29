<?php
require "autoload.php";
use customer\retail as retail;
$controller = new retail\controller\Controller();
$controller->execute();
?>
