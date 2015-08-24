<?php
use Illuminate\Support\MessageBag;
use Illuminate\Console\Command;



class ReportsController extends BaseController {
	public function index(){
		return View::make('/reports/index');
	}

}

