<header class="header__section">
    <div class="header__topbar bg__primary">
        <div class="container">
            <div class="header__topbar--inner style6 d-flex align-items-center justify-content-between">
                <ul class="header__topbar--info d-none d-lg-flex">
                    <li class="header__info--text text-white">
                        PT ESA SEMARAK ABADI
                    </li>
                    <li class="header__info--text text-white">
                        <span class="text__secondary">{{ __('CALL US') }}</span>
                        <a href="tel:+02983530333">: 02983530333</a>
                    </li>
                </ul>
                <div class="header__top--right d-flex align-items-center">
                    <ul class="language__currency d-flex align-items-center">
                        <li class="language__currency--list">
                            <a class="language__currency--link language__switcher" href="javascript:void(0)">
                                @if(App::getLocale() == 'en')
                                    <span> <img src="{{ asset('images/en.png') }}"
                                                alt="{{ __('English') }}"></span>
                                @else
                                    <span><img src="{{ asset('images/in.png') }}"
                                               alt="{{ __('Indonesian') }}"></span>
                                @endif
                                <svg xmlns="http://www.w3.org/2000/svg" width="9.797" height="6.05"
                                     viewBox="0 0 9.797 6.05">
                                    <path d="M14.646,8.59,10.9,12.329,7.151,8.59,6,9.741l4.9,4.9,4.9-4.9Z"
                                          transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                </svg>
                            </a>
                            <div class="dropdown__switcher dropdown__language">
                                <ul>
                                    <li class="dropdown__switcher--items">
                                        <a class="dropdown__switcher--text"
                                           href="{{ App::getLocale() == 'en' ? url('language/in') : url('language/en') }}">
                                            @if(App::getLocale() == 'in')
                                                <span> <img src="{{ asset('images/en.png') }}"
                                                            alt="{{ __('English') }}"></span>
                                            @else
                                                <span><img src="{{ asset('images/in.png') }}"
                                                           alt="{{ __('Indonesian') }}"></span>
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main__header position__relative header__sticky">
        <div class="container">
            <div class="main__header--inner d-flex justify-content-between align-items-center">
                <div class="offcanvas__header--menu__open ">
                    <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg"
                             viewBox="0 0 512 512">
                            <path fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                  stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352"/>
                        </svg>
                        <span class="visually-hidden">Offcanvas Menu Open</span>
                    </a>
                </div>
                <div class="main__logo">
                    <h1 class="main__logo--title"><a class="main__logo--link" href="{{url('/')}}">
                            <img class="main__logo--img" src="{{asset('images/top_logo.png')}}" width="95px"
                                 alt="logo-img">
                        </a></h1>
                </div>
                <div class="header__menu d-none d-lg-block">
                    <nav class="header__menu--navigation">
                        <ul class="header__menu--wrapper d-flex">
                            <li class="header__menu--items">
                                <a class="header__menu--link {{ Request::is('dashboard*') ? 'active' : '' }}"
                                   href="#">{{ __('COMPANY INFO') }}
                                    <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12"
                                         height="7.41" viewBox="0 0 12 7.41">
                                        <path d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z"
                                              transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                    </svg>
                                </a>
                                <ul class="header__sub--menu">
                                    @foreach($companyProfiles as $cp)
                                        <li class="header__sub--menu__items">
                                            <a href="{{ route('dashboard.show', $cp->id) }}"
                                               class="header__sub--menu__link">{{ App::getLocale() == 'en' ? $cp->contentName : $cp->namaKonten }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li class="header__menu--items">
                                <a class="header__menu--link {{ Request::is('productweb*') ? 'active' : '' }}"
                                   href="{{url('productweb')}}">{{ __('PRODUCT INFO') }}</a>
                            </li>
                            <li class="header__menu--items">
                                <a class="header__menu--link {{ Request::is('articleweb*') ? 'active' : '' }}"
                                   href="{{ url('articleweb') }}">{{ __('PRIVATE LABEL') }}</a>
                            </li>
                            <li class="header__menu--items">
                                <a class="header__menu--link {{ Request::is('customer*') ? 'active' : '' }}"
                                   href="#">{{ __('CUSTOMER CENTER') }}
                                    <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12"
                                         height="7.41" viewBox="0 0 12 7.41">
                                        <path d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z"
                                              transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                    </svg>
                                </a>
                                <ul class="header__sub--menu">
                                    <li class="header__sub--menu__items">
                                        <a href="{{ url('customer#head-office') }}"
                                           class="header__sub--menu__link">{{__('BRANCHES')}}</a>
                                    </li>
                                    <li class="header__sub--menu__items">
                                        <a href="{{$about->bizpartLink}}" class="header__sub--menu__link"
                                           target="_blank">BIZPART</a>
                                    </li>
                                    <li class="header__sub--menu__items">
                                        <a href="{{ url('customer#sales-executive') }}" class="header__sub--menu__link">SALES
                                            EXECUTIVE</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Offcanvas header menu -->
    <div class="offcanvas__header">
        <div class="offcanvas__inner">
            <div class="offcanvas__logo">
                <a class="offcanvas__logo_link" href="index.html">
                    <img src="{{asset('images/top_logo.png')}}" alt="Logo-img" width="158" height="36">
                </a>
                <button class="offcanvas__close--btn" data-offcanvas>close</button>
            </div>
            <nav class="offcanvas__menu">
                <ul class="offcanvas__menu_ul">
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item">{{ __('COMPANY INFO') }}</a>
                        <ul class="offcanvas__sub_menu">
                            @foreach($companyProfiles as $cp)
                                <li class="offcanvas__sub_menu_li">
                                    <a href="{{ route('dashboard.show', $cp->id) }}" class="offcanvas__sub_menu_item">
                                        {{ App::getLocale() == 'en' ? $cp->contentName : $cp->namaKonten }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{url('productweb')}}">{{ __('PRODUCT INFO') }}</a>
                    </li>
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{url('articleweb')}}">{{ __('PRIVATE LABEL') }}</a>
                    </li>
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item">{{ __('CUSTOMER CENTER') }}</a>
                        <ul class="offcanvas__sub_menu">
                            <li class="offcanvas__sub_menu_li">
                                <a href="{{ url('customer#head-office') }}" class="offcanvas__sub_menu_item">
                                    {{__('BRANCHES')}}
                                </a>
                            </li>
                            <li class="offcanvas__sub_menu_li">
                                <a href="{{$about->bizpartLink}}" class="offcanvas__sub_menu_item">
                                    BIZPART
                                </a>
                            </li>
                            <li class="offcanvas__sub_menu_li">
                                <a href="{{ url('customer#sales-executive') }}" class="offcanvas__sub_menu_item">
                                    SALES EXECUTIVE
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>