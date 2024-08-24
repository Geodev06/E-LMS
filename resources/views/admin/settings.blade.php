@extends('admin.index')


@section('content')
<div class=" col-lg-12 mt-5">
    <div class="card">
        <div class="card-body">
            
            <div class="d-md-flex mt-5">
                <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="v-pills-site-settings-tab" data-toggle="pill" href="#v-pills-site-settings" role="tab" aria-controls="v-pills-site-settings" aria-selected="true" data-tab="site-settings">Site Settings</a>
                    <a class="nav-link" id="v-pills-audit-trail-tab" data-toggle="pill" href="#v-pills-audit-trail" role="tab" aria-controls="v-pills-audit-trail" aria-selected="false" data-tab="audit-trail">Audit Trail</a>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade" id="v-pills-site-settings" role="tabpanel" aria-labelledby="v-pills-site-settings-tab">
                        <div id="setting_view" class="container">
                            <!-- Site Settings Content -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-audit-trail" role="tabpanel" aria-labelledby="v-pills-audit-trail-tab">
                        <div id="audit_trail_view" class="container">
                            <!-- Audit Trail Content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('common.datatables')

<script src="{{ asset('settings/settings.js') }}"></script>

@endsection