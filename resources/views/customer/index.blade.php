@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <style>
        /* CSS for table formatting (unchanged) */
        .tbl_head01 {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            border-spacing: 0;
            background-color: #fff;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .tbl_head01 th, .tbl_head01 td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .tbl_head01 th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .tbl_head01 tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .tbl_wrap {
            overflow-x: auto;
        }

        .content_title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .sub_navi {
            font-size: 14px;
            color: #999;
        }

        /* CSS to hide sections by default and add transition */
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



    <div class="content_desc head-office active">
        <!-- Only add 'active' class if fragment matches -->
        <div class="content_title">
            <div class="sub_title">
                <p>HEAD OFFICE</p>
            </div>
            <div class="sub_navi">
                <p><img src="{{ asset('images/navi_home.png') }}"> > HEAD OFFICE </p>
            </div>
        </div>
        <div class="tbl_head01 tbl_wrap">
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kantor</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
                </thead>
                <tbody>
                @foreach($headOffices as $key => $headOffice)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $headOffice->name }}</td>
                        <td>{{ $headOffice->email }}</td>
                        <td>{{ $headOffice->phone }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="content_desc sales-executive">
        <!-- Only add 'active' class if fragment matches -->
        <div class="content_title">
            <div class="sub_title">
                <p>SALES EXECUTIVE</p>
            </div>
            <div class="sub_navi">
                <p><img src="{{ asset('images/navi_home.png') }}"> > SALES EXECUTIVE </p>
            </div>
        </div>
        <div class="tbl_head01 tbl_wrap">
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kantor</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
                </thead>
                <tbody>
                @foreach($salesExecutives as $key => $salesExecutive)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $salesExecutive->name }}</td>
                        <td>{{ $salesExecutive->email }}</td>
                        <td>{{ $salesExecutive->phone }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <
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
