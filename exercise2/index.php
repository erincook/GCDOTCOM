<?php
/* Factory interfaces */
 
interface dataFactory {
    public function createData($data);
    public function fetchDataById($id);
    public function searchData($criteria);
}
 
 
/* Concrete implementations of the factory */
 
class pdoSource implements dataFactory {
	$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
	$now = time();
    public function createData($data) {
		foreach($data as $item => $value){
			$data[$item] = PDO::quote($value); // Prevent sql injection... 
		}
		try {
			$results = $dbh->query('insert into tblTest(name, description, active, created, updated ' . 
				'VALUES("' . $data['name'] . '", "' . $data['description'] . '", "' . $data['active'] . 
				'", "' . $now . '", "' . $now . '")'); 
			if($results) return true;
		} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
        return;
    }
	public function fetchDataById($id){
		try {
			$results = $dbh->query('select id, name, description, active, created, updated from tblTest where ' . 
				' id = ' . $id); 
			if($results) return $results;
		} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
        return;
	}
	public function searchData($criteria){
		if(!is_array($criteria)) return 'criteria is not an array'; 
		$query_search = 'select id, name, description, active, created, updated from tblTest where '; 
		foreach($criteria as $item => $value)
		{
			$query_search .= $item . " = '" . $value . "' and "; 
		}
		$query_search = substr($query_search, 0, -4); 
		try {
			
			$results = $dbh->query($query_search); 
			if($results ) return $results;
		} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
        return;
	}
}
class restResource implements dataFactory(){
	require_once "RESTclient.php";
	$url = "http://api.local.yahoo.com/MapsService/V1/geocode/"
	public function createData($data){
		$rest = new RESTclient();
		foreach($data as $item => $value)
		{
			$data[$item] = mysqli_real_escape_string(htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false)); //some protection in sending the data.. 
		}
		$rest->createRequest("$url","PUT",$data);
		$rest->sendRequest();
		$output = $rest->getResponse();
		return json_encode($output);
	}   /// Showing another way to query in a URL.  Best method is above... 
	public function fetchDatabyId($id){
		$base = 'http://xml.amazon.com/onca/xml3';
		$query_string = "";

		$params = array( 'id' => $id);

		foreach ($params as $key => $value) {
			$query_string .= "$key=" . urlencode($value) . "&";
		}
		$url = "$base?$query_string";
		$output = file_get_contents($url);
		return json_encode($output); 
	}
	public function searchData($criteria){
		$base = 'http://xml.amazon.com/onca/xml3';
		$query_string = "";
		foreach($criteria as $item => $value){
			$params = array( $item => $value);
		}		

		foreach ($params as $key => $value) {
			$query_string .= "$key=" . urlencode($value) . "&";
		}
		$url = "$base?$query_string";
		$output = file_get_contents($url);
		return json_encode($output); 
	}
}
 

 
/* Client */
 
$factory = new restSource();
$setData = $factory->createData($someData);
$byID = $factory->fetchDataById(4); 
$searchArray = array(
	'created' => '590786436'); 
$searchedData = $factory->searchData($searchArray); 


$factory = new pdoSource();
$setData = $factory->createData($someData);
$byID = $factory->fetchDataById(4); 
$searchArray = array(
	'created' => '590786436'); 
$searchedData = $factory->searchData($searchArray); 
?>