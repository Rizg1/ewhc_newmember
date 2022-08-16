@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.members.title')</h3>
    
    {!! Form::model($member, ['method' => 'PUT', 'route' => ['admin.members.update', $member->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="name">Name of Patient</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$member->name}}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="company">Name of Company</label>
                    <input type="text" name="company" id="company" class="form-control" value="{{$member->company}}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="date_avail">Date of Availment</label>
                    <input type="text" name="date_avail" id="date_avail" class="form-control" value="{{$member->date_avail}}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="type_avail">Type of Availment</label>
                    <input type="text" name="type_avail" id="type_avail" class="form-control" value="{{$member->type_avail}}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="test">Type of Test Done</label>
                    <input type="text" name="test" id="test" class="form-control" value="{{$member->test}}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control" value="{{$member->amount}}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="batch_num">Batch Number</label>
                    <input type="text" name="batch_num" id="batch_num" class="form-control" value="{{$member->batch_num}}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="check_num">Check Number</label>
                    <input type="text" name="check_num" id="check_num" class="form-control" value="{{$member->check_num}}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="check_am">Check Amount</label>
                    <input type="text" name="check_am" id="check_am" class="form-control" value="{{$member->check_am}}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="check_date">Check Date</label>
                    <input type="text" name="check_date" id="check_date" class="form-control" value="{{$member->check_date}}">
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

