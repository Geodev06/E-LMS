<link rel="stylesheet" href="assets/js/notif/style.css">
<!-- modernizr css -->
<script src="assets/js/notif/index.var.js"></script>

<script>
    function showNotification(type, message, duration = 5000) {
        const awn = new AWN({
            position: 'top-right' // Set the position to top right
        });
        if (awn[type]) {
            awn[type](message, {
                durations: {
                    [type]: duration
                }
            });
        } else {
            console.error(`Notification type "${type}" is not supported.`);
        }
    }
</script>