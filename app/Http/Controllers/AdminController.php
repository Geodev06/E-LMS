<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Http\Requests\SitesettingRequest;
use App\Models\Audit_trail;
use App\Models\Systemsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

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
            'site_name' => Systemsetting::where('key', Constants::SYSTEM_NAME)->value('value'),
            'site_logo' => Systemsetting::where('key', Constants::SYSTEM_LOGO)->value('value'),
            'site_banner' => Systemsetting::where('key', Constants::SYSTEM_BANNER)->value('value'),

        ];

        return $this->jsonViewResponse('admin.site_settings', $data);
    }

    public function audit_trail()
    {

        $data = [];

        return $this->jsonViewResponse('admin.audit_trail', $data);
    }

    public function site_settings_save(SitesettingRequest $request)
    {
        try {

            if ($request->hasFile('site_logo')) {

                DB::beginTransaction();
                // Get the uploaded file
                $file_logo = $request->file('site_logo');
                $file_banner = $request->file('site_banner');


                // Generate a unique filename with the original extension
                $filename_logo = time() . '-' . $file_logo->getClientOriginalName();
                $filename_banner = time() . '-' . $file_banner->getClientOriginalName();

                // Define the target directory in the public folder
                $destinationPath = public_path('uploads');

                // Create the directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                // Get the old file paths from the system settings
                $oldLogoPath = public_path(Systemsetting::where('key', Constants::SYSTEM_LOGO)->value('value'));
                $oldBannerPath = public_path(Systemsetting::where('key', Constants::SYSTEM_BANNER)->value('value'));
                $oldSystemname = Systemsetting::where('key', Constants::SYSTEM_NAME)->value('value');


                // Delete old logo if it exists
                if (File::exists($oldLogoPath) && $oldLogoPath !== public_path('uploads/' . $filename_logo)) {
                    File::delete($oldLogoPath);
                }

                // Delete old banner if it exists
                if (File::exists($oldBannerPath) && $oldBannerPath !== public_path('uploads/' . $filename_banner)) {
                    File::delete($oldBannerPath);
                }

                // Move the new files to the public/uploads directory
                $file_logo->move($destinationPath, $filename_logo);
                $file_banner->move($destinationPath, $filename_banner);

                // Update or create settings for logo and banner
                Systemsetting::updateOrCreate(
                    ['key' => Constants::SYSTEM_LOGO],
                    [
                        'value' => 'uploads/' . $filename_logo,
                    ]
                );

                Systemsetting::updateOrCreate(
                    ['key' => Constants::SYSTEM_BANNER],
                    [
                        'value' => 'uploads/' . $filename_banner,
                    ]
                );

                // Update or create settings for system name
                Systemsetting::updateOrCreate(
                    ['key' => Constants::SYSTEM_NAME],
                    [
                        'value' => $request->site_name,
                    ]
                );

                Audit_trail::create([
                    'content' => 'Change System name',
                    'activity' => !empty($oldSystemname) ? Constants::AUDIT_UPDATE : Constants::AUDIT_INSERT,
                    'prev_value' => !empty($oldSystemname) ? $oldSystemname : null,
                    'current_value' => $request->site_name,
                    'created_by' => Auth::user()->id,
                ]);

                Audit_trail::create([
                    'content' => 'Change System logo',
                    'activity' => !empty($oldLogoPath) ? Constants::AUDIT_UPDATE : Constants::AUDIT_INSERT,
                    'prev_value' => !empty($oldLogoPath) ? $oldLogoPath : null,
                    'current_value' => 'uploads/' . $filename_logo,
                    'created_by' => Auth::user()->id,
                ]);

                Audit_trail::create([
                    'content' => 'Change System banner',
                    'activity' => !empty($oldBannerPath) ? Constants::AUDIT_UPDATE : Constants::AUDIT_INSERT,
                    'prev_value' => !empty($oldBannerPath) ? $oldBannerPath : null,
                    'current_value' => 'uploads/' . $filename_banner,
                    'created_by' => Auth::user()->id,
                ]);

                DB::commit();

                return response()->json([
                    'status' => 200,
                    'message' => Constants::SAVE_CHANGES,
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function audit_trail_get(Request $request)
    {

        if ($request->ajax()) {
            // Define the query as a plain string
            $query = "
                SELECT 
                    A.id,
                    A.activity,
                    A.content,
                    A.prev_value,
                    A.current_value,
                    A.created_at,
                    B.email AS created_by
                FROM audit_trails A
                JOIN users B ON B.id = A.created_by
                ORDER BY A.created_at DESC
            ";

            // Execute the raw SQL query
            $data = DB::select($query);

            // Pass the data to DataTables
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    // Customize the action column with buttons or links
                    $btn_view = '<div class="icon-container text-center">
                                    <span class="ti-eye"></span><span class="icon-name"></span>
                                </div>';
                    return $btn_view;
                })

                ->addColumn('activity', function ($data) {
                    // Customize the action column with buttons or links
                    $activity = '';

                    if ($data->activity == 'AUDIT_INSERT') {
                        $activity = '<div class="text-center text-success">
                                        <span>AUDIT INSERT</span>
                                    </div>';
                    }

                    if ($data->activity == 'AUDIT_UPDATE') {
                        $activity = '<div class="text-center text-info">
                                        <span>AUDIT UPDATE</span>
                                    </div>';
                    }

                    if ($data->activity == 'AUDIT_DELETE') {
                        $activity = '<div class="text-center text-danger">
                                        <span>AUDIT DELETE</span>
                                    </div>';
                    }
                    return $activity;
                })
                ->rawColumns(['action','activity']) // Specify which columns contain raw HTML
                ->make(true);
        }
    }
}
