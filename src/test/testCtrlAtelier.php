<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/web/CtrlAtelier.php');
$test = new CtrlAtelier('dbserver', 'acleret', 'azerty', 'acleret');
if ($test->checkConnection()) {
    die("Connection failed: " . $test->checkConnection());
}

echo $test->createAtelier('chimie', 'science', '2016/01/01', 'RAS', 'Talence', '003000', 'initiation a la chimie', 30, 'inria', 'lyceens', 'initiation a la chimie', 'ATELIER');

?>
