<?php

$mysqli = new mysqli("url", "user", "pass", "database");
mysqli_set_charset($mysqli, 'utf8');
set_time_limit(0);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$le = 'test.txt';

$handle = fopen( $le, 'r' );

$ler = fread( $handle, filesize($le) );

$pespeslabauto = explode(',', $ler);

    foreach ($pespeslabauto as $value) {

        $sql = "SELECT PesPesLabAuto FROM periodos_medicao WHERE PesPesLabAuto='$value'";

        $result = mysqli_query( $mysqli, $sql );
        $row = mysqli_num_rows($result);

        if (!empty($row)) {
            echo "LAB já existe '$value'</br>";
        }
        else {

            $query = "INSERT INTO periodos_medicao
            (`id`, `PesPesLabAuto`, `PesPesCliAuto`, `periodo`, `solicita_nao_pago`)
            VALUES('', '$value', '0', '8', '1')";

            $mysqli->query($query);

            echo $query;
            echo "\n";
        }           

    }

fclose($handle);

?>
