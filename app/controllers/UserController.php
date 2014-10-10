<?php

class UserController extends \BaseController {

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $user = User::with('application', 'profile')->find($id);
    $race = Profile::with('race')->find($user->profile->id);
    $application = Application::with('recommendation', 'rating')->find($user->application->id);
    foreach ($application->recommendation as $rec) {
      $recommendations = Recommendation::with('recommendation_token')->find($rec->id);
    }
    $user->delete();
    $race->delete();
    $application->delete();
    $recommendations->delete();

    return "done";
  }
}