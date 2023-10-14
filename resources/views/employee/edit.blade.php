@extends('layouts.app') <!-- Extend the main template -->

@section('content')
    <div id="remoteModelData" class="modal fade" role="dialog"></div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{route('employee.index')}}">Karyawan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Karyawan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3 d-flex justify-content-between">
                    <h4 class="font-weight-bold d-flex align-items-center">Edit Karyawan</h4>
                    <a href="{{route('employee.index')}}"
                       class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-2">Kembali</span>
                    </a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="row" action="{{route('employee.store')}}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-3 mb-3">
                                    <div class="card-body rounded bg-light">
                                        <div class="d-flex justify-content-center">
                                            <img id="previewImage" src="{{ asset('images/user/unknown.jpg') }}"
                                                 class="img-fluid" alt="profile">
                                        </div>
                                        <div class="d-flex justify-content-center mt-2 mb-3">
                                            <label for="imageUpload" class="mb-0 text-muted font-weight-bold">Upload
                                                Gambar</label>
                                        </div>
                                        <div class="d-flex justify-content-center mt-2 mb-3">
                                            <input type="file" name="image" id="imageUpload" accept=".jpg, .jpeg"
                                                   onchange="previewFile()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems with your
                                            input.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="row g-3 date-icon-set-modal">
                                        <div class="col-md-6 mb-3">
                                            <label for="Text1"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Nama
                                                Lengkap<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Masukan Nama Lengkap" value="" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase mb-3">Jenis
                                                Kelamin<span style="color: red">*</span></label><br>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="inlineRadio1" name="gender"
                                                           class="custom-control-input" value="Pria" required>
                                                    <label class="custom-control-label" for="inlineRadio1">Pria</label>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="inlineRadio2" name="gender"
                                                           class="custom-control-input" value="Wanita" required>
                                                    <label class="custom-control-label"
                                                           for="inlineRadio2">Wanita</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="place_of_birth"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Tempat
                                                Lahir</label>
                                            <input type="text" class="form-control" id="place_of_birth"
                                                   name="place_of_birth"
                                                   placeholder="Masukan Tempat Lahir" value="">
                                        </div>
                                        <div class="col-md-6 mb-3  position-relative">
                                            <label for="date_of_birth"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Tanggal
                                                Lahir</label>
                                            <input type="date" class="form-control" id="date_of_birth"
                                                   name="date_of_birth" placeholder="Masukan Tanggal Lahir"
                                                   autocomplete="off" data-date-format="d-m-Y"
                                                   value="">
                                            <span class="search-link">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="type_of_blood"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Golongan
                                                Darah</label>
                                            <select id="type_of_blood" name="type_of_blood"
                                                    class="form-select form-control choicesjs">
                                                <option value="">Pilih Golongan Darah</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="nik"
                                                   class="form-label font-weight-bold text-muted text-uppercase">NIK<span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="nik" name="nik"
                                                   placeholder="Masukan NIK" value="" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Email<span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                   placeholder="Masukan Email"
                                                   value="" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone2"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Telepon</label>
                                            <div class="input-group">
                                                <span class="input-group-text">+62</span>
                                                <input type="tel" class="form-control" id="phone" name="phone"
                                                       placeholder="Masukan Nomor Telepon" pattern="[0-9]*">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="religion"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Agama</label>
                                            <select id="religion" name="religion"
                                                    class="form-select form-control choicesjs">
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="inputCountry"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Negara</label>
                                            <select id="country" name="country"
                                                    class="form-select form-control choicesjs">
                                                <option value="">Pilih Negara</option>
                                                <option value="INDONESIA" selected>INDONESIA</option>
                                                <option value="LUAR NEGERI">LUAR NEGERI</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="region"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Provinsi</label>
                                            <input type="text" class="form-control" id="region" name="region"
                                                   placeholder="Masukan Provinsi"
                                                   value="">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Text7"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Kode
                                                Pos</label>
                                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                                   placeholder="Masukan Kode Pos" value="">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="address"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Alamat</label>
                                            <textarea class="form-control" id="address" name="address" rows="2"
                                                      placeholder="Masukan Alamat">
                                            </textarea>
                                        </div>
                                        <div class="col-md-6 mb-3  position-relative">
                                            <label for="date_start_of_work"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Tanggal
                                                Bekerja</label>
                                            <input type="date" class="form-control"
                                                   id="date_start_of_work"
                                                   name="date_start_of_work" placeholder="Masukan Tanggal Bekerja"
                                                   autocomplete="off" data-date-format="d-m-Y"
                                                   value="">
                                            <span class="search-link">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="employment_status"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Status
                                                Karyawan<span style="color: red">*</span></label>
                                            <select id="employment_status" class="form-select form-control choicesjs"
                                                    name="employment_status" required>
                                                <option value="">Pilih Status Karyawan</option>
                                                @foreach($employmentStatuses as $employmentStatus)
                                                    <option
                                                        value="{{$employmentStatus->id}}">{{$employmentStatus->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="employment_division"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Divisi<span style="color: red">*</span></label>
                                            <select id="employment_division" name="employment_division"
                                                    class="form-select form-control choicesjs" required>
                                                <option value="">Pilih Divisi</option>
                                                @foreach($employmentDivisions as $employmentDivision)
                                                    <option
                                                        value="{{$employmentDivision->id}}">{{$employmentDivision->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="employment_country"
                                                   class="form-label font-weight-bold text-muted text-uppercase">Jabatan<span style="color: red">*</span></label>
                                            <select id="employment_role" name="employment_role"
                                                    class="form-select form-control choicesjs" required>
                                                <option value="">Pilih Jabatan</option>
                                                @foreach($employmentRoles as $employmentRole)
                                                    <option
                                                        value="{{$employmentRole->id}}">{{$employmentRole->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex flex-wrap justify-content-end mt-3">
                                            <button type="submit"
                                                    class="btn btn-primary font-weight-bold btn-sm justify-content-end">
                                                +
                                                Tambah
                                            </button>
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
    <script>
        function previewFile() {
            var preview = document.getElementById('previewImage');
            var fileInput = document.getElementById('imageUpload');
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function () {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
        flatpickr("input[type=date]",{
            allowInput: true,
        });
    </script>
@endsection

