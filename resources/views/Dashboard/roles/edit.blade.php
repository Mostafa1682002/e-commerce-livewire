@extends('layouts.master', ['title' => 'Edit Role'])
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="bx bx-home-alt"></i></a>
                            Home
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Role</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">Edit Role</h5>
                    </div>
                    <hr>
                    <form class="row g-3" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12 pb-3">
                            <label for="inputName" class="form-label">Name</label>
                            <input type="name" name="name" value="{{ $role->name }}" class="form-control" required
                                id="inputName">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check">
                                    <p>
                                        <input class="form-check-input" type="checkbox" id="checkedAll">
                                        <label class="form-check-label" for="checkedAll">
                                            Select All
                                        </label>
                                    </p>
                                </div>

                            </div>
                            @foreach ($permissions as $permission)
                                <div class="col-3">
                                    <div class="form-check">
                                        <input {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                            class="form-check-input checkSingle" type="checkbox" name="permissions[]"
                                            value="{{ $permission->id }}" id="flexCheckDefault{{ $permission->id }}">
                                        <label class="form-check-label" for="flexCheckDefault{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script>
        $(document).ready(function() {
            $("#checkedAll").change(function() {
                if (this.checked) {
                    $(".checkSingle").each(function() {
                        this.checked = true;
                    });
                } else {
                    $(".checkSingle").each(function() {
                        this.checked = false;
                    });
                }
            });

            $(".checkSingle").click(function() {
                if ($(this).is(":checked")) {
                    var isAllChecked = 0;

                    $(".checkSingle").each(function() {
                        if (!this.checked)
                            isAllChecked = 1;
                    });

                    if (isAllChecked == 0) {
                        $("#checkedAll").prop("checked", true);
                    }
                } else {
                    $("#checkedAll").prop("checked", false);
                }
            });
        });
    </script>
@endpush
