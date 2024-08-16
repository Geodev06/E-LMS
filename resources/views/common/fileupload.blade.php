<!-- font -->
<link href="{{ asset('fileuploader/dist/font/font-fileuploader.css') }}" media="all" rel="stylesheet">

<!-- css -->
<link href="{{ asset('fileuploader/dist/jquery.fileuploader.min.css') }}" media="all" rel="stylesheet">

<!-- js -->
<script src="{{ asset('fileuploader/dist/jquery.fileuploader.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('input.files').fileuploader({
            limit: 1,

    
        });

        const formGroups = document.querySelectorAll('.file-input-container');

        // Iterate through each formGroup
        formGroups.forEach(formGroup => {
            // Iterate through the child nodes of the current formGroup
            formGroup.childNodes.forEach(node => {
                if (node.nodeType === Node.TEXT_NODE) {
                    // Check if the text node matches the text you want to remove
                    if (node.textContent.includes("© innostudio.de • Fileuploader")) {
                        node.remove(); // Remove the matching text node
                    }
                }
            });
        });
    });
</script>