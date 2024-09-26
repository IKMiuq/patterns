<?php
require_once("generative/Singleton.php");

$patterns = \generative\Singleton::getInstance();
var_dump($patterns::selfName("test"));