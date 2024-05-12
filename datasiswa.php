<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    .taa {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    form {
        margin-top: 20px;
    }

    label {
        margin-bottom: 5px;
        color: #333;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .but1 {
        padding: 10px 20px;
        background-color: green;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .but2 {
        padding: 10px 20px;
        background-color: red;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .hapus {
        color: #f44336;
        text-decoration: none;
    }

    .hapus:hover {
        text-decoration: underline;
    }

    p {
        margin-top: 10px;
    }
</style>

    <div class="taa">
    <h1>Data Siswa Kelas 10</h1>
    <form method="post" action="" style="display:flex; flex-direction:column;">
        <label for="Siswa">Nama Siswa</label>
        <input type="text" name="siswa" id="siswa" placeholder="Input Nama">
        <label for="NIS">NIS</label>
        <input type="number" name="nis" id="nis" placeholder="Input NIS">
        <label for="Rayon">Rayon</label>
        <input type="text" name="rayon" id="rayon" placeholder="Input Rayon">
        <button class="but1" type="submit" name="kirim" style="margin-top:10px;">Kirim</button>
        <button class="but2" type="submit" name="reset" style="margin-top:15px;">Reset</button>
    </form>

    <?php
    // RESET BUTTON
    session_start();
    if(isset($_POST['reset'])){
        session_unset();
        header('Location: '. $_SERVER['PHP_SELF']);
        exit;
    }
    // HAPUS SATU BUAH DATA
    if(isset($_GET['hapus'])){
        $index = $_GET['hapus'];
        unset($_SESSION['dataSiswa'][$index]);
    }
    // IF ARRAY MULTIDIMENSION NOT FOUND THEN MADE FIRST
   if(!isset($_SESSION['dataSiswa'])){
    $_SESSION['dataSiswa'] = array();
   }

    // IF ARRAY FOUND, THEN MADE ARRAY FROM USER INPUT DATA
    if(isset($_POST['kirim'])){
    if(@$_POST['siswa'] && @$_POST['nis'] && @$_POST['rayon']){
        $data = [
            'siswa' => $_POST['siswa'],
            'nis' => $_POST['nis'],
            'rayon' => $_POST['rayon']
        ];
        array_push($_SESSION['dataSiswa'], $data);
        header('Location: '. $_SERVER['PHP_SELF']);
        exit;
    }else{
        echo "<p>Lengkapi Data</p>";
    }
}
if(!empty($_SESSION['dataSiswa'])){
foreach($_SESSION['dataSiswa'] as $index=> $value){
    echo "<br>";
    echo "Nama Siswa :". $value['siswa'] . "<br>";
    echo "NIS : " . $value['nis']."<br>";
    echo "Rayon : " .  $value ['rayon']. "<br>";
    echo '<a href="?hapus=' . $index . '" class="hapus">HAPUS</a>' . "<br>";
}
}
?>
</div>
</body>
</html>