<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class ContentController extends Controller
{
	public function info()
	{
		return view('index.info.info');
	}
}