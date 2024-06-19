@php use Carbon\Carbon; @endphp
@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <main class="main__content_wrapper">
        <section class="blog__section section--padding">
            <div class="container">
                <div class="section__heading text-center  mb-40">
                    <h2 class="section__heading--maintitle">Articles</h2>
                </div>
                <div class="blog__section--inner">
                    <div class="row mb--n30">
                        @foreach($data as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6 mb-40">
                                <article class="blog__card">
                                    <div class="blog__card--thumbnail">
                                        <a class="blog__card--thumbnail__link"
                                           href="{{route('articleweb.show', $item->id)}}">
                                            <img class="blog__card--thumbnail__img" src="{{$item->coverImage}}"
                                                 alt="{{App::getLocale() == 'en' ? $item->contentName : $item->namaKonten}}">
                                        </a>
                                    </div>
                                    <div class="blog__card--content">
                                        <div class="blog__meta d-flex">
                                            <span class="blog__meta--text meta__date">{{Carbon::parse($item->created_at)->format('d M Y')}} </span>
                                        </div>
                                        <h3 class="blog__card--title"><a
                                                    href="{{route('articleweb.show', $item->id)}}">{{App::getLocale() == 'en' ? $item->contentName : $item->namaKonten}}</a>
                                        </h3>
                                        <a class="blog__card--link"
                                           href="{{route('articleweb.show', $item->id)}}">{{__('Read More')}}</a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination__area bg__gray--color">
                        <nav class="pagination justify-content-center">
                            <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
                                @if($currentPage>1)
                                    <li class="pagination__list">
                                        <a href="?page={{$currentPage-1}}" class="pagination__item--arrow  link ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                                                 viewBox="0 0 512 512">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="48"
                                                      d="M244 400L100 256l144-144M120 256h292"/>
                                            </svg>
                                            <span class="visually-hidden">page left arrow</span>
                                        </a>
                                    <li>
                                @endif
                                @for ($i = 1; $i <= $maxPages; $i++)
                                    @if ($i == 1 || $i == $maxPages || ($i >= $currentPage - 1 && $i <= $currentPage + 1))
                                        <li class="pagination__list">
                                            <a href="?page={{ $i }}"
                                               class="pagination__item {{ $i == $currentPage ? 'pagination__item--current' : 'link' }}">{{ $i }}</a>
                                        </li>
                                    @elseif ($i == 2 && $currentPage > 4)
                                        <li class="pagination__list">
                                            <span class="pagination__item">...</span>
                                        </li>
                                    @elseif ($i == $maxPages - 1 && $currentPage < $maxPages - 3)
                                        <li class="pagination__list">
                                            <span class="pagination__item">...</span>
                                        </li>
                                    @endif
                                @endfor
                                @if($currentPage!=$maxPages)
                                    <li class="pagination__list">
                                        <a href="?page={{$currentPage+1}}" class="pagination__item--arrow link ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                                                 viewBox="0 0 512 512">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="48"
                                                      d="M268 112l144 144-144 144M392 256H100"/>
                                            </svg>
                                            <span class="visually-hidden">page right arrow</span>
                                        </a>
                                    <li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
