<?php

$isim = $_POST["isim"];
$soyisim = $_POST["soyisim"];
$boy= $_POST["boy"];
$kilo= $_POST["kilo"];
$yas= $_POST["yas"];
$kahvalti=$_POST["kahvalti"];
$oglen_yemegi=$_POST["oglen_yemegi"];
$aksam_yemegi=$_POST["aksam_yemegi"];
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);
$kalori_toplam = $_POST['kalori_topla'];

if ( ! $terms) {
    die("Terms must be accepted");
}   


// continue from the previous step
switch ($kalori_toplam) {
  case "+":
    // add the numbers and store the result
    $toplam_kalori = $aksam_yemegi + $oglen_yemegi+ $kahvalti;
    break;
  default:
    // display an error message if the operation is invalid
    echo "Invalid operation.";
}

///connection///
$host = "localhost";
$dbname = "kalori_hesap";
$username = "root2";
$password = "asdf";
        
$conn = mysqli_connect(hostname: $host,
                       username: $username,
                       password: $password,
                       database: $dbname);
        
if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}           
        
$sql = "INSERT INTO musteriler(isim, soyisim, boy, kilo, yas,toplam_kalori)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssiiii",
                       $isim,
                       $soyisim,
                       $boy,
                       $kilo,
                       $yas,
                       $toplam_kalori);

mysqli_stmt_execute($stmt);

echo "<p>Toplam kaloriniz {$toplam_kalori}.</p>";
 
