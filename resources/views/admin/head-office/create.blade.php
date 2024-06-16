@extends('admin.layout-admin.web') <!-- Extend the main template -->

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">New Head Office</h1>

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('head-office.index')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Nama
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="text" class="form-control" id="name"
                                                   name="name"
                                                   placeholder="Nama Kantor" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Email
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="email" class="form-control" id="email"
                                                   name="email"
                                                   placeholder="Email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">No. Telp
                                                <i class="align-middle" data-lucide="star" style="color: red"></i>
                                            </label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="phone"
                                                   placeholder="No. Telp" required>
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
    <script>
        
    </script>
@endsection
