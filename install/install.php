<?php
// this script will run after a successfull heroku deployment

// create the database
$url = parse_url(getenv('CLEARDB_DATABASE_URL') ? getenv('CLEARDB_DATABASE_URL') : getenv('DATABASE_URL'));
echo '<p>cp1</p>';
$type = $url['scheme'] == 'postgres' ? 'pgsql' : 'mysql';
$sql = file_get_contents('install/'.$type.'.sql');

$db = new \PDO($type.':host='.$url['host'].($url['port'] ? ';port='.$url['port'] : '').';dbname='.substr($url['path'], 1), $url['user'], $url['pass'], $options);
$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

$conn = pg_pconnect("dbname=d4agtqbk4gjt8r");
$result = pg_query($conn,$sql);
echo '<p>$result</p>';

//$db->exec($sql);
?>
