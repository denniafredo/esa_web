@extends('layouts.app') <!-- Extend the main template -->

@section('content')
    <style>
        .benefit-list:hover {
            background-color: #e0e0e0; /* Change the color to your desired shade of gray */
            cursor: pointer; /* Change the cursor to a pointer to indicate interactivity */
        }
    </style>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Benefit</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-block card-stretch">
                                <div class="card-body p-0">
                                    @if(session('success'))
                                        <div class="alert alert-success mb-2">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <!-- Display error message if it exists -->
                                    @if(session('error'))
                                        <div class="alert alert-danger mb-2">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <h5 class="font-weight-bold">List Karyawan</h5>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table data-table mb-0">
                                            <thead class="table-color-heading">
                                            <tr class="">
                                                <th scope="col">
                                                    Nama
                                                </th>
                                                <th scope="col">
                                                    NIK
                                                </th>
                                                <th scope="col">
                                                    Divisi
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($employments as $employment)
                                                <tr class="white-space-no-wrap benefit-list"
                                                    onclick="window.location='{{route('benefit.edit', ['benefit' => $employment->nik, 'month' => now()->format('Y-m')])}}'">
                                                    <td>
                                                        <div class="active-project-1 d-flex align-items-center mt-0 ">
                                                            <div class="h-avatar is-medium">
                                                                @if($employment->image_path != '')
                                                                    <img class="avatar rounded-circle"
                                                                         src={{asset('images/employment/'.$employment->image_path)}}>
                                                                @else
                                                                    @if($employment->gender == 'Pria')
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
                                                                            class="font-weight-bold">{{$employment->name}}</span>
                                                                </div>
                                                                <p class="m-0 text-secondary small">
                                                                    {{$employment->employmentRole->name}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{$employment->nik}}</td>
                                                    <td>
                                                        {{$employment->employmentDivision->name}}
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
@endsection
