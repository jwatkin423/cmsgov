<?php

class HomeController extends BaseController {

  public function index() {
    return View::make('th.th')->with('title', 'Search CMS Gov');
  }

}
