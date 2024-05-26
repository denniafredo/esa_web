@php
    $route = Route::current()->uri();
    $segments = explode('/', $route);
    $segment = $segments[0];
@endphp
<div class="left_navi">
    <div class="left_title">
        @if($segment == 'dashboard')
            <img src="{{ asset('images/left_title_company.jpg') }}">
        @elseif($segment == 'product')
            <img src="{{ asset('images/left_title_product.jpg') }}">
        @elseif($segment == 'customer')
            <img src="{{ asset('images/left_title_customer.jpg') }}">
        @endif
        <div class="left_sub">
            <ul>
                @if($segment == 'dashboard')
                    @foreach($companyProfiles as $cp)
                        <li>
                            <a href="{{ route('dashboard.show', $cp->id) }}">{{ $locale == 'en' ? $cp->contentName : $cp->namaKonten }}</a>
                        </li>
                    @endforeach
                @elseif($segment == 'product')
                    <li><a href="#basic_line">{{ __('BASIC LINE') }}</a></li>
                    <li><a href="#functionality">{{ __('FUNCTIONALITY') }}</a></li>
                    <li><a href="#sun_care">{{ __('SUN CARE') }}</a></li>
                    <li><a href="#cleansing">{{ __('CLEANSING') }}</a></li>
                @elseif($segment == 'customer')
                    <li><a href="#notice">{{ __('NOTICE') }}</a></li>
                    <li><a href="#qna">{{ __('Q&A') }}</a></li>
                    <li><a href="#my_order">{{ __('MY ORDER') }}</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
