<?php

class Mahasiswa extends controller
{
	public function index()
	{
		$data['mhs'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
		$data['title'] = "Daftar Mahasiswa";
		$this->view('templates/header', $data);
		$this->view('mahasiswa/index', $data);
		$this->view('templates/footer');
	}

	public function detail($id)
	{
		$data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($id);
		$data['title'] = "Detail Mahasiswa";
		$this->view('templates/header', $data);
		$this->view('mahasiswa/detail', $data);
		$this->view('templates/footer');
	}

	// function tambah data
	public function tambah()
	{
		// jika operasi dibawah menghasilkan nilai true | menghasilkan nilai > 0
		if ($this->model('Mahasiswa_model')->tambahDataMhs($_POST) > 0) {
			Flasher::setFlash('berhasil', 'ditambah', 'success');
			// maka alihkan ke lokasi berikut
			header('Location: ' . BASEURL . '/mahasiswa');
			exit;
		} else {
			Flasher::setFlash('gagal', 'ditambah', 'danger');
			header('Location: ' . BASEURL . '/mahasiswa');
			exit;
		}
	}

	public function hapus($id)
	{
		if ($this->model('Mahasiswa_model')->hapusDataMhs($id) > 0) {
			Flasher::setFlash('berhasil', 'dihapus', 'success');
			header('Location: ' . BASEURL . '/mahasiswa');
			exit;
		} else {
			Flasher::setFlash('gagal', 'dihapus', 'danger');
			header('Location: ' . BASEURL . '/mahasiswa');
			exit;
		}
	}

	public function getUbah()
	{
		echo json_encode($this->model('Mahasiswa_model')->getMahasiswaById($_POST['id']));
	}

	public function ubah()
	{
		if ($this->model('Mahasiswa_model')->ubahDataMhs($_POST) > 0) {
			Flasher::setFlash('berhasil', 'diubah', 'success');
			// maka alihkan ke lokasi berikut
			header('Location: ' . BASEURL . '/mahasiswa');
			exit;
		} else {
			Flasher::setFlash('gagal', 'diubah', 'danger');
			header('Location: ' . BASEURL . '/mahasiswa');
			exit;
		}
	}

	public function cari()
	{
		$data['mhs'] = $this->model('Mahasiswa_model')->cariDataMhs();
		$data['title'] = "Daftar Mahasiswa";
		$this->view('templates/header', $data);
		$this->view('mahasiswa/index', $data);
		$this->view('templates/footer');
	}
}
