<?php

namespace Fantasee\Http\Controllers\Developer;

use Illuminate\Http\Request;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;

class ReactController extends Controller
{
    public function index() {
      return view('developer.react.index');
    }
}
