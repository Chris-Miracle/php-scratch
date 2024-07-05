<?php

namespace App\Controllers;


class ErrorController
{
    /**
     * Handles a 404 Not Found error by setting the HTTP response code and rendering the 'error' view with the specified message.
     *
     * @param string $message The error message to display, defaults to 'Resource not Found'.
     * @return void
     */
    public static function notFound($message = 'Resource not Found')
    {
        http_response_code(404);
        loadView('error', [
            'status' => '404',
            'message' => $message,
        ]);
    }

    /**
     * Handles a 403 Forbidden error by setting the HTTP response code and rendering the 'error' view with the specified message.
     *
     * @param string $message The error message to display, defaults to 'You are not authorized to view this resource'.
     * @return void
     */
    public static function unauthorized($message = 'You are not authorized to view this resource')
    {
        http_response_code(403);
        loadView('error', [
            'status' => '403',
            'message' => $message,
        ]);
    }
}
