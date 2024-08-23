
$(document).ready(function () {



    $('#v-pills-site-settings-tab').click(function () {
        load_site_settings()

    })

    $('#v-pills-audit-trail-tab').click(function () {
        load_audit_trail()

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


    function load_audit_trail() {

        loading_body()

        function success(res) {
            stop_loading_body()

            $('#audit_trail_view').html(res.html)
        }

        function error(err) {
            stop_loading_body()

        }


        sendAjaxRequest("/admin/audit-trail", 'get', {}, null, success, error)
    }


    // Load the saved tab from localStorage
    var savedTab = localStorage.getItem('activeTab');

    switch (savedTab) {
        case 'site-settings':
            load_site_settings()
            break;

        case 'audit-trail':
            load_audit_trail()
            break;

        default:
            load_site_settings()
            break;
    }


    if (savedTab) {
        var tabToActivate = document.querySelector('[data-tab="' + savedTab + '"]');
        if (tabToActivate) {
            var tabContentId = tabToActivate.getAttribute('href').substring(1);
            document.querySelectorAll('.nav-link').forEach(function (link) {
                link.classList.remove('active');
            });
            document.querySelectorAll('.tab-pane').forEach(function (pane) {
                pane.classList.remove('show', 'active');
            });
            tabToActivate.classList.add('active');
            document.getElementById(tabContentId).classList.add('show', 'active');
        }
    } else {
        // If no savedTab, default to site-settings
        var defaultTab = document.querySelector('[data-tab="site-settings"]');
        if (defaultTab) {
            var defaultTabContentId = defaultTab.getAttribute('href').substring(1);
            defaultTab.classList.add('active');
            document.getElementById(defaultTabContentId).classList.add('show', 'active');
        }
    }

    // Save the selected tab to localStorage when a tab is clicked
    document.querySelectorAll('.nav-link').forEach(function (tab) {
        tab.addEventListener('click', function () {
            var selectedTab = this.getAttribute('data-tab');
            localStorage.setItem('activeTab', selectedTab);
        });
    });


})