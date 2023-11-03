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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                <path
                                                        d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                            </svg>
                                            <span class="">Export Data</span>
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
                                                        <input style="width: 50%;" type="text"
                                                               class="form-control rupiah"
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
                                                        <input style="width: 50%;" type="text"
                                                               class="form-control rupiah"
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
                                                        <input style="width: 40%;" type="text"
                                                               class="form-control rupiah"
                                                               id="bpjs_kesehatan" name="bpjs_kesehatan"
                                                               placeholder="0" value="0" readonly>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 50%;" for="meal_allowances"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Uang
                                                            Makan :</label>
                                                        <input style="width: 50%;" type="text"
                                                               class="form-control rupiah"
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
                                                        <input style="width: 40%;" type="text"
                                                               class="form-control rupiah"
                                                               id="bpjs_jht" name="bpjs_jht" placeholder="0"
                                                               value="0"
                                                               readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 50%;" for="transport_allowances"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Uang
                                                            Transport :</label>
                                                        <input style="width: 50%;" type="text"
                                                               class="form-control rupiah"
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
                                                        <input style="width: 40%;" type="text"
                                                               class="form-control rupiah"
                                                               id="bpjs_pensiun" name="bpjs_pensiun" placeholder="0"
                                                               value="0" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <label style="width: 50%;" for="overtime_allowances"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Uang
                                                            Lembur :</label>
                                                        <input style="width: 50%;" type="text"
                                                               class="form-control rupiah"
                                                               id="overtime_allowances" name="overtime_allowances"
                                                               placeholder="Masukan Uang Lembur"
                                                               value="{{$benefit->overtime_allowances}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="row align-items-center justify-content-between">
                                                        <div class="col-6">
                                                            <label for="pph"
                                                                   class="form-label font-weight-bold text-muted text-uppercase">Potongan
                                                                PPH :</label>
                                                            <div class="d-flex">
                                                                <input type="radio" id="pph5" name="persenpph" value="5"
                                                                       @if($benefit->persenpph == 5) checked @endif >
                                                                <label for="pph5" class="ml-1 mr-2">5%</label>
                                                                <input type="radio" id="pph15" name="persenpph"
                                                                       value="15"
                                                                       @if($benefit->persenpph == 15) checked @endif>
                                                                <label for="pph15" class="ml-1 mr-2">15%</label>
                                                                <input type="radio" id="pph25" name="persenpph"
                                                                       value="25"
                                                                       @if($benefit->persenpph == 25) checked @endif>
                                                                <label for="pph25" class="ml-1 mr-2">25%</label>
                                                                <input type="radio" id="pph30" name="persenpph"
                                                                       value="30"
                                                                       @if($benefit->persenpph == 30) checked @endif>
                                                                <label for="pph30" class="ml-1">30%</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <input style="width: 85%;margin-left: 15%" type="text"
                                                                   class="form-control rupiah" id="pph" name="pph"
                                                                   placeholder="0" value="0" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="col-md-12 mb-3" style="border-top: 2px solid grey;">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <label style="width: 50%; font-size: 20px" for="thp"
                                                               class="form-label font-weight-bold text-muted text-uppercase text-right pr-2">Take
                                                            Home Pay : </label>
                                                        <input style="width: 25%;" type="text"
                                                               class="form-control rupiah"
                                                               id="thp" name="thp" placeholder="0" value="0"
                                                               readonly>
                                                        <div class="ml-auto">
                                                            <button type="submit" class="btn btn-primary">Update
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            hitung();
            formatRupiahInputs();
        });

        function formatRupiahInputs() {
            var rupiahInputs = document.getElementsByClassName('rupiah');

            for (var i = 0; i < rupiahInputs.length; i++) {
                var input = rupiahInputs[i];
                var value = input.value;
                if (value.trim() !== "") {
                    // Remove non-numeric characters except commas
                    value = value.replace(/[^\d,]/g, '');

                    // Check if the value is "0" and return it as is
                    if (value === "0") {
                        input.value = "0";
                        continue;
                    }

                    // Remove leading zeros
                    value = value.replace(/^0+/, '');

                    // Remove any existing commas
                    value = value.replace(/,/g, '');

                    // Convert to a number and format with commas
                    var formattedValue = parseFloat(value).toLocaleString('en-US');

                    input.value = formattedValue;
                }
            }
        }

        // Add keyup event listeners for real-time formatting
        var rupiahInputs = document.getElementsByClassName('rupiah');
        for (var i = 0; i < rupiahInputs.length; i++) {
            rupiahInputs[i].addEventListener("keyup", function () {
                hitung();
            });
        }

        var radioButtons = document.getElementsByName('persenpph');
        for (var i = 0; i < radioButtons.length; i++) {
            radioButtons[i].addEventListener('change', function () {
                hitung();
            });
        }

        function hitung() {
            var gajiPokok = document.getElementById('basic_salary').value.replace(/,/g, '');
            var tunjanganTetap = document.getElementById('fixed_allowances').value.replace(/,/g, '');
            var uangMakan = document.getElementById('meal_allowances').value.replace(/,/g, '');
            var uangTransport = document.getElementById('transport_allowances').value.replace(/,/g, '');
            var uangLembur = document.getElementById('overtime_allowances').value.replace(/,/g, '');
            var persenBPJSKesehatan = 1;
            var persenBPJSJHT = 2;
            var persenBPJSPensiun = 1;
            var persenBPJSPPH;
            var radioButtons = document.getElementsByName('persenpph');

            for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    persenBPJSPPH = radioButtons[i].value;
                    break;
                }
            }
            if (persenBPJSPPH === undefined) {
                persenBPJSPPH = 5;
            }

            var total = parseInt(gajiPokok) + parseInt(tunjanganTetap);
            var total_all = total + parseInt(uangMakan) + parseInt(uangTransport) + parseInt(uangLembur);
            var bpjs_kesehatan = total * (parseInt(persenBPJSKesehatan) / 100);
            var bpjs_jht = total * (parseInt(persenBPJSJHT) / 100);
            var bpjs_pensiun = total * (parseInt(persenBPJSPensiun) / 100);
            var pph = total_all * (parseInt(persenBPJSPPH) / 100);
            console.log(total_all)
            document.getElementById('bpjs_kesehatan').value = bpjs_kesehatan;
            document.getElementById('bpjs_jht').value = bpjs_jht;
            document.getElementById('bpjs_pensiun').value = bpjs_pensiun;
            document.getElementById('pph').value = pph;
            var thp = total_all - bpjs_kesehatan - bpjs_jht - bpjs_pensiun - pph;
            document.getElementById('thp').value = thp;
            formatRupiahInputs();
        }

    </script>
@endsection
