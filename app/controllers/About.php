<?php

// Child daripada class Controller yang ada didalam folder core
class About extends Controller
{
	public function index($nama = "Muhamad Ridwan", $pekerjaan = "FullStack Developer", $umur = "18")
	{
		// ambil setiap isi parameter, kirim ke class view() yang ada di class Parent(Ctrllr)
		$data['nama'] = $nama;
		$data['umur'] = $umur;
		$data['pekerjaan'] = $pekerjaan;

		$data['title'] = "About";

		// kerangka penghubung setiap tampilan pada UI
		$this->view('templates/header', $data);
		$this->view('about/index', $data);
		$this->view('templates/footer');
	}

	public function page() 
	{
		$data['title'] = "Page";
		$this->view('templates/header', $data);
		$this->view('about/page');
		$this->view('templates/footer');
	}
}