@include('common.fileupload')

<div class="row">
    <div class="col-lg-12">
        <h4 class="header-title">Site Settings</h4>
    </div>

    <div class="col-lg-4">
        <form id="form_settings" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="col-form-label">Site Name</label>
                    <input class="form-control" type="text" name="site_name" placeholder="Enter Site Name" value="{{ $site_name ?? '' }}">
                    <div class="text-danger err_site_name"></div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group file-input-container">
                    <label class="col-form-label">Site Logo</label>
                    <input type="file" name="site_logo" class="files">
                    <div class="text-danger err_site_logo"></div>

                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group file-input-container">
                    <label class="col-form-label">Site Banner</label>
                    <input type="file" name="site_banner" class="files">
                    <div class="text-danger err_site_banner"></div>

                </div>
            </div>

            <div class="col-lg-12">
                <button type="submit" id="btn-submit" class="btn btn-rounded btn-primary w-50 mb-3">Save</button>
            </div>
        </form>
    </div>



    <div class="col-lg-4 col-md-6 mt-5">
        <div class="card card-bordered">
            @if($site_logo)
            <img class="card-img-top img-fluid" src="{{ asset($site_logo) }}" alt="image">
            @endif
            <div class="card-body">
                <h5 class="title">SITE LOGO</h5>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mt-5">
        <div class="card card-bordered">
            @if($site_banner)
            <img class="card-img-top img-fluid" src="{{ asset($site_banner) }}" alt="image">

            @endif
            <div class="card-body">
                <h5 class="title">SITE BANNER</h5>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('#form_settings').on('submit', function(e) {
            e.preventDefault();
            $('.text-danger').text('');

            // Show loading spinner or indicator
            loading_body();

            // Create a FormData object
            let formData = new FormData(this);

            function success(response) {
                stop_loading_body();
                // Handle successful response
                if (response.status == 200) {
                    showNotification('success', response.message);

                    $('#form_settings :input').prop('disabled', true);
                    setTimeout(() => {
                        window.location.reload()
                    }, 3000);
                }

            }

            function error(response) {
                stop_loading_body();
                // Handle error response
                if (response.status == 500) {
                    showNotification('warning', response.responseJSON.message);
                }
                // Optionally, display error messages
                let errors = response.responseJSON.errors;
                if (errors) {
                    Object.keys(errors).forEach(function(key) {
                        $(`.err_${key}`).text(errors[key][0]);
                    });
                }

            }

            fileUploadRequest("{{ route('admin.site_settings_save') }}", formData, success, error)
        });
    });
</script>