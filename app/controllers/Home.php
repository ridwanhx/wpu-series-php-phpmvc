<?php

class Home extends Controller
{
	// method default
	public function index()
	{
		$data['nama'] = $this->model('User_model')->getUser();
		$data['title'] = "Home";
		// panggil method yang ada di core/Controller.php
		$this->view('templates/header', $data);
		$this->view('home/index', $data);
		$this->view('templates/footer');
	}
}