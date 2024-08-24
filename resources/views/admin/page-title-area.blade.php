<style>
    .avatar-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .box {
        width: 40px;
        height: 40px;
        /* Blue background color */
        color: #ffffff;
        background-color: dodgerblue;
        /* White text color */
        border-radius: 50%;
        /* Makes the box circular */
        display: flex;
        justify-content: center;
        margin-right: 20px;
        align-items: center;
        font-size: 24px;
        /* Font size of the initial */
        font-weight: bold;
        /* Bold text */
        text-transform: uppercase;
        /* Uppercase text */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Shadow for depth */
    }
</style>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">{{ $bread_main ?? '' }}</h4>
                <!-- <ul class="breadcrumbs pull-left">
                    <li>{{ $bread_sub ?? '' }}</li>
                </ul> -->
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <div class="avatar-container">
                    <div class="box">
                        @if(Auth::check())
                        {{ Auth::user()->name[0] ?? '' }}
                        @endif
                    </div>
                </div>
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                    @if(Auth::check())
                    {{ Auth::user()->name ?? '' }}
                    @endif
                    <i class="fa fa-angle-down"></i>
                </h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Message</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <button class="dropdown-item" id="btn_logout">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>