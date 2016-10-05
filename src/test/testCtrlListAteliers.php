<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/web/CtrlListAteliers.php');
$test = new CtrlListAteliers('dbserver', 'acleret', 'azerty', 'acleret');

if ($test->checkConnection()) {
    die("Connection failed: " .$test->checkConnection());
}

echo $test->getListAteliers('ATELIER','date');
?>