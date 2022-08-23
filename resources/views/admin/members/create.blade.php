@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.members.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.members.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="name">Name of Patient</label>
                    <input type="text" name="name" id="name" class="form-control" required> 
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="company">Name of Company</label>
                    <input type="text" name="company" id="company" class="form-control" > 
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="date_avail">Date of Availment</label>
                    <input type="date" name="date_avail" id="date_avail" class="form-control"  > 
                </div>
            </div>      
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="provider">Name of Provider</label>
                    <input type="text" name="provider" id="provider" class="form-control"> 
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="type_avail">Type of Availment</label>
                    <select name="type_avail" id="type_avail" class="form-control select2">
                        <option value="">Select Option</option>
                        <option>In-Patient</option>
                        <option>Out-Patient</option>
                        <option>Dental</option>
                        <option>APE</option>
                    </select>
                </div>
            </div>  
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="test">Type of Test Done</label>
                    <select name="test_id[]" id="test" class="form-control select2" multiple="">
                        @foreach ($tests as $key => $test)
                            <option value="{{ $key }}">{{ $test }}</option>
                        @endforeach


                    </select>
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control"> 
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="batch_num">Batch Number</label>
                    <input type="text" name="batch_num" id="batch_num" class="form-control"> 
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="check_num">Check Number</label>
                    <input type="text" name="check_num" id="check_num" class="form-control"> 
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="check_am">Check Amount</label>
                    <input type="text" name="check_am" id="check_am" class="form-control"> 
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="check_date">Check Date</label>
                    <input type="Date" name="check_date" id="check_date" class="form-control"> 
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@push('javascript')
<script>

</script>
@endpush