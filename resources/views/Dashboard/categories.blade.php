@extends('layouts.master', ['title' => 'Categories'])
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
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">

                @can('categories-create')
                    <div class="col-6 col-md-4">
                        {{-- =====================Add================= --}}
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModaladd"><i class="bx bx-plus"></i> Add New Category
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" method="POST" action="{{ route('admin.categories.store') }}">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="inputAddress2" name="name"
                                                    required placeholder="Enter Name" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Slug</label>
                                                <textarea class="form-control" id="inputAddress2" name="slug" required required placeholder="Enter Message"
                                                    rows="3"></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan




                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->slug }}</td>
                                    <td>
                                        @can('categories-delete')
                                            {{-- =============Delate Request========================= --}}
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModald{{ $loop->index }}">Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModald{{ $loop->index }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row g-3" method="POST"
                                                                action="{{ route('admin.categories.destroy', $row->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <p>Are You Sure Delete Category ??</p>
                                                                <div class="col-12">
                                                                    <label for="inputAddress2" class="form-label">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputAddress2" name="name" readonly
                                                                        value="{{ $row->name }}">
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan


                                        @can('categories-edit')
                                            {{-- =============Upadate========================= --}}
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $loop->index }}">Update
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                                Category</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row g-3" method="POST"
                                                                action="{{ route('admin.categories.update', $row->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="col-12">
                                                                    <label for="inputAddress2" class="form-label">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputAddress2" name="name" required
                                                                        value="{{ $row->name }}">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="inputAddress2" class="form-label">Slug</label>
                                                                    <input type="hidden" value="{{ $row->id }}"
                                                                        name="id">
                                                                    <textarea class="form-control" id="inputAddress2" name="slug" required placeholder="Enter Message"
                                                                        rows="3">{{ $row->slug }}</textarea>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                "paging": false,
                "ordering": false,
                "info": false
            });

        });
    </script>
@endpush
