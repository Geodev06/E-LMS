<?php

namespace App\Http\Controllers;

use App\Http\Requests\SitesettingRequest;

use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.index');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function site_settings()
    {

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ];

        return $this->jsonViewResponse('admin.site_settings', $data);
    }

    public function site_settings_save(SitesettingRequest $request)
    {
        if ($request->hasFile('site_logo')) {
            // Get the uploaded file
            $file = $request->file('site_logo');
    
            // Generate a unique filename with the original extension
            $filename = time() . '-' . $file->getClientOriginalName();
    
            // Save the file in the 'public/uploads' directory
            $path = $file->storeAs('public/uploads', $filename);

            return response()->json([
                'status' => 200,
                'message' => 'File uploaded successfully!',
                'filename' => $filename,
                'file_url' => "http://127.0.0.1:8000/storage/uploads/".$filename
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'No file uploaded.'
        ]);
    }
}
