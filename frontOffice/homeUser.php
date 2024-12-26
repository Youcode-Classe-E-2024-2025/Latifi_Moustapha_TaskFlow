

<?php

require_once('../backOffice/config/config.php') ;
require_once('../backOffice/config/loadData.php') ;



$db = new Database();
$pdo = $db->getConnection();

$loader = new LoadData($pdo, '../backOffice/data/database.sql');
$loader->getData();
