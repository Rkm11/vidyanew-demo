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
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;">ID</th>

                        <th>Name</th>
                        <th>Email Id</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>

                <tbody>
                    @if (count($users) > 0)
                        @php $i=1;  @endphp
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>{{ $i }}</td>
                                @php $i++ @endphp

                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                    @php
                                    $url=url('user/delete/').'/'.$user->id;
                                    @endphp
                                    <a onclick="confDelete('{{$url}}')" href="javascript:void(0);" class="btn btn-xs btn-info">Delete</a>

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
<script type="text/javascript">

function confDelete(url){
    if(confirm('Are you sure ?')){
        window.location.href =url;
        }
}
</script>