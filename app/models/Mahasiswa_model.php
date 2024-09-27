<?php

class Mahasiswa_model
{
	// tampung nama tabel kedalam var | opsional
	private $table = 'mahasiswa';
	// simpan var untuk menampung class Database
	private $db;

	// buat construct
	public function __construct()
	{
		// koneksikan | instansiasi langsung ke database
		$this->db = new Database;
	}

	public function getAllMahasiswa()
	{
		// jalankan query
		$this->db->query('SELECT * FROM ' . $this->table);
		// kembalikan hasilnya | semuanya
		return $this->db->resultSet();
	}

	public function getMahasiswaById($id)
	{
		// jalankan query & simpan data untuk di-binding
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_mhs=:id_mhs');
		// jalankan binding
		$this->db->bind('id_mhs', $id);
		// kembalikan nilai | singular
		return $this->db->single();
	}

	// model tambah data mahasiswa
	public function tambahDataMhs($data)
	{
		// tampung perintah query kedalam var
		$query = "INSERT INTO mahasiswa VALUES('', :nama, :nrp, :email, :jurusan)";
		// daftarkan var query kedalam method query
		$this->db->query($query);

		// lakukan binding data(parameter, nilai)
		// identifikasi type | parameter ke-3 method binding akan ditangani oleh PDO
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('nrp', $data['nrp']);
		$this->db->bind('email', $data['email']);
		$this->db->bind('jurusan', $data['jurusan']);

		// eksekusi | instansiasi perintah
		$this->db->execute();
		// kembalikan kondisi di DB apakah data bertambah(true | > 0)
		return $this->db->rowCount();
	}

	public function hapusDataMhs($id)
	{
		$query = "DELETE FROM mahasiswa WHERE id_mhs=:id_mhs";
		$this->db->query($query);

		$this->db->bind('id_mhs', $id);

		$this->db->execute();

		return $this->db->rowCount();
	}


	public function ubahDataMhs($data)
	{
		// tampung perintah query kedalam var
		$query = "UPDATE mahasiswa SET 
		nama = :nama, nrp = :nrp, email = :email, jurusan = :jurusan WHERE id_mhs=:id_mhs";
		// daftarkan var query kedalam method query
		$this->db->query($query);

		// lakukan binding data(parameter, nilai)
		// identifikasi type | parameter ke-3 method binding akan ditangani oleh PDO
		$this->db->bind('id_mhs', $data['id']);
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('nrp', $data['nrp']);
		$this->db->bind('email', $data['email']);
		$this->db->bind('jurusan', $data['jurusan']);

		// eksekusi | instansiasi perintah
		$this->db->execute();
		// kembalikan kondisi di DB apakah data bertambah(true | > 0)
		return $this->db->rowCount();
	}

	public function cariDataMhs()
	{
		$keyword = $_POST['keyword'];

		$query = "SELECT * FROM mahasiswa WHERE
			nama LIKE :keyword OR
			nrp LIKE :keyword OR
			email LIKE :keyword OR
			jurusan LIKE :keyword
		";

		$this->db->query($query);

		$this->db->bind('keyword', "%$keyword%");

		return $this->db->resultSet();
	}
}
