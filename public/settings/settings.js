
$(document).ready(function () {

    load_site_settings()

    $('#v-pills-site-settings-tab').click(function () {
        load_site_settings()

    })

    function load_site_settings() {

        loading_body()

        function success(res) {
            stop_loading_body()

            $('#setting_view').html(res.html)
        }

        function error(err) {
            stop_loading_body()

        }


        sendAjaxRequest("/admin/site-settings", 'get', {}, null, success, error)
    }




})