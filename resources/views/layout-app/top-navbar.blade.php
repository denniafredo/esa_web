<div id="wrap_header">
    <div class="wrap_hd">
        <div class="header_t">
            <ul>
                <li><a href="{{ url('language/en') }}"><img src="{{ asset('images/en.png') }}"
                                                            alt="{{ __('English') }}"></a></li>
                <li><a href="{{ url('language/in') }}"><img src="{{ asset('images/in.png') }}"
                                                            alt="{{ __('Indonesian') }}"></a></li>
            </ul>
            <div class="header_logo">
                <img src="{{asset('images/top_logo.png')}}">
            </div>
        </div>
        <div class="top_menu">
            <div class="top_navi">
                <a href="{{ url('dashboard') }}" class="{{ Request::is('dashboard*') ? 'nav_active' : '' }}"
                   style="color: white">{{ __('COMPANY INFO') }}</a>
                <a href="{{ url('productweb') }}" class="{{ Request::is('productweb*') ? 'nav_active' : '' }}"
                   style="color: white">{{ __('PRODUCT INFO') }}</a>
                <a href="{{ url('articleweb') }}" class="{{ Request::is('articleweb*') ? 'nav_active' : '' }}"
                   style="color: white">{{ __('PRODUCT LABELING') }}</a>
                <a href="{{ url('customer') }}" class="{{ Request::is('customer*') ? 'nav_active' : '' }}"
                   style="color: white">{{ __('CUSTOMER CENTER') }}</a>
            </div>
        </div>
    </div>
</div>