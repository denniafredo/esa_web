@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <div class="content_desc">
        <div class="content_title">
            <div class="sub_title">
                <p>BASIC CARE ITEM LIST</p>
            </div>
            <div class="sub_navi">
                <p><img src="{{asset('images/navi_home.png')}}">> BASIC CARE </p>
            </div>
        </div>
        <ul class="sct sct_10">
            @for ($i = 0; $i < 10; $i++)
                <li class="sct_li sct_clear" style="width:250px">
                    <div class="sct_img"><a href="#" class="sct_a">
                            <img src="{{asset('images/product1.jpg')}}" width="250" height="220"
                                 alt="The odbo Renovating AntiWrinkle ORB cream">
                        </a></div>
                    <div class="sct_icon"><span class="sit_icon">
                        <img src="{{asset('images/icon_soldout.gif')}}" alt="품절">
                        <img src="{{asset('images/icon_rec.gif')}}" alt="추천상품">
                    </span></div>
                    <div class="sct_txt"><a href="#" class="sct_a">
                            The odbo Renovating AntiWrinkle ORB cream
                        </a></div>
                    <div class="sct_cost">
                        $ 0
                    </div>
                    <div class="sct_sns" style="top:230px"></div>
                </li>
            @endfor
        </ul>
    </div>
@endsection
