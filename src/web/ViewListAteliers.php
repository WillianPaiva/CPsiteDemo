<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/CtrlListAteliers.php');
echo '<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Ateliers</title>
        <meta name="description" content="Ateliers">
        <meta name="author" content="SitePoint">
<link rel="stylesheet" type="text/css" href="viewatelier.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
              integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading title">List of Ateliers</div>

<div class="well col-lg-8 col-lg-offset-2 
col-md-9 col-md-offset-1
col-xs-9 col-xs-offset-1">
            <!-- Table -->
            <table class="table">';



$controler = new CtrlListAteliers('dbserver', 'acleret' , 'azerty' , 'acleret');
$atribute=isset($_GET['row']) && file_exists($_GET['row'])
         ? $_GET['row'] : 'date';
$result = $controler->getListAteliers('ATELIER', $atribute);
while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["titre"]."</td><td>".$row["theme"]."</td><td>"
                   .$row["date"]."</td><td> <a type=\"button\" class=\"btn btn-default\" aria-label=\"Left Align\" href=\"ViewAtelier.php?id=".$row["id"]."\">EDIT</a> </td></tr>";
}
echo'     </table>
                <a type="button" class="btn btn-default" aria-label="Left Align" href="ViewAtelier.php">NEW</a>
        </div>
</div>
    </body>
</html>';
    ?>
