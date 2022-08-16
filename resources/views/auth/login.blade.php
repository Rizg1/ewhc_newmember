@extends('layouts.auth')

@section('content')

<div class="row h-100 w-100" style="justify-content:center;display:flex" id="login-box">
    <div class="col-md-5" id="container-box">
        <div class="panel panel-default">
        <div class="panel-heading" style="text-align:center;" ><img src="/adminlte/img/ewhc_logo.png" class="img-login"/> </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger" >
                    <strong>Whoops!</strong> @lang('quickadmin.qa_there_were_problems_with_input'):
                    <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="form-horizontal"
                      role="form"
                      method="POST"
                      action="{{ url('login') }}">
                    <input type="hidden"
                           name="_token"
                           value="{{ csrf_token() }}">

                    <div class="form-group">
                  <!--      <label class="col-md-4 control-label">@lang('quickadmin.qa_email')</label> -->

                        <div class="col-md-6 col-md-offset-3">
                           
                            <input type="email"
                                   class="form-control"
                                   style="border-radius: 5px; height:35px;"
                                   name="email"
                                   id="email-input"
                                   placeholder="Email"
                                   value="{{ old('email') }}">
                                   
                        </div>
                    </div>
                    
                  <div class="form-group">
                 <!--    <label class="col-md-4 control-label">@lang('quickadmin.qa_password')</label>  -->

                        <div class="col-md-6 col-md-offset-3">
                            <input type="password"
                                   class="form-control"
                                   style="border-radius: 5px; height:35px;"
                                   name="password"
                                   placeholder="Password">
                            
                        </div>
                    </div>

                   <!--  <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                           <a href="{{ route('auth.password.reset') }}"> @lang('quickadmin.qa_forgot_password')</a>
                            <br> -->
                        <!--    <a href="{{ route('auth.register') }}">@lang('quickadmin.qa_registration')</a>
                        </div>
                    </div> -->


             <!--      <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <label>
                                <input type="checkbox"
                                       name="remember"> @lang('quickadmin.qa_remember_me')
                            </label>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit"
                                    class="btn btn-primary w-100"
                                    style="margin-right: 15px;">
                                @lang('quickadmin.qa_login')
                            </button>
                        </div>
                    </div>

                    

                </form>
            </div>
        </div>
    </div>
</div>
@endsection