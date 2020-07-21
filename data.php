<?php
//JSON
header('Content-Type: application/json');

//Baza
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'panda_rek2';

//Połączenie
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

if(!$mysqli)
{
	die("Brak połączenia z bazą" . $mysqli->error);
}

$file = 'MOCK_DATA.csv';
$content = file($file);

$array = array();
//Czyszczenie tabeli
mysqli_query($mysqli, "DELETE FROM users");

//Zapisanie zawartości pliku *.csv do tablicy
for($i = 0; $i < count($content); $i++) 
{
    $line = explode(',', $content[$i]);
    for($j = 0; $j < count($line); $j++) 
	{
        $array[$i][$j + 1] = $line[$j];
    }   
}

//Dodanie rekordów do tabeli
for($i = 1; $i < sizeof($array); $i++)
{
	$sql = "INSERT INTO users SET id = '".$array[$i][1]."', first_name = '".$array[$i][2]."', last_name = '".$array[$i][3]."',  country = '".$array[$i][4]."' ";
	$mysqli->query($sql);
}


//Pobieranie danych
$query = sprintf("SELECT COUNT(first_name) as num, country FROM users GROUP BY country ORDER BY country");

//Wykonanie zapytania
$result = $mysqli->query($query);

$data = array();
foreach ($result as $row) 
{
	$data[] = $row;
}
$result->close();

//Zakończenie połączenia
$mysqli->close();

//Print danych
print json_encode($data);