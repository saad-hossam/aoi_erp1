<div class="header-dashboard">
    <div class="wrap">
        <div class="header-left">
            <a href="{{ route('admin.index') }}" class="logo">
                <img class="" id="logo_header_mobile" alt=""
                    src="{{ asset('assets/dashboard') }}/images/logo/logo.png" data-light="images/logo/logo.png"
                    data-dark="images/logo/logo.png" data-width="154px" data-height="52px"
                    data-retina="images/logo/logo.png">
            </a>
            <div class="button-show-hide">
                <i class="icon-menu-left"></i>
            </div>


            <form class="form-search flex-grow">
                <fieldset class="name">
                    <input type="text" placeholder="ابحث هنا..." class="show-search" name="name" tabindex="2"
                        value="" aria-required="true" required="">
                </fieldset>
                <div class="button-submit">
                    <button class="" type="submit"><i class="icon-search"></i></button>
                </div>
                <div class="box-content-search" id="box-content-search">
                    <ul class="mb-24">
                        <li class="mb-14">
                            <div class="body-title">المنتجات الأكثر مبيعاً</div>
                        </li>
                        <li class="mb-14">
                            <div class="divider"></div>
                        </li>
                        <li>
                            <ul>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/dashboard') }}/images/products/17.png"
                                            alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">طعام الكلاب
                                                Rachael Ray Nutrish®</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/dashboard') }}/images/products/18.png"
                                            alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">طعام الكلاب
                                                الطبيعي طعام الكلاب الصحي</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/dashboard') }}/images/products/19.png"
                                            alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Freshpet
                                                طعام الكلاب والقطط الصحي</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="">
                        <li class="mb-14">
                            <div class="body-title">طلب المنتج</div>
                        </li>
                        <li class="mb-14">
                            <div class="divider"></div>
                        </li>
                        <li>
                            <ul>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/dashboard') }}/images/products/20.png"
                                            alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Sojos
                                                طبيعي مقرمش خالٍ من الحبوب...</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/dashboard') }}/images/products/21.png"
                                            alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">كريستين
                                                واتسون</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/dashboard') }}/images/products/22.png"
                                            alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">ميجا
                                                عظمة اليقطين</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="{{ asset('assets/dashboard') }}/images/products/23.png"
                                            alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">ميجا
                                                عظمة اليقطين</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </form>

        </div>
        <div class="header-grid">

            {{-- <div class="popup-wrap message type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-item">
                            <span class="text-tiny">1</span>
                            <i class="icon-bell"></i>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton2">
                        <li>
                            <h6>الإشعارات</h6>
                        </li>
                        <li>
                            <div class="message-item item-1">
                                <div class="image">
                                    <i class="icon-noti-1"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">خصم متاح</div>
                                    <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus
                                        at, ullamcorper nec diam</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-2">
                                <div class="image">
                                    <i class="icon-noti-2"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">تم التحقق من الحساب</div>
                                    <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus
                                        et</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-3">
                                <div class="image">
                                    <i class="icon-noti-3"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">تم شحن الطلب بنجاح</div>
                                    <div class="text-tiny">Integer aliquam eros nec sollicitudin
                                        sollicitudin</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-4">
                                <div class="image">
                                    <i class="icon-noti-4"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">الطلب معلق: <span>ID 305830</span>
                                    </div>
                                    <div class="text-tiny">Ultricies at rhoncus at ullamcorper</div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#" class="tf-button w-full">عرض الكل</a></li>
                    </ul>
                </div>
            </div> --}}




            <div class="popup-wrap user type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-user wg-user">
                            <span class="image">
                                {{-- <img src="{{ asset('assets/dashboard') }}/images/avatar/user-1.png" alt=""> --}}
                            </span>
                            <span class="flex flex-column">
                                <span class="body-title mb-2">{{ Auth::user()->name }}</span>
<span class="text-tiny">
    {{ Auth::user()->roles->first()?->name ?? 'لا يوجد دور' }}
</span>                            </span>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="body-title-2">الحساب</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-mail"></i>
                                </div>
                                <div class="body-title-2">صندوق الوارد</div>
                                <div class="number">27</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-file-text"></i>
                                </div>
                                <div class="body-title-2">لوحة المهام</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-headphones"></i>
                                </div>
                                <div class="body-title-2">الدعم</div>
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a href="{{ route('logout') }}" class="user-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="icon">
                                        <i class="icon-log-out"></i>
                                    </div>
                                    <div class="body-title-2">تسجيل الخروج</div>
                                </a>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>