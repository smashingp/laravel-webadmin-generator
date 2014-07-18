<?php

class DashboardController extends \BaseController {
    
    public function index() {
                return View::make("inicio", $this->view_data);
    }
    
}