<?php error_reporting(E_ERROR | E_WARNING | E_PARSE); 
$host = getenv('IP');
$username = 'root';
$password = 'naruto';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
#$stmt = $conn->query("SELECT * FROM countries");
$country = ucfirst(strtolower($_REQUEST["country"]));
$context = $_REQUEST["context"];

#print $country;
#print $context;
if ($country == ""){
	$stmt = $conn->query("SELECT * FROM countries");
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}elseif($context !=""){
	$stmt = $conn->prepare("SELECT code FROM countries WHERE name LIKE '%$country%'");
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	#print_r ($results);
	
	$code = $results[0]['code'];
	$newstmt =$conn->prepare("SELECT * FROM cities WHERE country_code LIKE '%$code%'");
	$newstmt->execute();
	
	$results = $newstmt->fetchAll(PDO::FETCH_ASSOC);
	#print_r ($results);

}else{
	$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE '%$country%'");
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	#print_r ($results);
}

/*?>
 <ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul> 
*/
#print $context; ?>

<?php if(empty($context)){
?>
    <table class="table">
		<thead class="head">
			<tr >
				<th >Name</th>
				<th >Continent</th>
				<th >Independence</th>
				<th >Head of State</th>
			</tr>
		</thead>
		<?php foreach ($results as $row): ?>
			<tr class="row">
				<td  ><?= $row['name']; ?></td>
				<td  ><?= $row['continent']; ?></td>
				<td  ><?= $row['independence_year']; ?></td>
				<td  ><?= $row['head_of_state'];?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php }else{ ?>
    <table class="table">
		<thead class="head">
			<tr >
				<th >Name</th>
				<th >District</th>
				<th >Population</th>
			</tr>
		</thead>
		<?php foreach ($results as $row): ?>
			<tr class="row">
				<td  ><?= $row['name']; ?></td>
				<td  ><?= $row['district']; ?></td>
				<td  ><?= $row['population']; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php } ?>

