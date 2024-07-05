<?php

namespace App\Controllers;

use Framework\Database;


class ListingController 
{
    protected $db;

    public function __construct()
    {
        $config = require getBasePath('config/db.php');

        $this->db = new Database($config);
    }

    /**
     * Retrieves a list of the latest 6 listings and renders the listings/index view with the listings data.
     */
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings LIMIT 6')->fetchAll();

        loadView('listings/index', [
            'listings' => $listings,
        ]);
    }

    public function create()
    {
        loadView('listings/create');
    }

    /**
     * Retrieves a single listing by its ID and renders the listings/show view with the listing data.
     *
     * @param int $id The ID of the listing to retrieve.
     */
    public function show($params)
    {
        $id = $params['id'] ?? '';

        $params = [
                'id' => $id
            ];

        $listing =  $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        loadView('listings/show', [
            'listing' => $listing
        ]);
    }
}