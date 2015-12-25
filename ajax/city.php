<?php
mysql_connect('localhost', 'root', '' );
mysql_select_db('rtibal4z_city');
mysql_query('set names utf8');

$id   = (int)$_POST['id']; // id объекта (страна или регион)
$type = $_POST['type']; // тип списка, который нужно получить (города или регионы)

sleep(1); // спешить нам некуда

if ($type == 'city2') {
	// выбираем города в данном регионе
	$result = mysql_query('SELECT * 
    	                   FROM city 
    	                   WHERE region_id = '.$id.' 
    	                   ORDER BY name');
	if (!empty($result)) {
		echo "out.options[out.options.length] = new Option('выберите город...','none');\n";
		while ($city = mysql_fetch_array($result)) {
			echo "out.options[out.options.length] = new Option('".$city['name']."','".$city['name']."');\n";
		}
	}
	else {
		echo "out.options[out.options.length] = new Option('нет городов','none');\n";
	}
}
if ($type == 'region') {
	// выбираем регионы в данной стране
	$result = mysql_query('SELECT * 
    	                    FROM region 
    	                    WHERE country_id = '.$id.' 
    	                    ORDER BY name');
	if (!empty($result)) {
		echo "out.options[out.options.length] = new Option('выберите регион...','none');\n";
		while ($region = mysql_fetch_array($result)) {
			echo "out.options[out.options.length] = new Option('".$region['name']."','".$region['region_id']."');\n";
		}
	}
	else {
		echo "out.options[out.options.length] = new Option('нет регионов','none');\n";
	}
}
?>
