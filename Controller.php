<?php
include "Model.php";
include "View.php";

class Controller{

    /**
     * Class constructor.
     */
    public function __construct()
    {
       if (isset($_GET['aksi'])) {
            switch ($_GET['aksi']) {
                case 'create':
                    $this->create();
                    break;
                case 'update':
                    $this->update();
                    break;
                case 'delete':
                    $this->delete();
                    break;
                default:
                    $this->read();
                    break;
            }
       }else {
            $this->read();
       }
    }

        function read() {
            $mRead = new Model();
            $data = $mRead->read();

            $vBeranda = new View();
            $vBeranda->beranda($data);
        }

        function create() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
                $mCreate = new Model();
                $nim = $_POST['nim'];
                $nama = $_POST['nama'];
                $angkatan = $_POST['angkatan'];
                $prodi = $_POST['prodi'];
                $kelas = $_POST['kelas'];
                $mCreate->insert($nim, $nama, $angkatan, $prodi, $kelas);
            }
            header("Location: index.php");
        }

        function update() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
                $mUpdate = new Model();
                $nim_baru = $_POST['nim_baru'];
                $nama = $_POST['nama'];
                $angkatan = $_POST['angkatan'];
                $prodi = $_POST['prodi'];
                $kelas = $_POST['kelas'];
                $nim_lama = $_POST['nim_lama'];
                $mUpdate->update($nim_lama, $nim_baru, $nama, $angkatan, $prodi, $kelas);
            }
            header("Location: index.php");
        }

        function delete() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
                $mDelete = new Model();
                $id = $_POST['id'];
                $mDelete->delete($id);
            }

            header("Location: index.php");
        }
}
?>