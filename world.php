<?php
$host = getenv('IP');
$username = 'root';
$password = 'naruto';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
#$stmt = $conn->query("SELECT * FROM countries");
$country = ucfirst(strtolower($_REQUEST["country"]));
#print $country;
if ($country == ""){
	$stmt = $conn->query("SELECT * FROM countries");
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
	$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE '%$country%'");
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>