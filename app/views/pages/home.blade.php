@extends('layouts.master')

@section('main_content')
  <h1>2014 Scholarship Application</h1>

  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, adipisci!</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio doloribus, cumque voluptatem, dolor velit eveniet quidem. Dolore incidunt a asperiores vero natus est quibusdam suscipit quos magnam iste dignissimos, modi pariatur consequuntur soluta, architecto commodi!</p>

  @if (Auth::guest())
    <a href="/register">Register & Apply</a> or <a href="/login">Login</a>
  @endif
@stop
