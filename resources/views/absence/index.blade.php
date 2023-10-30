@extends('layouts.app') <!-- Extend the main template -->

@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Absence</h4>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <!-- Display error message if it exists -->
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{route('absence.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="images" class="drop-container" id="dropcontainer">
                                <span class="drop-title">Drop Absence files here</span>
                                or
                                <input type="file" name="file" id="file" accept=".csv" required>
                            </label>
                            <button type="submit"
                                    class="btn btn-primary font-weight-bold btn-sm justify-content-end">
                                + Sumbit
                            </button>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-block card-stretch">
                                <div class="card-body p-0">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <h5 class="font-weight-bold">Absence List</h5>
                                        <form method="GET" action="{{ route('absence.index') }}">
                                            <label for="date_filter" class="form-label font-weight-bold text-muted text-uppercase">Filter by Date:</label>
                                            <input type="date" class="form-control" id="date_filter" name="date_in" placeholder="Masukan Filter Tanggal"
                                                   autocomplete="off" data-date-format="d-m-Y"
                                                   value="{{ request()->input('date_in') }}">
                                        </form>
                                        <button class="btn btn-secondary btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                <path
                                                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                            </svg>
                                            Print
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table data-table mb-0">
                                            <thead class="table-color-heading">
                                            <tr class="">
                                                <th scope="col">
                                                    Name
                                                </th>
                                                <th scope="col">
                                                    NIK
                                                </th>
                                                <th scope="col">
                                                    Divisi
                                                </th>
                                                <th scope="col">
                                                    Tanggal
                                                </th>
                                                <th scope="col">
                                                    Jam Masuk
                                                </th>
                                                <th scope="col">
                                                    Jam Keluar
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($absences as $absence)
                                                <tr class="white-space-no-wrap">
                                                    <td>
                                                        <div class="active-project-1 d-flex align-items-center mt-0 ">
                                                            <div class="h-avatar is-medium">
                                                                @if($absence->employment->image_path != '')
                                                                    <img class="avatar rounded-circle"
                                                                         src={{asset('images/employment/'.$absence->employment->image_path)}}>
                                                                @else
                                                                    @if($absence->employment->gender == 'Pria')
                                                                        <img class="avatar rounded-circle"
                                                                             src={{asset('images/user/1.jpg')}}>
                                                                    @else
                                                                        <img class="avatar rounded-circle"
                                                                             src={{asset('images/user/2.jpg')}}>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="data-content">
                                                                <div>
                                                                    <span
                                                                        class="font-weight-bold">{{$absence->employment->name}}</span>
                                                                </div>
                                                                <p class="m-0 text-secondary small">
                                                                    {{$absence->employment->role}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{$absence->employment->nik}}</td>
                                                    <td>
                                                        {{$absence->employment->employmentDivision->name}}
                                                    </td>
                                                    <td>
                                                        {{dateIndo($absence->date_in)}}
                                                    </td>
                                                    <td>
                                                        {{$absence->time_in}}
                                                    </td>
                                                    <td>
                                                        {{$absence->time_out}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dateFilter = document.getElementById('date_filter');
            dateFilter.addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>
@endsection
