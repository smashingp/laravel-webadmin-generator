<?php

class LoginController extends \BaseController {
    public function login() {
        if ($this->isPostRequest()) {
            $validator = $this->getLoginValidator();
            if ($validator->passes()) {
                $credentials = $this->getLoginCredentials();
                if (Auth::attempt($credentials)) {
                    return Redirect::intended("dashboard");
                }
                return Redirect::back()->withErrors(array("password" => "Usuário ou senha inválidos."));
            } else {
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }

        return View::make("layout.login");
    }

    public function logout() {
        Auth::logout();
        return Redirect::route("login");
    }

    protected function isPostRequest() {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    protected function getLoginValidator() {
        return Validator::make(Input::all(), array(
                    "username" => "required",
                    "password" => "required"
        ));
    }

    protected function getLoginCredentials() {
        return array("email" => Input::get("username"), "password" => Input::get("password"), "type" => 1);
    }
    
    
}