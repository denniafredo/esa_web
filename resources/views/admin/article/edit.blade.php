@extends('admin.layout-admin.web') <!-- Extend the main template -->

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Edit Content</h1>

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('article.update',$data->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Cover Image
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <div class="mb-3">
                                                <div class="text-center">
                                                    <img alt="" src="{{$data->coverImage}}" id="showImg"
                                                         class="img-responsive mt-2"
                                                         style="max-width: 400px;"/>
                                                    <div class="mt-2">
                                                        <input type="file" class="form-control" name="coverImage"
                                                               id="coverImage"
                                                               onchange="previewImage(event)" {{ empty($data->coverImage) ? 'required' : '' }}>
                                                    </div>
                                                    <small>Upload cover image for article here. (JPG, JPEG, PNG) (Max.
                                                        Size 2 Mb)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="border p-3">
                                            <legend class="w-auto">Konten Bahasa Indonesia</legend>
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Nama Konten
                                                    <i class="align-middle" data-lucide="star" style="color: red"></i>
                                                </label>
                                                <input type="text" class="form-control" id="namaKonten"
                                                       name="namaKonten"
                                                       placeholder="Nama Konten" value="{{$data->namaKonten}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Konten
                                                    <i class="align-middle" data-lucide="star" style="color: red"></i>
                                                </label>
                                                <textarea rows="10" class="form-control" id="konten" name="konten"
                                                          placeholder="Ketik Disini..."
                                                          required>{{$data->konten}}</textarea>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="border p-3">
                                            <legend class="w-auto">Konten Bahasa Inggris</legend>
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Content Name
                                                    <i class="align-middle" data-lucide="star" style="color: red"></i>
                                                </label>
                                                <input type="text" class="form-control" id="contentName"
                                                       name="contentName"
                                                       placeholder="Content Name" value="{{$data->contentName}}"
                                                       required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Content
                                                    <i class="align-middle" data-lucide="star" style="color: red"></i>
                                                </label>
                                                <textarea rows="10" class="form-control" id="content" name="content"
                                                          placeholder="Type Here..."
                                                          required>{{$data->content}}</textarea>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
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
            {{--                                        <div id="displayContent" class="border p-3"></div>--}}
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
