<?php

class Controller
{
	// function view
	public function view($view, $data = [])
	{
		// inisialisasi direktori views berada
		require_once '../app/views/' . $view . '.php';
	}

	public function model($model)
	{
		require_once '../app/models/' . $model . '.php';
		return new $model;
	}
}