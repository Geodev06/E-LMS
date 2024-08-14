<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<style>

</style>

<script>
    const loading_body = () => {
        $.LoadingOverlay("show");

    }

    const stop_loading_body = () => {
        $.LoadingOverlay("hide");
    }

    const element_loading = (elem) => {
        $(elem).LoadingOverlay("show", {
            image: "{{ asset('assets/images/fading_blocks.gif') }}",
            imageAnimation: "", // String/Boolean
            imageAutoResize: false, // Boolean
            imageResizeFactor: 1, // Float
            imageColor: "", // String/Array/Boolean
            imageClass: "", // String/Boolean
            imageOrder: 1
        });
    }

    const stop_element_loading = (elem) => {
        $(elem).LoadingOverlay("hide", true);
    }
</script>