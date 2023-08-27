<?php

class Model{
    private $conn;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'latihan_mvc');
    }

    function read() {
        $stmt = $this->conn->query("SELECT * FROM mahasiswa");
        $result = $stmt->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $this->conn->close();
        return $result;
    }

    function insert($nim, $nama, $angkatan, $prodi, $kelas) {
        $stmt= $this->conn->prepare("INSERT INTO mahasiswa (nim, nama, angkatan, prodi, kelas) VALUES (?,?,?,?,?)");
        $stmt->bind_param('issss', $nim, $nama, $angkatan, $prodi, $kelas);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();

    }

    function update($nim_lama, $nim_baru, $nama, $angkatan, $prodi, $kelas) {
        $stmt= $this->conn->prepare("UPDATE mahasiswa SET nim = ?, nama = ?, angkatan = ?, prodi = ?, kelas = ? WHERE nim = ?");
        $stmt->bind_param('issssi', $nim_baru, $nama, $angkatan, $prodi, $kelas, $nim_lama);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();

    }

    function delete($nim) {
        $stmt = $this->conn->prepare("DELETE FROM mahasiswa WHERE nim = ?");
        $stmt->bind_param("i", $nim);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }

}
?>