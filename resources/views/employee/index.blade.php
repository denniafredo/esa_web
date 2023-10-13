@extends('layouts.app') <!-- Extend the main template -->

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-block card-stretch">
                                <div class="card-body p-0">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <h5 class="font-weight-bold">List Karyawan</h5>
                                        <a href="{{ route('employee.create') }}"
                                           class="btn btn-primary position-relative d-flex align-items-center justify-content-between">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Tambah Data Karyawan
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table data-table mb-0">
                                            <thead class="table-color-heading">
                                            <tr class="">
                                                <th scope="col">
                                                    Nama
                                                </th>
                                                <th scope="col">
                                                    Email
                                                </th>
                                                <th scope="col">
                                                    Telepon
                                                </th>
                                                <th scope="col">
                                                    Status
                                                </th>
                                                <th scope="col" class="text-right">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($employments as $employment)
                                                <tr class="white-space-no-wrap">
                                                    <td>
                                                        <div class="active-project-1 d-flex align-items-center mt-0 ">
                                                            <div class="h-avatar is-medium">
                                                                <img class="avatar rounded-circle"
                                                                     src="images/user/1.jpg">
                                                            </div>
                                                            <div class="data-content">
                                                                <div>
                                                                    <span
                                                                        class="font-weight-bold">{{$employment->name}}</span>
                                                                </div>
                                                                <p class="m-0 text-secondary small">
                                                                    Vari tech
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>christian.Bale@blueberrye.com</td>
                                                    <td>
                                                        +1 (021) 145-2256
                                                    </td>
                                                    <td>
                                                        Magang
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end align-items-center">
                                                            <a class="" data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-original-title="View"
                                                               href="{{route('employee.show', $employment->id)}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="text-secondary"
                                                                     width="20" fill="none" viewBox="0 0 24 24"
                                                                     stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                                </svg>
                                                            </a>
                                                            <a class="" data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-original-title="Edit"
                                                               href="{{route('employee.edit', $employment->id)}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="text-secondary mx-4"
                                                                     width="20" fill="none" viewBox="0 0 24 24"
                                                                     stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                                </svg>
                                                            </a>
                                                            <a class="badge bg-danger" data-toggle="tooltip"
                                                               data-placement="top"
                                                               title="" data-original-title="Delete"
                                                               href="{{route('employee.destroy', $employment->id)}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                     fill="none"
                                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                            </a>
                                                        </div>
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
