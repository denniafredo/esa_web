@php
    $route = Route::current()->uri();
    $segments = explode('/', $route);
    $segment = $segments[0];
@endphp
<div class="left_navi">
    <div class="left_title">
        @if($segment == 'dashboard' OR $segment == '')
            <img src="{{ asset('images/left_title_company.jpg') }}">
        @elseif($segment == 'productweb')
            <img src="{{ asset('images/left_title_product.jpg') }}">
        @elseif($segment == 'customer')
            <img src="{{ asset('images/left_title_customer.jpg') }}">
        @endif
        <div class="left_sub">
            <ul>
                @if($segment == 'dashboard' OR $segment == '')
                    @foreach($companyProfiles as $cp)
                        <li>
                            <a href="{{ route('dashboard.show', $cp->id) }}">{{ $locale == 'en' ? $cp->contentName : $cp->namaKonten }}</a>
                        </li>
                    @endforeach
                @elseif($segment == 'productweb')
                    @if(request('brand') != null AND request('searchProduct') == null)
                        <li>
                            <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->query(), ['category' => null])) }}">
                                {{ App::getLocale() == 'en' ? 'All Category' : "Semua Category" }}
                            </a>
                        </li>
                        @foreach($selectedBrand->categories as $category)
                            <li>
                                <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->query(), ['category' => $category->id])) }}">
                                    {{ App::getLocale() == 'en' ? $category->name : $category->nama }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                @elseif($segment == 'customer')
                    <li><a href="#head-office">{{ __('HEAD OFFICE') }}</a></li>
                    <li><a href="https://forms.gle/4KAZzDsZb3vWxEyLA" target="_blank">{{ __('BIZPART') }}</a></li>
                    <li><a href="#sales-executive">{{ __('SALES EXECUTIVE') }}</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
