<?php

use Lib\Validation\UserCreateValidator as UserCreateValidator;
use Lib\Validation\UserUpdateValidator as UserUpdateValidator;
use Lib\Gestion\UserGestion as UserGestion;

class UserController extends BaseController {

    protected $create_validation;
	protected $update_validation;
	protected $user_gestion;

	public function __construct(
		UserCreateValidator $create_validation, 
		UserUpdateValidator $update_validation,
		UserGestion $user_gestion
		)
	{
		parent::__construct();
		$this->beforeFilter('auth');
		$this->create_validation = $create_validation;
		$this->update_validation = $update_validation;
		$this->user_gestion = $user_gestion;
	}



	public function index()
	{
		return View::make('user.index')->with('users', User::all());
	}

	public function create()
	{
		return View::make('user.create')->with('users', User::all());
	}

	
	   
	public function store()
	{
		if ($this->create_validation->fails()) {
		  return Redirect::back()
		  ->withInput()
		  ->withErrors($this->create_validation->errors());
		} else 
		{
			$this->user_gestion->store();	
			return Redirect::back()->with('confirm','L\'utilisateur a bien été créé.');
		}		
	}

	public function show($id)
	{
		return View::make('user.show', $this->user_gestion->show($id));
	}


    public function edit($id)
	{
		
		if (Auth::user()->id != $id)
		{
			App::abort(404);
		}
		else
		{
			return View::make('user.edit',  $this->user_gestion->edit($id));
		}
	}
	
	public function update($id)
	{
		if ($this->update_validation->fails($id))
		{
		  return Redirect::back()
		  ->withInput()
		  ->withErrors($this->update_validation->errors());
		} 
		else 
		{
			$this->user_gestion->update($id);
			return Redirect::back()->with('confirm','Vos modifications ont bien été enregistré.');
		}		
	}

	public function destroy($id)
	{
		$this->user_gestion->destroy($id);
		return Redirect::back()->with('delete','L\'utilisateur a bien été supprimé.');
	}
}