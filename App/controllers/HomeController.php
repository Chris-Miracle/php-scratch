<?php

namespace App\Controllers;

use Framework\Database;


class HomeController 
{
    protected $db;

    public function __construct() {

        $config = require getBasePath('config/db.php');

        $this->db = new Database($config);
    }

    /**
     * Retrieves a list of the latest 6 listings from the database and renders the home view with the listings data.
     */
    public function index() 
    {
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC LIMIT 6')->fetchAll();

        loadView('home', [
            'listings' => $listings,
        ]);
    }
}