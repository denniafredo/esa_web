@extends('layouts.app') <!-- Extend the main template -->

@section('content')
    <div id="remoteModelData" class="modal fade" role="dialog"></div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
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
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{url('employee')}}">Karyawan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Karyawan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-3 d-flex justify-content-between">
                    <h4 class="font-weight-bold d-flex align-items-center">Detail Karyawan</h4>
                    <a href="{{url('employee')}}"
                       class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-2">Kembali</span>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div>
                                    <ul class="list-style-1 mb-0">
                                        <li class="list-item d-flex justify-content-start align-items-center">
                                            <div class="avatar">
                                                @if($employment->image_path != '')
                                                    <img class="avatar avatar-img avatar-60 rounded-circle"
                                                         src="{{asset('images/employment/'.$employment->image_path)}}"
                                                         alt="01.jpg"/>
                                                @else
                                                    @if($employment->gender == 'Pria')
                                                        <img class="avatar avatar-img avatar-60 rounded-circle"
                                                             src="{{asset('images/user/1.jpg')}}" alt="01.jpg"/>
                                                    @else
                                                        < <img class="avatar avatar-img avatar-60 rounded-circle"
                                                               src="{{asset('images/user/2.jpg')}}" alt="02.jpg"/>
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="list-style-detail ml-4 mr-2">
                                                <h5 class="font-weight-bold">{{$employment->name}}</h5>
                                                <p class="mb-0 mt-1 text-muted">{{$employment->employmentRole->name}}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 text-center">
                                        <a href="{{route('employee.edit', $employment->nik)}}"
                                           class="btn btn-block btn-sm btn-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                            <span class="">Edit Data Karyawan</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <td class="p-0">
                                            <p class="mb-0 text-muted">Email</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 ">{{$employment->email}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">
                                            <p class="mb-0 text-muted">Birthday</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 ">{{dateIndo($employment->date_of_birth)}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">
                                            <p class="mb-0 text-muted">Phone</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 ">{{$employment->phone}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">
                                            <p class="mb-0 text-muted">Country</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 ">{{$employment->country}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">
                                            <p class="mb-0 text-muted">State/Region</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 ">{{$employment->region}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">
                                            <p class="mb-0 text-muted">Address</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 ">{{$employment->address}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-0">
                            <ul class="nav tab-nav-pane nav-tabs pt-2 mb-0">
                                <li class="pb-2 mb-0 nav-item"><a data-toggle="tab"
                                                                  class="font-weight-bold text-uppercase px-5 py-2 active"
                                                                  href="#page-cuti">Cuti</a></li>
                                <li class="pb-2 mb-0 nav-item"><a data-toggle="tab"
                                                                  class="font-weight-bold text-uppercase px-5 py-2"
                                                                  href="#page-absensi">Absensi</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="page-cuti" class="tab-pane fade show active">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <h5>Data Cuti</h5>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#myModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Tambah Cuti
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table data-table mb-0">
                                            <thead class="table-color-heading">
                                            <tr class="text-muted">
                                                <th width="30%" scope="col">Tanggal</th>
                                                <th scope="col">Keterangan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($historyLeaves as $historyLeave)
                                                <tr>
                                                    <td>{{dateIndo($historyLeave->date_leave)}}</td>
                                                    <td>{{$historyLeave->reason ? $historyLeave->reason : "-"}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="page-absensi" class="tab-pane fade">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <h5>Data Absensi</h5>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table data-table mb-0">
                                            <thead class="table-color-heading">
                                            <tr class="">
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Cuti {{$employment->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('historyLeave.store')}}" method="POST">
                    <div class="modal-body col">
                        @csrf
                        <input type="hidden" id="employment_id" name="employment_id" value="{{$employment->id}}"
                               required>
                        <div class="form-group">
                            <label for="date_leave" class="form-label font-weight-bold text-muted text-uppercase">Tanggal
                                Cuti<span style="color: red">*</span></label></label>
                            <input type="date" class="form-control" id="date_leave" name="date_leave" required>
                        </div>

                        <div class="form-group">
                            <label for="reason"
                                   class="form-label font-weight-bold text-muted text-uppercase">Keterangan</label></label>
                            <textarea class="form-control" id="reason" name="reason" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
