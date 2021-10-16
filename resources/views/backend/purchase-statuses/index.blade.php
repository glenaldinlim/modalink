@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Purchases Status</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>Status List</h4>
                        <div class="card-header-action">
                            <a href="{{ route('backend.funds.purchases.statuses.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="statuslist">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Status State</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statuses as $status)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $status->name }}</td>
                                            <td>{{ $status->description }}</td>
                                            <td>
                                                <a href="{{ route('backend.funds.purchases.statuses.edit', ['id' => $status->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('backend.funds.purchases.statuses.destroy', ['id' => $status->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This Status?')">
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
        $("#statuslist").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [3] }
            ]
        });
    </script>
@endpush
