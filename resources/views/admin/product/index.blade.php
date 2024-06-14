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
            <a href="{{ route('product.create') }}" class="btn btn-primary float-end mt-n1"><i
                        class="fas fa-plus"></i>
                New Product</a>
            <h1 class="h3 mb-3">Products</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-reponsive" class="table table-striped w-100">
                                <thead>
                                <tr>
                                    <th>Brand</th>
                                    <th>Gambar Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->brand->name}}</td>
                                        <td><img src="{{$item->image}}" alt="" width="250px"></td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->deskripsi}}</td>
                                        <td>
                                            <div class="d-flex justify-content-end align-items-center">
                                                <a href="{{route('product.edit', $item->id)}}"
                                                   style=" margin-right:10px;">
                                                    <i class="align-middle" data-lucide="edit" style="color: black"></i>
                                                </a>
                                                <form action="{{ route('product.destroy', $item->id) }}"
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
