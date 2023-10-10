@extends('layouts.app') <!-- Extend the main template -->

@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Benefit</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">
                                    <a href="customer-add.html"
                                       class="btn btn-primary position-relative d-flex align-items-center justify-content-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Import Benefit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-block card-stretch">
                                <div class="card-body p-0">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <h5 class="font-weight-bold">Benefit List</h5>
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
                                                <th scope="col" class="text-center">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for($i=1;$i<6;$i++)
                                                <tr class="white-space-no-wrap">
                                                    <td class="">
                                                        <div class="active-project-1 d-flex align-items-center mt-0 ">
                                                            <div class="h-avatar is-medium">
                                                                <img class="avatar rounded-circle"
                                                                     src="images/user/{{$i}}.jpg">
                                                            </div>
                                                            <div class="data-content">
                                                                <div>
                                                                    <span class="font-weight-bold">Christian Bale</span>
                                                                </div>
                                                                <p class="m-0 text-secondary small">
                                                                    Vari tech
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>19900501 201501 1 02{{$i}}</td>
                                                    <td>
                                                        Finance
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a class="mr-3" data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-original-title="View" href="customer-view.html">
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
                                                               data-original-title="Calculate"
                                                               href="customer-edit.html">
                                                                <svg style="color: rgb(153, 153, 153);"
                                                                     xmlns="http://www.w3.org/2000/svg" width="16"
                                                                     height="16" fill="currentColor"
                                                                     class="bi bi-calculator" viewBox="0 0 16 16">
                                                                    <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"
                                                                          fill="#999999"></path>
                                                                    <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"
                                                                          fill="#999999"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endfor
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
