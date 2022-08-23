@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.members.title')</h3>
    @can('member_create')
        <p>
            <a href="{{ route('admin.members.create') }}" class="btn btn-success">Add Employee</a>

            @if(!is_null(Auth::getUser()->role_id) && config('quickadmin.can_see_all_records_role_id') == Auth::getUser()->role_id)
                @if(Session::get('Member.filter', 'all') == 'my')
                    <!-- <a href="?filter=all" class="btn btn-default">Show all records</a> -->
                @else
                    <!-- <a href="?filter=my" class="btn btn-default">Filter my records</a> -->
                @endif
            @endif
        </p>
    @endcan

    @can('member_delete')
        <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.members.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li>
            |
            <li><a href="{{ route('admin.members.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
        </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table id="myTable" class="table table-bordered table-striped {{ count($members) > 0 ? 'datatable' : '' }} @can('member_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    @can('member_delete')
                        @if ( request('show_deleted') != 1 )
                            <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>@endif
                    @endcan

                    <th>Name of Patient</th>
                    <th>Name of Company</th>
                    <th>Date of Availment</th>
                    <th>Name of Provider</th>
                    <th>Type of Availment</th>
                    <th>Type of Test Done</th>
                    <th>Amount</th>
                    <th>Batch Number</th>
                    <th>Check Number</th>
                    <th>Check Amount</th>
                    <th>Check Date</th>

                    @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                    @else
                        <th>&nbsp;</th>
                    @endif
                </tr>
                </thead>

                <tbody>
                @if (count($members) > 0)
                    @foreach ($members as $member)
                        <tr data-entry-id="{{ $member->id }}">
                            @can('member_delete')
                                @if ( request('show_deleted') != 1 )
                                    <td></td>@endif
                            @endcan

                            <td field-key='name'>
                                @can('member_view')
                                    {{$member->name}}
                            @endcan
                            <td field-key='company'>
                                @can('member_view')
                                    {{$member->company}}
                            @endcan
                            <td field-key='date_avail'>
                                @can('member_view')
                                    {{$member->date_avail}}
                            @endcan
                            <td field-key='provider'>
                                @can('member_view')
                                    {{$member->provider}}
                            @endcan
                            <td field-key='type_avail'>
                                @can('member_view')
                                    {{$member->type_avail}}
                            @endcan
                            <td field-key='test'>
                                @can('member_view')
                                    @foreach($member->typeOfTest as $t)
                                    {{ $t->test->name }},
                                    @endforeach
                            @endcan
                            <td field-key='amount'>
                                @can('member_view')
                                    {{$member->amount}}
                            @endcan
                            <td field-key='batch_num'>
                                @can('member_view')
                                    {{$member->batch_num}}
                            @endcan
                            <td field-key='check_num'>
                                @can('member_view')
                                    {{$member->check_num}}
                            @endcan
                            <td field-key='check_am'>
                                @can('member_view')
                                    {{$member->check_am}}
                            @endcan
                            <td field-key='check_date'>
                                @can('member_view')
                                    {{$member->check_date}}
                            @endcan
                            @if( request('show_deleted') == 1 )
                                <td>
                                    @can('member_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'POST',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.members.restore', $member->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                    @can('member_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.members.perma_del', $member->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            @else
                                <td>
                                    @can('member_edit')
                                        <a href="{{ route('admin.members.edit',[$member->id]) }}" class="btn btn-xs btn-warning">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('member_delete')
                                        {!! Form::open(array(
                                                                                'style' => 'display: inline-block;',
                                                                                'method' => 'DELETE',
                                                                                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                                'route' => ['admin.members.destroy', $member->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="13">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
//            var table = $('#myTable_Wrapper').DataTable();
//console.log(table);
//            table.button( '.dt-button' ).remove();
        })
    </script>
    <script>
        @can('member_delete')
                @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.members.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection