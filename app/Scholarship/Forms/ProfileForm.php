<?php

namespace Scholarship\Forms;

use Laracasts\Validation\FormValidator;

class ProfileForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules = [
    'birthdate'       => 'required',
    'phone'           => 'required',
    'address_street'  => 'required',
    'address_premise' => 'required',
    'city'            => 'required',
    'state'           => 'required',
    'zip'             => 'required',
  ];

}