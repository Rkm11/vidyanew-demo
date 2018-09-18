@extends('layouts.master')
@inject('request', 'Illuminate\Http\Request')
@php
$ID = 'settings';
@endphp
@push('header')
<script>
    ID = '{{ $ID }}';
</script>
@endpush

@section('content')
    <h3 class="page-title">Manage Users</h3>
    <p>
        <a href="{{ route('users.create') }}" class="btn btn-success">Create User</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            User List
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>Name</th>
                        <th>Email Id</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>

                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td></td>

                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-xs btn-info">Edit</a>

                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">No Entries in table</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')

@endsection