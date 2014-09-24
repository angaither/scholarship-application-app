<?php

use Scholarship\Forms\ReviewForm;

class StatusController extends \BaseController {

  /**
  * @var reviewForm
  */
  protected $reviewForm;

  function __construct(ReviewForm $reviewForm)
  {
    $this->reviewForm = $reviewForm;
  }
  /**
   * User status page.
   * This page shows an overall glance of the status of the application.
   * Displays App, profile completness as well as recs, if any.
   */
  public function status() {
    $user = Auth::user();

    // @TODO: are these queries too heavy?
    // Get all info about application status.
    $application = Application::where('user_id', $user->id)->first();
    $app_complete = Application::isComplete($user->id);

    $profile = Profile::where('user_id', $user->id)->first();
    $prof_complete = Profile::isComplete($user->id);
    if ($application) {
      // Get recommendations
      $recommendations = Recommendation::where('application_id', $application->id)->get();

      foreach($recommendations as $rec) {
        $rec->isRecommendationComplete($rec);
      }
      $recommendations = $recommendations->toArray();
    }

    // If both app & profile are complete add a link to review & submit.
    if ($app_complete && $prof_complete) {
      $submit = link_to_route('review', 'Review & Submit Application', array($user->id));
    }

    return View::make('status.index', compact('profile', 'application', 'recommendations', 'app_complete', 'prof_complete', 'submit'));
  }

  /**
   * Creates the review & submit applicaiton page for the user.
   * Gathers all fields that the user has filled out to display.
   */
  public function review($id)
  {
    // Get all the things.
    $application = Application::where('user_id', $id)->select('accomplishments', 'activities', 'essay1', 'essay2', 'hear_about', 'link', 'test_type', 'test_score', 'gpa')->first()->toArray();
    $profile = Profile::where('user_id', $id)->select('birthdate', 'phone', 'address_street', 'address_premise', 'city', 'state', 'zip', 'gender', 'grade', 'school')->first()->toArray();
    $scholarship = Scholarship::getCurrentScholarship()->select(array('label_app_accomplishments as accomplishments', 'label_app_activities as activities', 'label_app_essay1 as essay1', 'label_app_essay2 as essay2'))->first()->toArray();

    return View::make('status.review', compact('application', 'profile', 'scholarship'));
  }

  /**
   * Form submission handler for the review page.
   * This saves that the application has been submitted, making it uneditable to the user.
   */
  public function submit()
  {

    $input = Input::all();
    $this->reviewForm->validate($input);
    $application = Application::where('user_id', Auth::user()->id)->firstorFail();
    $application->complete = 1;
    $application->save();

    return Redirect::route('status')->with('flash_message', 'Sweet, you submitted your app');
  }

  //@TODO refactor, move and combine into one function... etc etc. this code is the worst.
  public function resendEmailRequest()
  {
    // @TODO: redo this depending to user the first email.
    $rec_id = Input::get('id');
    $recommendation = Recommendation::whereId($rec_id)->firstOrFail();
    $token = $recommendation->generateRecToken($recommendation);

    $link = link_to_route('recommendation.edit', "Please provide a recommendation", array($recommendation->id,'token' => $token));
    $email = new Email;
    $data = array(
      'link' => $link,
      'applicant_name' => Auth::user()->first_name .  " " . Auth::user()->last_name,
      );
    $email->sendEmail('request', 'recommender', $recommendation->email, $data);

    return Redirect::route('status')->with('flash_message', 'We sent another email!');
  }

}
