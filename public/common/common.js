function sendAjaxRequest(url, method, data, beforeCallBack = NULL, successCallback, errorCallback) {
    $.ajax({
        url: url,
        type: method, // 'GET', 'POST', etc.
        data: data,
        dataType: 'json', // or 'html', 'text', etc., depending on your response type
        beforeSend: function(response) {
            if (typeof beforeCallBack === 'function') {
                beforeCallBack();
            }
        },
        success: function(response) {
            if (typeof successCallback === 'function') {
                successCallback(response);
            }
        },
        error: function(xhr, status, error) {
            if (typeof errorCallback === 'function') {
                errorCallback(xhr, status, error);
            }
        }
    });
}

function fileUploadRequest(url, formData, onSuccess, onError) {
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
           

            if (typeof onSuccess === 'function') {
                onSuccess(response);

                window.open(response.file_url)
            }
        },
        error: function(response) {
         

            if (typeof onError === 'function') {
                onError(response);
            }
        }
    });
}

