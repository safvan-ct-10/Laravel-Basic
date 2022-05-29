@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">COUNTRIES</h4>
                    <a href="{{ route('admin.country.create') }}" class="btn btn-primary btn-fw float-right">ADD NEW COUNTRY</a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>CODE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{ $countries->firstItem() + $loop->index }}</td>{{-- $loop->iteration --}}
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->code }}</td>
                                        <td>
                                            <a href="{{ route('admin.country.edit', $country->id) }}"
                                                class="btn btn-inverse-info btn-fw">Edit</a>
                                            <a href="{{ route('admin.country.delete', $country->id) }}"
                                                 class="btn btn-inverse-warning btn-fw">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $countries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
