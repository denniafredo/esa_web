@extends('admin.layout-admin.web') <!-- Extend the main template -->

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Update Product</h1>

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('product.update',$data->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Product Image
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <div class="mb-3">
                                                <div class="text-center">
                                                    <img alt="" src="{{$data->image}}" id="showImg"
                                                         class="img-responsive mt-2"
                                                         style="max-width: 400px;"/>
                                                    <div class="mt-2">
                                                        <input type="file" class="form-control" name="productImage"
                                                               id="productImage"
                                                               onchange="previewImage(event)" {{ empty($data->image) ? 'required' : '' }}>
                                                    </div>
                                                    <small>Upload cover image for article here. (JPG, JPEG, PNG) (Max.
                                                        Size 2 Mb)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="inputUsername" class="form-label">Brand
                                            <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            @if(sizeof($brands)==0)
                                                <a href="{{route('brand.create')}}">Add Brand Here</a>
                                            @endif
                                        </label>
                                        <select class="form-control select2" id="brand" name="brand"
                                                data-toggle="select2">
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}" {{$data->brand_id ? 'selected' : ''}}>{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="inputUsername" class="form-label">Kategori (bisa pilih lebih dari
                                            1)</label>
                                        <select class="form-control select2" id="category" name="category[]"
                                                multiple="multiple"
                                                data-toggle="select2">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{in_array($category->id, $selectedCategories) ? 'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="border p-3">
                                            <legend class="w-auto">Produk Bahasa Indonesia</legend>
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Nama Produk
                                                    <i class="align-middle" data-lucide="star" style="color: red"></i>
                                                </label>
                                                <input type="text" class="form-control" id="nama"
                                                       name="nama"
                                                       placeholder="Nama Produk" value="{{$data->nama}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Deskripsi
                                                    <i class="align-middle" data-lucide="star" style="color: red"></i>
                                                </label>
                                                <textarea rows="10" class="form-control" id="deskripsi" name="deskripsi"
                                                          placeholder="Ketik Disini..."
                                                          required> {{$data->deskripsi}} </textarea>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="border p-3">
                                            <legend class="w-auto">Produk Bahasa Inggris</legend>
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Product Name
                                                    <i class="align-middle" data-lucide="star" style="color: red"></i>
                                                </label>
                                                <input type="text" class="form-control" id="name"
                                                       name="name"
                                                       placeholder="Product Name" value="{{$data->name}}" required>
                                            </div>
                                            <div class=" mb-3">
                                                <label class="form-label">Descriptions
                                                    <i class="align-middle" data-lucide="star" style="color: red"></i>
                                                </label>
                                                <textarea rows="10" class="form-control" id="description"
                                                          name="description"
                                                          placeholder="Type Here..."
                                                          required>{{$data->description}}</textarea>
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
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $(".select2").each(function () {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })

            function fetchCategories(brandId) {
                if (brandId) {
                    $.ajax({
                        url: '/admin/categories/' + brandId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            var categorySelect = $('#category');
                            categorySelect.empty(); // Clear existing options
                            data.forEach(function (category) {
                                categorySelect.append(new Option(category.name, category.id));
                            });
                            categorySelect.trigger('change'); // Notify select2 of changes
                        },
                        error: function () {
                            alert('Failed to get categories.');
                        }
                    });
                }
            }

            $('#brand').change(function () {
                var brandId = $(this).val();
                fetchCategories(brandId);
            });

        });


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
