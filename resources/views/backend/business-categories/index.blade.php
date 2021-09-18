@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Business Category</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>Category List</h4>
                        <div class="card-header-action">
                            <a href="{{ route('backend.businesses.categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="categorylist">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Name</th>
                                        <th>Initial</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->initial }}</td>
                                            <td><span class="badge {{ $category->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $category->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                            <td>
                                                <a href="{{ route('backend.businesses.categories.edit', ['id' => $category->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('backend.businesses.categories.destroy', ['id' => $category->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This Category?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                </form>
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
    </section>
@endsection

@push('js-additional')
    <script>
        $("#categorylist").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [3,4] }
            ]
        });
    </script>
@endpush
