 <div class="header-dashboard">
                <div class="wrap">
                    <div class="header-left">
                        <a href="#" class="logo">
                            <img src="https://placehold.co/154x52/3b82f6/ffffff?text=Logo" alt="logo">
                        </a>
                        <div class="button-show-hide" id="sidebarToggle" style="display: none;">
                            <i class="fas fa-bars"></i>
                        </div>

                        <form class="form-search flex-grow" onsubmit="return false;">
                            <fieldset class="name">
                                <input type="text" placeholder="ابحث في الصلاحيات..." class="show-search" id="liveSearchInput" name="name" value="" autocomplete="off">
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="header-grid">
                        <!-- notifications -->
                        <div class="popup-wrap message type-header">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownNotif" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="header-item">
                                        <span class="text-tiny">1</span>
                                        <i class="fas fa-bell"></i>
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownNotif">
                                    <li><h6 class="dropdown-header">الإشعارات</h6></li>
                                    <li><a class="dropdown-item" href="#">خصم متاح</a></li>
                                    <li><a class="dropdown-item" href="#">تم التحقق من الحساب</a></li>
                                    <li><a class="dropdown-item" href="#">تم شحن الطلب بنجاح</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-center" href="#">عرض الكل</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- user -->
                        <div class="popup-wrap user type-header">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="header-user wg-user">
                                        <span class="image">أ</span>
                                        <span class="flex flex-column">
                                            <span class="body-title mb-2">أحمد محمد</span>
                                            <span class="text-tiny">مدير النظام</span>
                                        </span>
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <li><a class="user-item" href="#"><div class="icon"><i class="fas fa-user"></i></div><div class="body-title-2">الحساب</div></a></li>
                                    <li><a class="user-item" href="#"><div class="icon"><i class="fas fa-envelope"></i></div><div class="body-title-2">صندوق الوارد</div><div class="number">27</div></a></li>
                                    <li><a class="user-item" href="#"><div class="icon"><i class="fas fa-tasks"></i></div><div class="body-title-2">لوحة المهام</div></a></li>
                                    <li><a class="user-item" href="#"><div class="icon"><i class="fas fa-headset"></i></div><div class="body-title-2">الدعم</div></a></li>
                                    <li><hr class="dropdown-divider"></li>
                                   <form method="POST" action="{{ route('logout') }}" id="logout-form">
    @csrf

    <a href="{{ route('logout') }}"
       class="user-item"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

        <div class="icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>

        <div class="body-title-2">تسجيل الخروج</div>
    </a>
</form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>