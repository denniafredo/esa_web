@extends('admin.layout-admin.web') <!-- Extend the main template -->

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Edit Content</h1>

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('company-profile.update',$data->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Nama Konten
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="text" class="form-control" id="namaKonten" name="namaKonten"
                                                   placeholder="Nama Konten" value="{{$data->namaKonten}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Konten (HTML)
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <textarea rows="10" class="form-control" id="konten" name="konten"
                                                      placeholder="Ketik Disini..."
                                                      required>{{$data->konten}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Content Name
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="text" class="form-control" id="contentName" name="contentName"
                                                   placeholder="Content Name" value="{{$data->contentName}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Content (HTML)
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <textarea rows="10" class="form-control" id="content" name="content"
                                                      placeholder="Type Here..."
                                                      required>{{$data->content}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Urutan Konten</label>
                                            <input type="number" class="form-control" id="urutan" name="urutan"
                                                   min="1" value="{{$data->urutan}}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="inputUsername" class="form-label">Lihat Konten</label>
                                        <div id="displayKonten" class="border p-3"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="inputUsername" class="form-label">Content Render</label>
                                        <div id="displayContent" class="border p-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var kontenTextArea = document.getElementById('konten');
            var displayDiv = document.getElementById('displayKonten');

            kontenTextArea.addEventListener('input', function () {
                displayDiv.innerHTML = kontenTextArea.value;
            });

            var ContentTextArea = document.getElementById('content');
            var displayContentDiv = document.getElementById('displayContent');

            ContentTextArea.addEventListener('input', function () {
                displayContentDiv.innerHTML = ContentTextArea.value;
            });
        });
    </script>
@endsection
