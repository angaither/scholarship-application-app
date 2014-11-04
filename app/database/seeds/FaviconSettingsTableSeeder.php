<?php

class FaviconSettingsTableSeeder extends Seeder {

  public function run()
  {
    Setting::insert([
      'category'    => 'meta_data',
      'key'         => 'favicon',
      'value'       => '',
      'type'        => 'image',
      'description' => 'Upload a custom favicon (must be of type ".ico").'
    ]);
  }

}
