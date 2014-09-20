{{-- Profile Basic Info: Create --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Basic Info</h1>

      {{ $help_text }}
        {{ Form::open(['route' => 'profile.store']) }}

          <div class="progress"><strong>Step 1 of 3</strong></div>

          @include('profile/partials/_form_profile')


        {{-- Submit Button --}}
        <div class="field-group">
           {{ Form::submit('Save as Draft', ['class' => 'button -default', 'name' => 'draft']) }}
           {{ Form::submit('Save and Continue', ['class' => 'button -default', 'name' => 'complete']) }}
        </div>

        {{ Form::close() }}

      </div>
    </div>

  </article>
@stop
