@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <style>
        .content_desc {
            opacity: 0;
            visibility: hidden;
            max-height: 0;
            overflow: hidden;
            transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out, max-height 0.5s ease-in-out;
        }

        /* CSS to display active section with transition */
        .content_desc.active {
            opacity: 1;
            visibility: visible;
            max-height: 1000px; /* Arbitrary large value to ensure the content fits */
        }
    </style>
    <main class="main__content_wrapper">
        <!-- cart section start -->
        <section class="cart__section section--padding ">
            <div class="container content_desc head-office active">
                <div class="cart__section--inner">
                    <form action="#">
                        <h2 class="cart__title mb-30">{{__('BRANCHES')}}</h2>
                        <div class="cart__table">
                            <table class="cart__table--inner">
                                <thead class="cart__table--header">
                                <tr class="cart__table--header__items">
                                    <th class="cart__table--header__list">No</th>
                                    <th class="cart__table--header__list">{{__('Name')}}</th>
                                    <th class="cart__table--header__list">Phone</th>
                                    <th class="cart__table--header__list">{{__('City')}}</th>
                                </tr>
                                </thead>
                                <tbody class="cart__table--body">
                                @foreach($headOffices as $key => $headOffice)
                                    <tr class="cart__table--body__items">
                                        <td class="cart__table--body__list">
                                            <span class="cart__price">{{ $key + 1 }}</span>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <h3 class="cart__content--title h4">{{ $headOffice->name }}
                                            </h3>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <span class="cart__price">
                                                <a href="https://wa.me/{{ $headOffice->phone }}"
                                                   target='_blank'>{{ $headOffice->phone }}</a></span>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <span class="cart__price">{{ $headOffice->city }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container content_desc sales-executive">
                <div class="cart__section--inner">
                    <form action="#">
                        <h2 class="cart__title mb-30">SALES EXECUTIVE</h2>
                        <div class="cart__table">
                            <table class="cart__table--inner">
                                <thead class="cart__table--header">
                                <tr class="cart__table--header__items">
                                    {{--                                    <th class="cart__table--header__list">No</th>--}}
                                    <th class="cart__table--header__list">{{__('Name')}}</th>
                                    <th class="cart__table--header__list">Email/Phone (WA)</th>
                                    <th class="cart__table--header__list">{{__('City')}}</th>
                                </tr>
                                </thead>
                                <tbody class="cart__table--body">
                                @foreach($salesExecutives as $key => $salesExecutive)
                                    <tr class="cart__table--body__items">
                                        {{--                                        <td class="cart__table--body__list">--}}
                                        {{--                                            <span class="cart__price">{{ $key + 1 }}</span>--}}
                                        {{--                                        </td>--}}
                                        <td class="cart__table--body__list">
                                            <h3 class="cart__content--title h4">{{ $salesExecutive->name }}
                                            </h3>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <span class="cart__price">
                                                <a href="mailto:{{ $salesExecutive->email }}" target='_blank'>
                                                {{ $salesExecutive->email }}</a>
                                                <br>
                                                <a href="https://wa.me/{{ $salesExecutive->phone }}"
                                                   target='_blank'>{{ $salesExecutive->phone }}</a>
                                            </span>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <span class="cart__price">{{ $salesExecutive->city }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <script>
        // JavaScript to handle scrolling to the fragment section
        function setActiveSection() {
            var fragment = window.location.hash.substr(1); // Get fragment identifier without #
            fragment = fragment == '' || fragment == 'bizpart' ? 'head-office' : fragment;
            var sections = document.querySelectorAll('.content_desc'); // Get all sections

            sections.forEach(function (section) {
                if (section.classList.contains(fragment)) {
                    section.classList.add('active'); // Show the section if it matches the fragment
                } else {
                    section.classList.remove('active'); // Hide sections that do not match
                }
            });
        }

        // Initial call to set active section based on current fragment
        setActiveSection();

        // Event listener for hashchange event
        window.addEventListener('hashchange', setActiveSection);
    </script>

@endsection
