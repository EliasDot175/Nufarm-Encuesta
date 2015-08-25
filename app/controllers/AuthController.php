<?php

class AuthController extends BaseController {

	public function showLogin()
	{
		if (Auth::check())
		{
			return Redirect::to('admin');
		}
		return View::make('login');
	}

	public function postLogin()
	{
		$data = [
			'username' => Input::get('username'),
			'password' => Input::get('password')
		];

		if (Auth::attempt($data, Input::get('remember'))) // checkbox para recordar la contraseña
		{
			return Redirect::intended('admin'); // Si los datos son correctos mostramos la página de inicio
		}

		return Redirect::back()->with('error_message', 'Usuario o contraseña incorrectos')->withInput();
	}

	public function logOut()
	{
		Auth::logout();
		return Redirect::to('login')->with('ok_message', 'Sesión finalizada correctamente');
	}

}