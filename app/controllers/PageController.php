<?php

class PageController extends \BaseController {

  /**
   * Display a listing of the resource.
   * GET /page
   *
   * @return Response
   */
  public function index()
  {
   $pages = DB::table('pages')->get();
   return View::make('admin.page.index', compact('pages'));

  }

  /**
   * Show the form for creating a new resource.
   * GET /page/create
   *
   * @return Response
   */
  public function create()
  {
    return View::make('admin.page.create');
  }

  /**
   * Store a newly created resource in storage.
   * POST /page
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::all();

    $page = new Page;
    foreach ($input as $key => $field)
    {
      if ($key == 'hero_image' && Input::hasFile('hero_image'))
      {
        $file = Input::file('hero_image');
        $filename = $file->getClientOriginalName();
        $file->move(public_path() . '/pages/images/', $filename);
        $page->$key = $filename;
      }
      // skip form token, but handle everything else
      else if ($key !== '_token')
      {
        $page->$key = $field;
      }
    }
    $page->save();

    return Redirect::route('admin')->with('flash_message', 'Static page has been saved!');
  }

  /**
   * Display the specified resource.
   * GET /page/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   * GET /page/{id}/edit
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $page = Page::whereId($id)->firstOrFail();
    return View::make('admin.page.edit')->with(compact('page'));
  }

  /**
   * Update the specified resource in storage.
   * PUT /page/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   * DELETE /page/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }

}