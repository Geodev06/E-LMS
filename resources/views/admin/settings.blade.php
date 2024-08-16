@extends('admin.index')


@section('content')
<div class=" col-lg-12 mt-5">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="header-title mb-0">Settings</h4>

            </div>
            <div class="d-md-flex mt-5">
                <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-site-settings-tab" data-toggle="pill" href="#v-pills-site-settings" role="tab" aria-controls="v-pills-site-settings" aria-selected="true">Site Settings</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Audit Trail</a>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-site-settings" role="tabpanel" aria-labelledby="v-pills-site-settings-tab">

                        <div id="setting_view" class="container">

                        </div>

                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div id="setting_view" class="container">

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('settings/settings.js') }}"></script>
@endsection