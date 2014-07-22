<?php

class UsersController extends \BaseController {

    /**
     * Display a listing of users
     *
     * @return Response
     */
    public function index() {
        
        $busca = "";
        if (Request::has('q')) {
            $busca = Input::get('q');
            $usuarios = User::whereRaw("name LIKE '%$busca%' or surname LIKE '%$busca%' or email LIKE '%$busca%'");
            $usuarios = $usuarios->paginate(PAGINATION_USERS);
        } else {
            $usuarios = User::paginate(PAGINATION_USERS);
        }        
        
        $this->view_data["title"] = "Usuários";
        $this->view_data["breadcrumb"] = "Usuários";
        $this->view_data["section"] = "Usuários";
        $this->view_data["secdesc"] = "Gerenciamento de usuários";
        $this->view_data["activemenu"] = 2;    
        $this->view_data["users"] = $usuarios;
        $this->view_data["busca"] = $busca;
        return View::make('users.index', $this->view_data);
    }

    public function listAjax() {
        if(Request::ajax()) {
            $busca = Request::input('email_to');
            $us1 = User::whereRaw("name LIKE '%$busca%' or email LIKE '%$busca%'")->get();
            $us2 = compact("us1");
            return Response::json($us2)->header('Content-Type', 'application/json');
        } else {
            return Response::json(array("status"=>403,"message"=>"invalid method request"))->header('Content-Type', 'application/json');
        }
    }
    
    /**
     * Show the form for creating a new user
     *
     * @return Response
     */
    public function create() {
        return View::make('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store() {
        $validator = Validator::make($data = Input::all(), User::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        User::create($data);

        return Redirect::route('users.index');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $user = User::findOrFail($id);
        $this->view_data["title"] = "Detalhe do Usuário";
        $this->view_data["breadcrumb"] = array();
        $this->view_data["breadcrumb"][] = array("name" => "Usuários", "url" => "/users", "active" => "");
        $this->view_data["breadcrumb"][] = array("name" => "Detalhe", "url" => "", "active" => "active");
        $this->view_data["section"] = "Usuário";
        $this->view_data["secdesc"] = "Detalhe do usuário";
        $this->view_data["activemenu"] = 2;        
        $this->view_data["user"] = $user;
        return View::make('users.show', $this->view_data);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $user = User::find($id);

        return View::make('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $user = User::findOrFail($id);

        $validator = Validator::make($data = Input::all(), User::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user->update($data);

        return Redirect::route('users.index');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
         User::destroy($id);
//        $user = User::findOrFail($id);
//        if ($user->status == -1) {
//            $user->status = 1;
//        } else {
//            $user->status = -1;
//        }
//
//        $user->save();
        return Redirect::route('users.index');
    }

    public function chgStatus($id) {
        // User::destroy($id);
        $user = User::findOrFail($id);
        if ($user->status == -1) {
            $user->status = 1;
        } else {
            $user->status = -1;
        }

        $user->save();
        return Redirect::route('users.index');
    }    
    
}
