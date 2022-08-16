@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('quickadmin.qa_dashboard')</div>

                    @if(isset(Auth::user()-> email))
                    <div class="panel-body">
                    @lang('quickadmin.qa_dashboard_text') <strong> {{Auth::user()->name}} </strong>
                    </div>
                    @else
                    <script> window.location ="/admin/home";</script>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
