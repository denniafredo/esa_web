@extends('admin.layout-admin.web')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">New Brand</h1>

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('brand.index') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="namaKonten" class="form-label">Nama Brand
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Nama Brand" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="categories" class="form-label">Categories
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <table id="categories-table" class="table table-striped w-100">
                                                <thead>
                                                <tr>
                                                    <th>Kategori (Bahasa Indonesia)</th>
                                                    <th>Category (Bahasa Inggris)</th>
                                                    <th>
                                                        <button type="button" class="btn btn-success btn-sm"
                                                                id="add-row">
                                                            Tambah +
                                                        </button>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><input type="text" class="form-control kategori"
                                                               name="kategori[]"
                                                               placeholder="Kategori" required></td>
                                                    <td><input type="text" class="form-control category"
                                                               name="category[]"
                                                               placeholder="Category" required></td>
                                                    <td align="center">
                                                        <button type="button" class="btn btn-danger btn-sm remove-row">
                                                            -
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

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
        </div>
    </main>

    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            // Add new row
            $('#add-row').click(function () {
                var newRow = '<tr>' +
                    '<td><input type="text" class="form-control kategori" name="kategori[]" placeholder="Kategori" required></td>' +
                    '<td><input type="text" class="form-control category" name="category[]" placeholder="Category" required></td>' +
                    '<td align="center">' +
                    '<button type="button" class="btn btn-danger btn-sm remove-row">-</button>' +
                    '</td>' +
                    '</tr>';
                $('#categories-table tbody').append(newRow);
            });

            // Remove row
            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
