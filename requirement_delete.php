<?php 

require_once('functions.php');

if(!$_SESSION['login']) {
    header("Location: login.php");
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: index.php?page=requirements");
}

if(hapusSyarat($id) > 0) {
    echo "<script>
        alert('Data berhasil dihapus.');
        document.location.href = 'index.php?page=requirements';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus.');
        document.location.href = 'index.php?page=requirements';
    </script>";
}