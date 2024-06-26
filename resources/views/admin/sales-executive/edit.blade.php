@extends('admin.layout-admin.web') <!-- Extend the main template -->

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Edit Branch</h1>

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('sales-executive.update',$data->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Nama
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="text" class="form-control" id="name"
                                                   name="name" value="{{$data->name}}"
                                                   placeholder="Nama Kantor" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Email
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="email" class="form-control" id="email"
                                                   name="email" value="{{$data->email}}"
                                                   placeholder="Email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">No. Telp
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="phone" value="{{$data->phone}}"
                                                   placeholder="No. Telp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">City
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="text" class="form-control" id="city"
                                                   name="city" value="{{$data->city}}"
                                                   placeholder="City" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            {{--            <div class="row">--}}
            {{--                <div class="col-md-12 col-xl-12">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="row">--}}
            {{--                                <div class="col-md-6">--}}
            {{--                                    <div class="mb-3">--}}
            {{--                                        <label for="inputUsername" class="form-label">Lihat Konten</label>--}}
            {{--                                        <div id="displayKonten" class="border p-3"></div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="col-md-6">--}}
            {{--                                    <div class="mb-3">--}}
            {{--                                        <label for="inputUsername" class="form-label">Content Render</label>--}}
            {{--                                        <div id="displahp artisan seryContent" class="border p-3"></div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </main>
    <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     var kontenTextArea = document.getElementById('konten');
        //     var displayDiv = document.getElementById('displayKonten');
        //
        //     kontenTextArea.addEventListener('input', function () {
        //         displayDiv.innerHTML = kontenTextArea.value;
        //     });
        //
        //     var ContentTextArea = document.getElementById('content');
        //     var displayContentDiv = document.getElementById('displayContent');
        //
        //     ContentTextArea.addEventListener('input', function () {
        //         displayContentDiv.innerHTML = ContentTextArea.value;
        //     });
        // });

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
