<?php

class App
{
	// property
	protected $controller = 'Home';
	protected $method = 'index';
	protected $params = [];

	// method construct
	public function __construct()
	{
		// menampung nilai daripada array yang dikirimkan lewat url
		// element2 dibawah hanya bertugas mengecek apakah nilai yang dikirimkan lewat url memenuhi kriteria
		$url = $this->parseURL();
		
		// controller
		// SOLUSI ketika nilainya NULL, jadikan nilai default $url[0] = 'Home';
		if ($url == NULL) { $url = [$this->controller]; }
		/* cek apakah file ada didalam folder controllers,
		gabung dengan $url index pertama, gabung dengan ekstensi daripada file .php */
		if (file_exists('../app/controllers/' . $url[0] . '.php')) {
			// jika ada, timpa dengan controller yang baru
			$this->controller = $url[0];
			// hilangkan controller dari element array-nya
			unset($url[0]);
		}
		// arahkan ke folder controllers/ .gabung dengan nilai property controller yang ada gabung ekstensi file 
		require_once '../app/controllers/' . $this->controller . '.php';
		// timpa dengan nilai instansiasi, sekarang Classnya ter-instansiasi | agar kita bisa panggil method-nya nanti
		$this->controller = new $this->controller;



		// method
		// cek apakah method yang dikirimkan lewat url ada didalam controller
		if (isset($url[1])) {
			// cek dari controller-nya, apakah method-nya ada
			if (method_exists($this->controller, $url[1])) {
				// kalau ada, timpa dengan method yang baru
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		// parameters
		// cek apakah ada parameters yang dikirimkan lewat url
		if (!empty($url)) {
			// property params akan diisi oleh nilai daripada array yang dikirimkan lewat url
			$this->params = array_values($url);
		}
		// jalankan controller & method, serta kirimkan params jika ada
		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	public function parseURL()
	{
		if (isset($_GET['url'])) {
			// hilangkan "/" di akhir url
			$url = rtrim($_GET['url'], '/');
			// lakukan pengamanan pada url
			$url = filter_var($url, FILTER_SANITIZE_URL);
			// pecah url menjadi string dengan delimiternya "/"
			$url = explode('/', $url);
			return $url;
		}
	}
}