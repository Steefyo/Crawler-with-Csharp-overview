<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$urls = ["http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/bae90cb2-90cc-4ef7-9752-672ef216a52c",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/fa25b695-5055-40a5-9930-ac2aa77ba975",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/dc96d900-8446-4e99-8a09-dd60da167fc8",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/4988115d-7c6e-4a4a-bd9d-5605e692c2cb",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/b702aa0d-1392-4b9c-a158-5ead5179f9ad",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/ac1a8242-ea7d-48ff-8935-9fbe07691d77",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/31938897-d183-426d-ad6b-0c613a147cea",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/b00dce24-b1ae-4526-895f-814cb16f354e",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/26b41495-1c1d-46e3-8988-eba02cf85fa8",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/d6ea05f4-e484-4db8-84cd-a0ac20db1f1f",
"http://opendata.technolution.nl/opendata/parkingdata/v1/dynamic/328cbed1-dfe1-4984-8cf6-4b4d9671b168"];

foreach ($urls as $url) {


try{
  	$result = json_decode(file_get_contents($url), true);
		$current = date("d-m-Y.H:i:s");
		$addArray= array("DateTime" => $current);
		#$test = array_push($result, "DateTime" => $current);
		$remove_array = "parkingFacilityDynamicInformation";

		$result[$remove_array]["DateTime"] = $current;
		$result[$remove_array]["open"] = $result[$remove_array]["facilityActualStatus"]["open"];
		$result[$remove_array]["full"] = $result[$remove_array]["facilityActualStatus"]["full"];
		$result[$remove_array]["parkingCapacity"] = $result[$remove_array]["facilityActualStatus"]["parkingCapacity"];
		$result[$remove_array]["vacantSpaces"] = $result[$remove_array]["facilityActualStatus"]["vacantSpaces"];

		unset($result[$remove_array]["facilityActualStatus"]);
		unset($result[$remove_array]["identifier"]);
		unset($result[$remove_array]["description"]);

		$finalArrayBeforeJSON = $result[$remove_array];
		$finalArray = json_encode($finalArrayBeforeJSON);
		echo "<pre>";
		print_r($finalArray);
		echo "</pre>";
		echo getcwd();

		$file = fopen($finalArrayBeforeJSON["name"].'.'.date("d-m-Y").".txt", "a+");
		fwrite($file, $finalArray);
		fclose($file);
}
catch(Exception $ex){
    echo 'Got it!';
}
		

}


?>