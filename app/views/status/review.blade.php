{{-- Status --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Review &amp; Submit</h1>

    <section class="segment segment--review -compact">
      <div class="wrapper">

        @if(! empty($vars->application_submit_help_text))
          <p>{{ $vars->application_submit_help_text }}</p>
        @endif

        <div class="fragment">
          <h2 class="heading -gamma">Basic Info</h2>
          <dl>
            @foreach ($profile as $key => $field)
              @if (!empty($field))
               <dt><strong>{{ snakeCaseToTitleCase($key) }}</strong></dt>
               <dd>{{ $field }}</dd>
              @endif
            @endforeach
          </dl>
          {{ link_to_route('profile.edit', 'Something wrong? Update it!', Auth::user()->id) }}
        </div>

        <div class="fragment">
          <h2 class="heading -gamma">Application</h2>
          <dl>
            @foreach ($application as $key => $field)
              {{-- did the have a value in the field --}}
              @if (!empty($field))
                {{-- does the field have a better title in the scholarship? --}}
                @if (isset($scholarship[$key]))
                  <dt><strong>{{ snakeCaseToTitleCase($scholarship[$key]) }} </strong></dt>
                @else
                  <dt><strong>{{ snakeCaseToTitleCase($key) }}</strong></dt>
                @endif
                <dd>{{ $field }}</dd>
              @endif
            @endforeach
          </dl>
          {{ link_to_route('application.edit', 'Something wrong? Update it!', Auth::user()->id) }}
        </div>


      {{ Form::open(['route' => 'review.store', 'class' => 'fragment']) }}

        {{-- Checklist --}}
        <div class="field-group -checkbox">
          {{ Form::checkbox('documentation', 1, false, ['id' => 'eligibility']); }}
          {{ Form::label('documentation', "If you are chosen as a winner, you will submit a copy of your driver's license, birth certificate or passport as proof of age and U.S. citizenship/permanent legal resident status.") }}
          {{ errorsFor('documentation', $errors); }}
        </div>

        <div class="field-group -checkbox">
          {{ Form::checkbox('factual', 1, false, ['id' => 'eligibility']); }}
          {{ Form::label('factual', "You confirm that everything written in the application is true and factual.") }}
          {{ errorsFor('factual', $errors); }}
        </div>

        <div class="field-group -checkbox">
          {{ Form::checkbox('media_release', 1, false, ['id' => 'eligibility']); }}
          {{ Form::label('media_release', "Foot Locker and TMI may use your application in any media or public relations campaigns.") }}
          {{ errorsFor('media_release', $errors); }}
        </div>

        <div class="field-group -checkbox">
          {{ Form::checkbox('rules', 1, false, ['id' => 'eligibility']); }}
          {{ Form::label('rules', "You agree to the ") }} {{ link_to('https://s3.amazonaws.com/uploads.hipchat.com/34218/1222616/xWTSRkWcE7jrdAD/Foot%20Locker%20Scholar%20Athletes%20Official%20Rules%202014-2015.pdf', "Official Rules", array('target'=>'_blank'))}}
          {{ errorsFor('rules', $errors); }}
        </div>

        <div class="field-group -action">
          {{ Form::submit('Submit application', ['class' => 'button -default', 'name' => 'complete']) }}
        </div>

      {{ Form::close() }}

      <div class="contact">
        <p>Need help? <a href="mailto:{{Config::get('mail.from.address')}}">Contact Us</a></p>
      </div>

      </div>
    </section>

  </article>
@stop
