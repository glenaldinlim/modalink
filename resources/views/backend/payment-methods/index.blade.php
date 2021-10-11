@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Payment Method</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>Payment Method List</h4>
                        <div class="card-header-action">
                            <a href="{{ route('backend.payments.methods.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="paymentlist">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bank</th>
                                        <th>Account</th>
                                        <th>PIC</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentMethods as $method)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $method->bank_id }}</td>
                                            <td>{{ $method->account_number }} a/n {{ $method->alias_name }}</td>
                                            <td>{{ $method->user_id }}</td>
                                            <td><span class="badge {{ $method->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $method->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                            <td>
                                                <a href="{{ route('backend.payments.methods.edit', ['id' => $method->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('backend.payments.methods.destroy', ['id' => $method->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This Status?')">
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
        $("#paymentlist").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [5] }
            ]
        });
    </script>
@endpush
