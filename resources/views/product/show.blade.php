@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <main class="main__content_wrapper">

        <!-- Start product details section -->
        <section class="product__details--section section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details--media">
                            <div class="single__product--preview bg__gray  swiper mb-18">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="product__media--preview__items">
                                            <a class="product__media--preview__items--link glightbox"
                                               data-gallery="product-media-preview"
                                               href="{{$product->image}}"><img
                                                        class="product__media--preview__items--img"
                                                        src="{{$product->image}}"
                                                        alt="product-media-img"></a>
                                            <div class="product__media--view__icon">
                                                <a class="product__media--view__icon--link glightbox"
                                                   href="{{$product->image}}"
                                                   data-gallery="product-media-preview">
                                                    <svg class="product__items--action__btn--svg"
                                                         xmlns="http://www.w3.org/2000/svg" width="22.51"
                                                         height="22.443" viewBox="0 0 512 512">
                                                        <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                              fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                              stroke-width="32"></path>
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                              stroke-miterlimit="10" stroke-width="32"
                                                              d="M338.29 338.29L448 448"></path>
                                                    </svg>
                                                    <span class="visually-hidden">product view</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details--info">
                            <form action="#">
                                <h2 class="product__details--info__title mb-15">{{App::getLocale() == 'en' ? $product->name : $product->nama}}</h2>
                                <div class="product__details--info__price mb-12">
                                    <span class="current__price"
                                          style="color: black;font-style: italic">{{$product->brand->name}}</span>
                                    <span>
                                        <ul class="widget__tagcloud">
                                            @foreach($product->brand->categories as $category)
                                                <li class="widget__tagcloud--list">
                                                        <a class="widget__tagcloud--link @if($category->id == request('category')) active @endif"
                                                           href="#">
                                                            {{App::getLocale()=='en'? $category->name:$category->nama}}
                                                        </a>
                                                    </li>
                                            @endforeach
                                        </ul>
                                    </span>
                                </div>
                                <p class="product__details--info__desc mb-15">
                                    {{App::getLocale()=='en'? $product->description : $product->deskripsi}}
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
