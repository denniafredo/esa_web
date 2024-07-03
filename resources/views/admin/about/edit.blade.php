@extends('admin.layout-admin.web') <!-- Extend the main template -->

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
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
            <h1 class="h3 mb-3">Edit About</h1>

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('about.update',1)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="inputUsername" class="form-label">Nama Kantor
                                            <i class="align-middle" data-lucide="star" style="color: red"></i>
                                        </label>
                                        <input type="text" class="form-control" id="nama"
                                               name="nama"
                                               placeholder="Nama Kantor" value="{{$data->nama}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputUsername" class="form-label">Alamat Kantor
                                            <i class="align-middle" data-lucide="star" style="color: red"></i>
                                        </label>
                                        <input type="text" class="form-control" id="address"
                                               name="address"
                                               placeholder="Address" value="{{$data->address}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputUsername" class="form-label">Telp Kantor
                                            <i class="align-middle" data-lucide="star" style="color: red"></i>
                                        </label>
                                        <input type="text" class="form-control" id="phone"
                                               name="phone"
                                               placeholder="Phone" value="{{$data->phone}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputUsername" class="form-label">Email Kantor</label>
                                        <input type="text" class="form-control" id="website"
                                               name="website"
                                               placeholder="Email" value="{{$data->website}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputUsername" class="form-label">Link Bizpart</label>
                                        <input type="text" class="form-control" id="bizpartLink"
                                               name="bizpartLink"
                                               placeholder="bizpartLink" value="{{$data->bizpartLink}}">
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </main>
    <script>


        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function () {
                var img = document.getElementById('showImg');
                img.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
