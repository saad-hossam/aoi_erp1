<div class="section-menu-left">
    <div class="box-logo"> <a href="{{ route('admin.index') }}" id="site-logo-inner"
            style="text-align: center; margin: 30px 50px"> <img class="" id="logo_header" alt=""
                src="{{ asset('assets/front/assets') }}/images/logo_ar.png" width="100" height="100"
                style="border-radius: 50%; margin:auto; display:block;" data-light="images/logo/logo.png"
                data-dark="{{ asset('assets/front/assets') }}/images/logo_ar.png"> </a>
        <div class="button-show-hide"> <i class="icon-menu-left"></i> </div>
    </div>
    <div class="center mt-5">
        <div class="center-item pt-5">
            {{-- <div class="center-heading">الرئيسية</div> --}}
            <ul class="menu-list pt-5">
                <li class="menu-item"> <a href="{{ route('admin.index') }}" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">لوحة التحكم</div>
                    </a> </li>
            </ul>
        </div>
        <div class="center-item">
            <ul class="menu-list">
                <li class="menu-item"> <a href="{{ route('emps.index') }}" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">المستخدمون</div>
                    </a> </li>
                <li class="menu-item"> <a href="{{ route('permissions.index') }}" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">الصلاحيات</div>
                    </a> </li>
                <li class="menu-item"> <a href="{{ route('roles.index') }}" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">الأدوار</div>
                    </a> </li>
                <li class="menu-item"> <a href="settings.html" class="">
                        <div class="icon"><i class="icon-settings"></i></div>
                        <div class="text">الإعدادات</div>
                    </a> </li>
            </ul>
        </div>
    </div>
</div>
