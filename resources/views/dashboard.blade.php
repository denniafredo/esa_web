@extends('layouts.app') <!-- Extend the main template -->

@section('content')
    <div id="remoteModelData" class="modal fade" role="dialog"></div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-4 mt-1">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <h4 class="font-weight-bold">Overview</h4>
                        <div class="form-group mb-0 vanila-daterangepicker d-flex flex-row">
                            <div class="date-icon-set">
                                <input type="text" name="start" class="form-control" placeholder="From Date">
                                <span class="search-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                     </span>
                            </div>
                            <span class="flex-grow-0">
                     <span class="btn">To</span>
                  </span>
                            <div class="date-icon-set">
                                <input type="text" name="end" class="form-control" placeholder="To Date">
                                <span class="search-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                     </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <h4 class="font-weight-bold">Absence Report</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="fas fa-stop text-primary"></i>
                                                <span>Time In</span>
                                            </div>
                                            <div class="ml-3"><i class="fas fa-stop text-info"></i>
                                                <span>Time Out</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="chart-apex-column-01" class="custom-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header card-header-border d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Top Absence</h4>
                            </div>
                        </div>
                        <div class="card-body-list">
                            <ul class="list-style-3 mb-0">
                                <li class="p-3 list-item d-flex justify-content-start align-items-center">
                                    <div class="avatar">
                                        <img class="avatar avatar-img avatar-60 rounded"
                                             src="{{asset('images/user/1.jpg')}}">
                                    </div>
                                    <div class="list-style-detail ml-3 mr-2">
                                        <p class="mb-0">Caitriona Balfe</p>
                                    </div>
                                </li>
                                <li class="p-3 list-item d-flex justify-content-start align-items-center">
                                    <div class="avatar">
                                        <img class="avatar avatar-img avatar-60 rounded"
                                             src="{{asset('images/user/2.jpg')}}">
                                    </div>
                                    <div class="list-style-detail ml-3 mr-2">
                                        <p class="mb-0">Christian Bale</p>
                                    </div>
                                </li>
                                <li class="p-3 list-item d-flex justify-content-start align-items-center">
                                    <div class="avatar">
                                        <img class="avatar avatar-img avatar-60 rounded"
                                             src="{{asset('images/user/3.jpg')}}">
                                    </div>
                                    <div class="list-style-detail ml-3 mr-2">
                                        <p class="mb-0">Jack McMullen</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fit-icon-2 text-info text-center">
                                            <div id="circle-progress-01"
                                                 class="circle-progress-01 circle-progress circle-progress-light"
                                                 data-min-value="0" data-max-value="100" data-value="57"
                                                 data-type="percent"></div>
                                        </div>
                                        <div class="ml-3">
                                            <h5 class="text-white font-weight-bold">57 <small> /100 Employee</small>
                                            </h5>
                                            <small class="mb-0">Time In</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fit-icon-2 text-info text-center">
                                            <div id="circle-progress-02"
                                                 class="circle-progress-02 circle-progress circle-progress-light"
                                                 data-min-value="0" data-max-value="100" data-value="0"
                                                 data-type="percent"></div>
                                        </div>
                                        <div class="ml-3">
                                            <h5 class="text-white font-weight-bold">0 <small> /100 Employee</small>
                                            </h5>
                                            <small class="mb-0">Time Out</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card bg-danger">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fit-icon-2 text-info text-center">
                                            <div id="circle-progress-03"
                                                 class="circle-progress-03 circle-progress circle-progress-light"
                                                 data-min-value="0" data-max-value="100" data-value="5"
                                                 data-type="percent"></div>
                                        </div>
                                        <div class="ml-3">
                                            <h5 class="text-white font-weight-bold">5 <small> /100 Employee</small>
                                            </h5>
                                            <small class="mb-0">On Leave</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Upcoming Events</h4>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-spacing mb-0">
                                    <tbody>
                                    <tr class="white-space-no-wrap">
                                        <td>
                                            <h6 class="mb-0 text-uppercase text-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                Tue, 30 June 2023
                                            </h6>
                                        </td>
                                        <td class="pl-0 py-3">
                                            Cuti Bersama
                                        </td>
                                    </tr>
                                    <tr class="white-space-no-wrap">
                                        <td>
                                            <h6 class="mb-0 text-uppercase text-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                Monday, 09 July 2023
                                            </h6>
                                        </td>
                                        <td class="pl-0 py-3">
                                            Upacara Bendera
                                        </td>
                                    </tr>
                                    <tr class="white-space-no-wrap">
                                        <td>
                                            <h6 class="mb-0 text-uppercase text-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                Sunday, 15 Aug 2023
                                            </h6>
                                        </td>
                                        <td class="pl-0 py-3">
                                            Townhall
                                        </td>
                                    </tr>
                                    <tr class="white-space-no-wrap">
                                        <td>
                                            <h6 class="mb-0 text-uppercase text-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                Thursday, 26 Oct 2023
                                            </h6>
                                        </td>
                                        <td class="pl-0 py-3">
                                            Outing
                                        </td>
                                    </tr>
                                    <tr class="white-space-no-wrap">
                                        <td>
                                            <h6 class="mb-0 text-uppercase text-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                Friday, 25 Dec 2023
                                            </h6>
                                        </td>
                                        <td class="pl-0 py-3">
                                            Sale
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="d-flex justify-content-start align-items-center border-top-table p-3">
                                <button class="btn btn-secondary btn-sm">See All</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">New Employee</h4>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-color-heading">
                                    <tr class="text-secondary">
                                        <th scope="col">Date</th>
                                        <th scope="col">Employee</th>
                                        <th scope="col">Divisi</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="white-space-no-wrap">
                                        <td>01 Jun 2020</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-45 mr-2">
                                                    <img src="images/user/2.jpg" class="img-fluid rounded-circle"
                                                         alt="image">
                                                </div>
                                                <div>Maggie Potts</div>
                                            </div>
                                        </td>
                                        <td>Research and Development</td>
                                        <td>
                                            <p class="mb-0 text-success d-flex justify-content-start">
                                                <small><i class="fas fa-circle mr-2"></i></small>Karyawan Tetap
                                            </p>
                                        </td>
                                    </tr>
                                    <tr class="white-space-no-wrap">
                                        <td>02 Jun 2020</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-45 mr-2">
                                                    <img src="images/user/5.jpg" class="img-fluid rounded-circle"
                                                         alt="image">
                                                </div>
                                                <div>Kevin Adkins</div>
                                            </div>
                                        </td>
                                        <td>Teknisi</td>
                                        <td>
                                            <p class="mb-0 text-success d-flex justify-content-start">
                                                <small><i class="fas fa-circle mr-2"></i></small>Karyawan Tetap
                                            </p>
                                        </td>
                                    </tr>
                                    <tr class="white-space-no-wrap">
                                        <td>05 Jun 2020</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-45 mr-2">
                                                    <img src="images/user/1.jpg" class="img-fluid rounded-circle"
                                                         alt="image">
                                                </div>
                                                <div>Max Lynn</div>
                                            </div>
                                        </td>
                                        <td>Finance</td>
                                        <td>
                                            <p class="mb-0 text-warning d-flex justify-content-start">
                                                <small><i class="fas fa-circle mr-2"></i></small>Karyawan Kontrak
                                            </p>
                                        </td>
                                    </tr>
                                    <tr class="white-space-no-wrap">
                                        <td>06 Jun 2020</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-45 mr-2">
                                                    <img src="images/user/3.jpg" class="img-fluid rounded-circle"
                                                         alt="image">
                                                </div>
                                                <div>Danniw Yatt</div>
                                            </div>
                                        </td>
                                        <td>IT</td>
                                        <td>
                                            <p class="mb-0 text-danger d-flex justify-content-start">
                                                <small><i class="fas fa-circle mr-2"></i></small>Magang
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end align-items-center border-top-table p-3">
                                    <a href="{{url('employee')}}" class="btn btn-secondary btn-sm">See All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection
