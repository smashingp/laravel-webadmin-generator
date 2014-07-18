<?php

class BaseController extends Controller {

    protected $view_data = array();

    public function __construct() {
        $this->view_data['title'] = 'Dashboard';
        $this->view_data['user']  = NULL;
        if(Auth::Check()) {
            $this->view_data['user']    = Auth::user();
        } 
        $this->view_data["breadcrumb"] = "Dashboard";
        $this->view_data["section"]    = "Dashboard";
        $this->view_data["secdesc"]    = "Control panel"; 
        
        $this->view_data["activemenu"] = 1;
    }
    
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

}
