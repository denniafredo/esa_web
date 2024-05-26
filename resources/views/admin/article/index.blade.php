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
            <a href="{{ route('article.create') }}" class="btn btn-primary float-end mt-n1"><i
                        class="fas fa-plus"></i>
                New Content</a>
            <h1 class="h3 mb-3">Article</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-reponsive" class="table table-striped w-100">
                                <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Nama Konten</th>
                                    <th>Konten</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td><img src="{{$item->coverImage}}" alt="" width="250px"></td>
                                        <td>{{$item->namaKonten}}</td>
                                        <td>{{$item->konten}}</td>
                                        <td>
                                            <div class="d-flex justify-content-end align-items-center">
                                                <a href="{{route('article.edit', $item->id)}}"
                                                   style=" margin-right:10px;">
                                                    <i class="align-middle" data-lucide="edit" style="color: black"></i>
                                                </a>
                                                <form action="{{ route('article.destroy', $item->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class="align-middle" data-lucide="trash-2"
                                                           style="color: red"></i>
                                                    </a>
                                                </form>
                                            </div>
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
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                destroy: true,
                responsive: true
            });
        });

        
    </script>
@endsection
