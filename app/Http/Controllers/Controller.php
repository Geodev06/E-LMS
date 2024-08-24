<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Audit_trail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
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


    /**
     * Insert audit
     *
     * @param array $fields
     */
    public function audit_log($fields)
    {

        try {
            $user = Auth::user();
            Audit_trail::create([
                'content' => $fields['content'],
                'activity' => $fields['activity'],
                'prev_value' => $fields['prev_value'],
                'current_value' => $fields['current_value'],
                'created_by' => $user->id,
            ]);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
