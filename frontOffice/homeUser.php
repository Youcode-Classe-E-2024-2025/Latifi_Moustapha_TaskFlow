<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/output.css">
    <title>Document</title>
</head>
<body>
    home user
</body>
</html> -->

<?php

require_once('../config/config.php') ;

$database = new database() ;
$pdo = $database->getConnection() ;

