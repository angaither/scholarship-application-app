@extends('layouts.master')

@section('main_content')

  <h1>Edit Profile</h1>

  {{ Form::model($recommendation, ['method' => 'PATCH', 'route' => ['recommendation.update', $recommendation->id]]) }}

    {{-- This will be seen by the recomender --}}


    {{-- This will be seen by the applicant --}}
    Please fill all field with information for the recommender.
    {{-- First Name --}}
    <div>
      {{ Form::label('first_name', 'First Name: ') }}
      {{ Form::text('first_name', $recommendation->first_name, array('disabled')) }}
      {{ errorsFor('first_name', $errors); }}
    </div>

    {{-- Last Name --}}
    <div>
      {{ Form::label('last_name', 'Last Name: ') }}
      {{ Form::text('last_name', $recommendation->last_name, array('disabled'))  }}
      {{ errorsFor('last_name', $errors); }}
    </div>

    {{-- Email --}}
    <div>
      {{ Form::label('email', 'Email: ') }}
      {{ Form::email('email', $recommendation->email, array('disabled')) }}
      {{ errorsFor('email', $errors); }}
    </div>


    {{-- Phone Number --}}
    <div>
      {{ Form::label('phone', 'Phone Number: ') }}
      {{ Form::text('phone') }}
      {{ errorsFor('phone', $errors); }}
    </div>



    {{-- Rank Character --}}
    <div>
      {{ Form::label('rank_character', $scholarship->label_rec_rank_character) }}
      {{ Form::text('rank_character') }}
      {{ errorsFor('rank_character', $errors); }}
    </div>

    {{-- Rank Additional --}}
    <div>
      {{ Form::label('rank_addiational', $scholarship->label_rec_rank_additional) }}
      {{ Form::text('rank_addiational') }}
      {{ errorsFor('rank_addiational', $errors); }}
    </div>


  {{-- Essay1 --}}
  <div>
    {{ Form::label('essay1', $scholarship->label_rec_essay1) }}
    {{ Form::textarea('essay1') }}
    {{ errorsFor('essay1', $errors); }}
  </div>

    {{-- Submit Button --}}
    <div>
      {{ Form::submit('Update Profile') }}
    </div>

  {{ Form::close() }}

@stop
