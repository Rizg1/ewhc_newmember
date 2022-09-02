@extends('layouts.app')

@section('content')
    <h3 class="page-title">Reports</h3>

    

        
    <div class="panel-heading">
        <div class="row">
            <form action="{{ route('admin.export') }}" method="POST">
                @csrf
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="text" name="from_date" id="from_date" class="form-control" />
                        <div class="input-group-addon">to</div>
                        <input type="text" name="end_date" id="end_date" class="form-control" />
                        
                    </div>
                </div>
                <div class="col-md-5">
                <button type="submit" class="btn btn-success btn-sm">Download Record</button>
                </div>
            </form>
        </div>
        
            
    </div>
    
    
@stop

@section('javascript')
    <script>

        $(function() {
            $('input[name="from_date"]').daterangepicker({
                singleDatePicker: true,
                maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
            });

            $('input[name="end_date"]').daterangepicker({
                singleDatePicker: true,
                maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
            });
        });
       
            
    </script>
@endsection