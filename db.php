<?php 

/* Měří čas SQL dotazů */

$seznamDotazu = array();
$celkovaDoba = 0;

function query($dotaz, $data = array()) {
	global $pdo, $seznamDotazu, $celkovaDoba;
	$zacatek = microtime(true); 

	try {
		$sql = $pdo->prepare($dotaz);
		$sql->execute($data);
	}
	catch (PDOException $e) {
	    die('Error: ' . $e->getMessage() . ' Dotaz: ' . $dotaz . " Data:" . implode("; ", $data));
	}

	$konec = microtime(true);

	$rozdil = ($konec - $zacatek) * 1000;

	array_push($seznamDotazu, array("sql" => $dotaz, "cas" => $rozdil));
	$celkovaDoba += $rozdil;

	return $sql;
}

function vypisDotazu() {
	global $seznamDotazu, $celkovaDoba;
	echo "<ol>";
	foreach ($seznamDotazu as $dotaz) {
		echo "<li><b>" . round($dotaz["cas"], 4) . "</b> ms (" . round(($dotaz["cas"] / $celkovaDoba) * 100, 2) . " %)<br>"  . $dotaz["sql"];
	}

	echo "</ol>";
}