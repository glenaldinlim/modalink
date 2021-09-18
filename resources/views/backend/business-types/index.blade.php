@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Business Type</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>Type List</h4>
                        <div class="card-header-action">
                            <a href="{{ route('backend.businesses.types.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="typelist">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Type Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $type)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $type->name }}</td>
                                            <td><span class="badge {{ $type->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $type->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                            <td>
                                                <a href="{{ route('backend.businesses.types.edit', ['id' => $type->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('backend.businesses.types.destroy', ['id' => $type->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This type?')">
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
        $("#typelist").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [3] }
            ]
        });
    </script>
@endpush
