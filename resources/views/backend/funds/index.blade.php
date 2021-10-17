@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Fund</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>Fund List</h4>
                        <div class="card-header-action">
                            <a href="{{ route('backend.funds.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="fundlist">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Merchant</th>
                                        <th>Name</th>
                                        <th>Target</th>
                                        <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($funds as $fund)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $fund->merchant_id }}</td>
                                            <td>{{ $fund->name }}</td>
                                            <td>{{ $fund->target }}</td>
                                            <td>{{ $fund->deadline }}</td>
                                            <td>
                                                <a href="{{ route('backend.funds.edit', ['id' => $fund->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('backend.funds.destroy', ['id' => $fund->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This type?')">
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
        $("#fundlist").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [5] }
            ]
        });
    </script>
@endpush
