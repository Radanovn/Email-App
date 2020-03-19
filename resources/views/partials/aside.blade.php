<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{ route('contacts.index') }}">
                <img alt="Logo" src="{{ asset('images/logo.svg') }}" style="max-width: 100%;" />
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item{{ Request::segment(1) == 'campaigns' ? ' kt-menu__item--here' : '' }}" aria-haspopup="true"><a href="{{ route('campaigns.index') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-multimedia-2"></i><span class="kt-menu__link-text">Кампании</span></a></li>
                <li class="kt-menu__item{{ Request::segment(1) == 'contacts' ? ' kt-menu__item--here' : '' }}" aria-haspopup="true"><a href="{{ route('contacts.index') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon-user"></i><span class="kt-menu__link-text">Контакти</span></a></li>
                <li class="kt-menu__item{{ Request::segment(1) == 'groups' ? ' kt-menu__item--here' : '' }}" aria-haspopup="true"><a href="{{ route('groups.index') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-group"></i><span class="kt-menu__link-text">Групи</span></a></li>
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->
