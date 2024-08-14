
$(document).ready(function () {

    $('#register_form').on('submit', function (e) {

        e.preventDefault()

        $('.text-danger').text('');


        element_loading('#form_submit')


        function before() {
        }

        function success(res) {
            stop_element_loading('#form_submit')

            if (res.status == 200) {
                showNotification('success', res.msg)

                setTimeout(()=> {
                    window.location.href = "/login"
                },3000)
            }
        }

        function error(err) {
            stop_element_loading('#form_submit')

            if (err.responseJSON && err.responseJSON.errors) {
                $.each(err.responseJSON.errors, function (key, value) {
                    $('.err_' + key).text(value[0]);
                });
            }

            if (err.status == 500) {
                showNotification('alert', err.statusText)
            }

        }

        let formArray = $(this).serializeArray();
        let dataObject = {};

        formArray.forEach(function (item) {
            dataObject[item.name] = item.value;
        });

        sendAjaxRequest("/user-store", 'post', dataObject, before, success, error)
    })



    $('#login_form').on('submit', function (e) {

        e.preventDefault()

        $('.text-danger').text('');


        element_loading('#form_submit')


        function before() {
        }

        function success(res) {
            stop_element_loading('#form_submit')
            if(res) {
                window.location.replace(res.link)
            }

        }

        function error(err) {
            stop_element_loading('#form_submit')


            if (err.status == 401) {
                showNotification('alert', err.responseJSON)
            }

        }

        let formArray = $(this).serializeArray();
        let dataObject = {};

        formArray.forEach(function (item) {
            dataObject[item.name] = item.value;
        });

        sendAjaxRequest("/user-authenticate", 'post', dataObject, before, success, error)
    })
})