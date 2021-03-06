@extends('layouts.master')

<!-- Main Content -->
@section('main_content')
<div class="page">

    @if (session('status') == "passwords.sent")
        <div class="flash-message -success">
            We sent you an email to reset your password!
        </div>
    @endif

    <h1 class="__title heading -beta text-primary-color">Forgot Password</h1>

    <div class="segment -compact">
          <div class="wrapper">
            <p>Please provide the email address that you used when you signed up to apply for a scholarship.</p>
            <p>We will send you an email that will allow you to reset your password.</p>
                    

                    <form class="field-group" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>There is no account for that email.</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br/>
                        <div class="field-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="button -default">
                                    <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
