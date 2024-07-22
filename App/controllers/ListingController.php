<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;
use Framework\Authorization;

class ListingController
{
    protected $db;
    protected $allowedFields;

    public function __construct()
    {
        $config = require getBasePath('config/db.php');

        $this->db = new Database($config);
        $this->allowedFields = ['title', 'description', 'salary', 'requirements', 'benefits', 'company', 'address', 'city', 'state', 'phone', 'email', 'tags'];
    }

    /**
     * Retrieves a list of the latest 6 listings and renders the listings/index view with the listings data.
     */
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC')->fetchAll();

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
     * @param array $params The ID of the listing to retrieve.
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

    /**
     * Stores a new listing in the database.
     * 
     * @return void
     */

    public function store()
    {
        $newListingData = array_intersect_key($_POST, array_flip($this->allowedFields));

        $newListingData['user_id'] = Session::get('user')['id'];

        $newListingData = array_map('sanitize', $newListingData);

        $requiredFields = ['title', 'description', 'email', 'salary', 'city', 'state'];

        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $errors[$field] = ucfirst($field) . " is required";
            }

            if ($field === 'email' && !Validation::email($newListingData[$field])) {
                $errors[$field] = "Invalid email address";
            }
        }

        // inspectAndDie($errors);
        if (!empty($errors)) {
            loadView('listings/create', [
                'errors' => $errors,
                'listing' => $newListingData,
            ]);
            return;
        } else {
            // Submit the form
            $fields = [];

            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
            }

            $fields = implode(', ', $fields);

            $values = [];

            foreach ($newListingData as $field => $value) {
                if ($value === '') {
                    $newListingData[$field] = NULL;
                }
                $values[] = ":{$field}";
            }

            $values = implode(', ', $values);

            $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";

            $this->db->query($query, $newListingData);

            //Set flash message
            Session::setFlashMessage('success_message', 'Listing created successfully');

            redirect('/listings');
        }
    }

    /**
     * Deletes a listing from the database by its ID.
     * 
     * @param array $params The ID of the listing to delete.
     * @return void
     */
    public function destroy($params)
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

        // Check if the user is the owner of the listing
        if (!Authorization::isOwner($listing->user_id)) {
            Session::setFlashMessage('error_message', 'You are not authorized to delete this listing');
            return redirect('/listings/' . $listing->id);
        }

        $this->db->query('DELETE FROM listings WHERE id = :id', $params);

        //Set flash message
        Session::setFlashMessage('success_message', 'Listing deleted successfully');
        redirect('/listings');
    }

    /**
     * Retrieves a single listing by its ID and renders the listings/edit view with the listing data.
     *
     * @param array $params The ID of the listing to retrieve.
     */
    public function edit($params)
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

        loadView('listings/edit', [
            'listing' => $listing
        ]);
    }


    /**
     * Updates a listing in the database.
     * 
     * @param array $params
     * @return void
     */
    public function update($params)
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

        $updateValues = array_intersect_key($_POST, array_flip($this->allowedFields));

        $updateValues = array_map('sanitize', $updateValues);

        $requiredFields = ['title', 'description', 'email', 'salary', 'city', 'state'];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
                $errors[$field] = ucfirst($field) . " is required";
            }

            if ($field === 'email' && !Validation::email($updateValues[$field])) {
                $errors[$field] = "Invalid email address";
            }
        }

        if (!empty($errors)) {
            loadView('listings/edit', [
                'errors' => $errors,
                'listing' => $listing,
            ]);
            exit;
        } else {
            // Submit the form
            $updateFields = [];
            foreach (array_keys($updateValues) as $field) {
                $updateFields[] = "{$field} = :{$field}";
            }

            $updateFields = implode(', ', $updateFields);

            $updateQuery = "UPDATE listings SET {$updateFields} WHERE id = :id";

            $updateValues['id'] = $id;
            $this->db->query($updateQuery, $updateValues);

            //Set flash message
            Session::setFlashMessage('success_message', 'Listing updated successfully');

            redirect('/listings/' . $id);
        }
    }
}
