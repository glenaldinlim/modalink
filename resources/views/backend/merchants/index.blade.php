@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Partner</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>Merchant List</h4>
                        <div class="card-header-action">
                            <a href="{{ route('backend.merchants.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="merchantslist">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Usaha</th>
                                        <th>Sektor</th>
                                        <th>Status</th>
                                        <th>Bergabung</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($merchants as $merchant)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $merchant->name }}</td>
                                            <td>{{ $merchant->business_type_id }}</td>
                                            <td>{{ $merchant->status_id }}</td>
                                            <td>{{ $merchant->created_at }}</td>
                                            <td>
                                                <a href="{{ route('backend.merchants.edit', ['id' => $merchant->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <a href="{{ route('backend.merchants.show', ['id' => $merchant->id]) }}" class="btn btn-warning text-white btn-sm"> <i class="fas fa-eye"></i></a>
                                                <form action="{{ route('backend.merchants.destroy', ['id' => $merchant->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus merchant ini?')">
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
        $("#merchantslist").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [5] }
            ]
        });
    </script>
@endpush
