@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Bank</h1>
        </div>
        <div class="section-body">
            <x-alert />
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-header">
                        <h4>Bank List</h4>
                        <div class="card-header-action">
                            <a href="{{ route('backend.banks.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="banklist">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bank Name</th>
                                        <th>Logo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banks as $bank)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $bank->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$bank->logo) }}" width="80px" class="img-fluid"/>
                                            </td>
                                            <td><span class="badge {{ $bank->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $bank->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                                            <td>
                                                <a href="{{ route('backend.banks.edit', ['id' => $bank->id]) }}" class="btn btn-info text-white btn-sm"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('backend.banks.destroy', ['id' => $bank->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete This Bank?')">
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
        $("#banklist").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [2,4] }
            ]
        });
    </script>
@endpush
