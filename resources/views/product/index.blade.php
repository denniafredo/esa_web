@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    @php
        $brandName = '';
        $categoryName = '';
    @endphp
    <style>
        #brandForm {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
    <div class="content_desc">
        <form id="brandForm" action="{{ route('productweb.index') }}" method="GET">
            <div class="custom-select-wrapper">
                <div class="custom-select">
                    <div class="custom-select-trigger">
                        <span>{{ App::getLocale() == 'en' ? 'Select a Brand' : 'Pilih Brand'}}</span>
                        <div class="arrow"></div>
                    </div>
                    <div class="custom-options">
                        <div class="custom-option" data-value="null">
                            {{ App::getLocale() == 'en' ? 'All Brand' : 'Semua Brand'}}
                        </div>
                        @foreach($brands as $brand)
                            <div class="custom-option {{ request('brand') == $brand->id ? 'selected' : '' }}"
                                 data-value="{{$brand->id}}">
                                <img src="{{$brand->image}}" alt="Option 1">
                                {{$brand->name}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <select name="brand" id="real-select" style="display: none;">
                @foreach($brands as $brand)
                    @php
                        if($brand->id == request('brand')){
                            $brandName = $brand->name;
                        }
                        foreach($brand->categories as $category){
                            if($category->id == request('category')){
                                if(App::getLocale() == 'en'){
                                    $categoryName = $category->name;
                                }else{
                                    $categoryName = $category->nama;
                                }
                            }
                        }
                    @endphp
                    <option value="{{$brand->id}}" {{$brand->id == request('brand') ? 'selected' : ''}}>{{$brand->name}}</option>
                @endforeach
            </select>
            <div class="top_search">
                <fieldset id="hd_sch">
                    <legend>Search</legend>
                    <input type="text" name="searchProduct" id="sch_stx" maxlength="20">
                    <input type="submit" id="sch_submit" value="">
                </fieldset>
            </div>
        </form>

        <div class="content_title">
            <div class="sub_title">
                <p>{{$brandName != null ? $brandName: (App::getLocale() == 'en' ? 'All Brand' : 'Semua Brand')}}</p>
            </div>
            <div class="sub_navi">
                <p>
                    <img src="{{asset('images/navi_home.png')}}">> {{$categoryName != null ? $categoryName: (App::getLocale() == 'en' ? 'All Category' : 'Semua Kategori')}}
                </p>
            </div>
        </div>
        <ul class="sct sct_10">
            @foreach($products as $product)
                <a href="{{route('productweb.show',$product->id)}}"
                   style="text-decoration: none;color: black">
                    <li class="sct_li sct_clear" style="width:250px">
                        <div class="sct_img">
                            <img src="{{$product->image}}" width="250" height="220"
                                 alt="The odbo Renovating AntiWrinkle ORB cream">
                        </div>
                        <div class="sct_txt">
                            {{ App::getLocale() == 'en' ? $product->name : $product->nama }}
                        </div>
                        <div class="sct_cost">
                            {{ App::getLocale() == 'en' ? substr($product->description, 0, 100) . '...'  : substr($product->deskripsi, 0, 100) . '...'  }}
                        </div>
                        <small><i>{{ App::getLocale() == 'en' ? $product->categories->pluck('name')->implode(', ') : $product->categories->pluck('nama')->implode(', ') }}</i></small>
                        <div class="sct_sns" style="top:230px"></div>
                    </li>
                </a>
            @endforeach
        </ul>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const customSelect = document.querySelector('.custom-select');
            const customSelectTrigger = customSelect.querySelector('.custom-select-trigger');
            const customOptions = customSelect.querySelector('.custom-options');
            const realSelect = document.getElementById('real-select');
            const brandForm = document.getElementById('brandForm');

            customSelectTrigger.addEventListener('click', function () {
                customOptions.style.display = customOptions.style.display === 'flex' ? 'none' : 'flex';
            });

            customOptions.addEventListener('click', function (event) {
                if (event.target.classList.contains('custom-option')) {
                    const value = event.target.getAttribute('data-value');
                    customSelectTrigger.querySelector('span').textContent = event.target.textContent.trim();
                    realSelect.value = value;
                    customOptions.style.display = 'none';
                    brandForm.submit(); // Submit the form when a brand is selected
                }
            });

            document.addEventListener('click', function (event) {
                if (!customSelect.contains(event.target)) {
                    customOptions.style.display = 'none';
                }
            });
        });
    </script>
@endsection
