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
                                    <li class="breadcrumb-item"><a href="{{url('benefit')}}">Benefit</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Benefit</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-3 d-flex justify-content-between">
                    <h4 class="font-weight-bold d-flex align-items-center">Detail Benefit</h4>
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
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div>
                                    <ul class="list-style-1 mb-0">
                                        <li class="list-item d-flex justify-content-start align-items-center">
                                            <div class="avatar">
                                                <img class="avatar avatar-img avatar-60 rounded-circle"
                                                     src="{{asset('images/user/1.jpg')}}" alt="01.jpg"/>
                                            </div>
                                            <div class="list-style-detail ml-4 mr-2">
                                                <h5 class="font-weight-bold">{{$employment->name}}</h5>
                                                <p class="mb-0 mt-1 text-muted">{{$employment->employmentRole->name}}
                                                    - {{$employment->employmentDivision->name}}</p>
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
                                            <p class="mb-0 text-muted">NIK</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 ">{{$employment->nik}}</p>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="tab-content">
                                <div id="invoice" class="tab-pane fade show active">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <h5>Benefit</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <form action="{{route('benefit.update',['benefit' => $employment->nik])}}"
                                              method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-3 date-icon-set-modal">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 50%;" for="basic_salary"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Gaji
                                                            Pokok<span style="color: red">*</span> :</label>
                                                        <input style="width: 50%;" type="number" class="form-control"
                                                               id="basic_salary" name="basic_salary"
                                                               placeholder="Masukan Gaji Pokok"
                                                               value="{{$benefit->basic_salary}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 50%;" for="fixed_allowances"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Tunjangan
                                                            Tetap :</label>
                                                        <input style="width: 50%;" type="number" class="form-control"
                                                               id="fixed_allowances" name="fixed_allowances"
                                                               placeholder="Masukan Tunjangan Tetap"
                                                               value="{{$benefit->fixed_allowances}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 60%;" for="bpjs_kesehatan"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Potongan
                                                            BPJS Kesehatan (1%) :</label>
                                                        <input style="width: 40%;" type="text" class="form-control"
                                                               id="bpjs_kesehatan" name="bpjs_kesehatan"
                                                               placeholder="0.00" value="" readonly>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 50%;" for="meal_allowances"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Uang
                                                            Makan :</label>
                                                        <input style="width: 50%;" type="number" class="form-control"
                                                               id="meal_allowances" name="meal_allowances"
                                                               placeholder="Masukan Uang Makan"
                                                               value="{{$benefit->meal_allowances}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 60%;" for="bpjs_jht"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Potongan
                                                            BPJS JHT (2%):</label>
                                                        <input style="width: 40%;" type="text" class="form-control"
                                                               id="bpjs_jht" name="bpjs_jht" placeholder="0.00" value=""
                                                               readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 50%;" for="transport_allowances"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Uang
                                                            Transport :</label>
                                                        <input style="width: 50%;" type="number" class="form-control"
                                                               id="transport_allowances" name="transport_allowances"
                                                               placeholder="Masukan Uang Transport"
                                                               value="{{$benefit->transport_allowances}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 60%;" for="bpjs_pensiun"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Potongan
                                                            BPJS Pensiun (1%):</label>
                                                        <input style="width: 40%;" type="text" class="form-control"
                                                               id="bpjs_pensiun" name="bpjs_pensiun" placeholder="0.00"
                                                               value="" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 50%;" for="overtime_allowances"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Uang Lembur :</label>
                                                        <input style="width: 50%;" type="number" class="form-control"
                                                               id="overtime_allowances" name="overtime_allowances"
                                                               placeholder="Masukan Uang Lembur"
                                                               value="{{$benefit->overtime_allowances}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 60%;" for="pph"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Potongan
                                                            PPH (5,15,25,30):</label>
                                                        <input style="width: 40%;" type="text" class="form-control"
                                                               id="pph" name="pph" placeholder="0.00" value="" readonly>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-md-12 mb-3" style="border-top: 2px solid grey;">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <label style="width: 50%; font-size: 20px" for="thp"
                                                               class="form-label font-weight-bold text-muted text-uppercase text-right pr-2">Take
                                                            Home Pay : </label>
                                                        <input style="width: 25%;" type="text" class="form-control"
                                                               id="thp" name="thp" placeholder="0.00" value="" readonly>
                                                        <div class="ml-auto">
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
