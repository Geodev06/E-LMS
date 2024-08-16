<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

      
    /**
     * Return a JSON response containing a view and its data.
     *
     * @param string $viewName
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonViewResponse(string $viewName, array $data = [])
    {
        // Render the view with the data
        $view = View::make($viewName, $data)->render();

        // Return the JSON response
        return response()->json([
            'html' => $view,
            'data' => $data,
        ]);
    }
}
