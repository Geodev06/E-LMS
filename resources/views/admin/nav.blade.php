<style>
    .active-link {
        color: white !important;
    }
</style>
<nav>
    <ul class="metismenu" id="menu">
        <li class="">
            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
            <ul class="collapse">
                <li><a href="index.html">ICO dashboard</a></li>
                <li><a href="index2.html">Ecommerce dashboard</a></li>
                <li class="active"><a href="index3.html">SEO dashboard</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Sidebar
                    Types
                </span></a>
            <ul class="collapse">
                <li><a href="index.html">Left Sidebar</a></li>
                <li><a href="index3-horizontalmenu.html">Horizontal Sidebar</a></li>
            </ul>
        </li>
        <li><a href="{{ route('admin.settings') }}" class="{{ Route::is('admin.settings') ? 'active-link' : '' }}"><i class="ti-settings {{ Route::is('admin.settings') ? 'active-link' : '' }}"></i> <span>Settings</span></a></li>
        
    </ul>
</nav>