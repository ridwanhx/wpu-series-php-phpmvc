<?php

class Database
{
	// data DB dari config
	// HOSTNAME
	private $host = DB_HOST;
	// USERNAME
	private $user = DB_USER;
	// PASSWORD
	private $pass = DB_PASS;
	// DATABASE NAME
	private $db_name = DB_NAME;

	// handler
	private $dbh;
	// statement
	private $stmt;

	// buat construct
	public function __construct()
	{
		//data source name 
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

		// OPTIMASI DB
		$option = [
			// buat koneksi DB tetap terjaga / teroptimasi
			PDO::ATTR_PERSISTENT => true,
			// untuk mode error, tampilkan
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	// jalankan Query | Generic & Flexible
	public function query($query)
	{
		$this->stmt = $this->dbh->prepare($query);
	}

	// binding data / penanganan kondisi saat query
	public function bind($param, $value, $type = null)
	{
		// kalau tipenya null, lakukan sesuatu
		if (is_null($type)) {
			// jalankan switch
			switch (true) {
					// kalau valuenya int
				case is_int($value):
					// set tipenya jadi int 
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
					// selain dari itu
				default:
					// asumsikan tipenya string
					$type = PDO::PARAM_STR;
			}
		}
		// bind setiap value-nya
		$this->stmt->bindValue($param, $value, $type);
	}

	// eksekusi statement
	public function execute()
	{
		$this->stmt->execute();
	}

	// tentukan jika hasilnya banyak 
	public function resultSet()
	{
		// panggil execute
		$this->execute();
		// kembalikan nilainya keseluruhan(jadikan ASSOC)
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// jika data tunggal
	public function single()
	{
		// panggil execute
		$this->execute();
		// kembalikan nilai scr singular(jadikan ASSOC)
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	// function rowCount | cek perubahan row pada db
	public function rowCount()
	{
		// kembalikan nilai daripada statement query yang dikirim
		// * : kedua rowCount di case ini berbeda, rowCound yang coba di eksekusi disini merupakan method bawaan PDO.
		return $this->stmt->rowCount();
	}
}
