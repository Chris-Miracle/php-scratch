<?php

use Framework\Database;

$config = require getBasePath('config/db.php');

$db = new Database($config);

$listings = $db->query('SELECT * FROM listings LIMIT 6')->fetchAll();

loadView('listings/index', [
    'listings' => $listings,
]);