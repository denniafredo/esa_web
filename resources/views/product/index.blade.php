@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <style>
        .widget__tagcloud--link.active {
            background-color: #C97F5F;
            color: #fff; /* Optionally, change text color for better contrast */
        }

    </style>
    <main class="main__content_wrapper">
        <div class="shop__section section--padding pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 shop-col-width-lg-4">
                        <div class="shop__sidebar--widget widget__area d-none d-lg-block">
                            <div class="single__widget widget__bg">
                                <h2 class="widget__title h3">{{__('Brand')}}</h2>
                                <ul class="widget__tagcloud">
                                    <li class="widget__tagcloud--list">
                                        <a class="widget__tagcloud--link @if( !request('brand')) active @endif"
                                           href="?">
                                            {{__('All')}}
                                        </a>
                                    </li>
                                    @foreach($brands as $brand)
                                        <li class="widget__tagcloud--list">
                                            <a class="widget__tagcloud--link @if($brand->id == request('brand')) active @endif"
                                               href="?brand={{ $brand->id }}">
                                                {{ $brand->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <br>
                        @if(request('brand'))
                            <div class="shop__sidebar--widget widget__area d-none d-lg-block">
                                <div class="single__widget widget__bg">
                                    <h2 class="widget__title h3">{{__('Categories')}}</h2>
                                    <ul class="widget__tagcloud">
                                        <li class="widget__tagcloud--list">
                                            <a class="widget__tagcloud--link @if( !request('category')) active @endif"
                                               href="?brand={{ request('brand') }}">
                                                {{__('All')}}
                                            </a>
                                        </li>
                                        @foreach($brands as $brand)
                                            @if($brand->id == request('brand'))
                                                @foreach($brand->categories as $category)
                                                    <li class="widget__tagcloud--list">
                                                        <a class="widget__tagcloud--link @if($category->id == request('category')) active @endif"
                                                           href="?brand={{ request('brand') }}&category={{ $category->id }}">
                                                            {{App::getLocale()=='en'? $category->name:$category->nama}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
                        <div class="shop__product--wrapper position__sticky">
                            <div class="shop__header d-flex align-items-center justify-content-between mb-30">
                                <div class="product__view--mode d-flex align-items-center">
                                    <button class="widget__filter--btn d-flex d-lg-none align-items-center"
                                            data-offcanvas="">
                                        <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                  stroke-linejoin="round" stroke-width="28"
                                                  d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80"></path>
                                            <circle cx="336" cy="128" r="28" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="28"></circle>
                                            <circle cx="176" cy="256" r="28" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="28"></circle>
                                            <circle cx="336" cy="384" r="28" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="28"></circle>
                                        </svg>
                                        <span class="widget__filter--btn__text">Filter</span>
                                    </button>
                                    <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                        <form class="newsletter__subscribe--form"
                                              action="{{ route('productweb.index') }}" method="GET">
                                            <label>
                                                <input class="newsletter__subscribe--input"
                                                       placeholder="Enter Product name" name="searchProduct" type="text"
                                                       style="padding: 0 200px 0 1rem">
                                            </label>
                                            <button class="newsletter__subscribe--button"
                                                    type="submit">{{__("Search Product")}}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_content">
                                <div id="product_grid" class="tab_pane active show">
                                    <div class="product__section--inner">
                                        <div class="row mb--n30">
                                            @foreach($products as $product)
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                                    <article class="product__card">
                                                        <div class="product__card--thumbnail">
                                                            <a class="product__card--thumbnail__link display-block"
                                                               href="{{route('productweb.show',$product->id)}}">
                                                                <img class="product__card--thumbnail__img product__primary--img"
                                                                     src="{{$product->image}}"
                                                                     alt="product-img">
                                                                <img class="product__card--thumbnail__img product__secondary--img"
                                                                     src="{{$product->image}}"
                                                                     alt="product-img">
                                                            </a>
                                                        </div>
                                                        <div class="product__card--content text-center">
                                                            <h3 class="product__card--title"><a
                                                                        href="{{route('productweb.show',$product->id)}}">{{App::getLocale() == 'en'? $product->name : $product->nama}} </a>
                                                            </h3>
                                                            <div class="product__card--price">
                                                                <span class="current__price"
                                                                      style="color: black;font-style: italic">{{ App::getLocale() == 'en' ? $product->categories->pluck('name')->implode(', ') : $product->categories->pluck('nama')->implode(', ')}}</span>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
