This is pdo class for php language. You can make everything with this pdo class. This is easiest and safest class in the world. I wrote it with pure logic. It uses prepared statement and bind param

Connection inside code.

$connection = new smartSql('root', 'pass', 'databaseUser', 'databaseType(mysql,postgresql,..etc)');


EXAMPLES

//SELECT WITHOUT PDO PING

$connection->ss("SELECT * FROM myTable WHERE name = ? AND age = ?", array($name,$age))

//SELECT WITH PDO PING

$connection->ss("SELECT * FROM myTable WHERE name = ? AND age = ?", array($name,$age), 1)

foreach( $query as $row ) {

echo $row["ad"].'<br>';

}

//INSERT WITHOUT PDO PING

$connection->ss("INSERT INTO myTable (name, age) VALUES (?, ?)", array($name,$age))

//INSERT WITH PDO PING

$connection->ss("INSERT INTO myTable (name, age) VALUES (?, ?)", array($name,$age), 1)

//UPDATE WITHOUT PDO PING

$connection->ss("UPDATE myTable SET name = ? WHERE id = ?", array($name,$age))

//UPDATE WITH PDO PING

$connection->ss("UPDATE myTable SET name = ? WHERE id = ?", array($name,$age), 1)

//DELETE WITHOUT PDO PING

$connection->ss("DELETE FROM myTable WHERE id = ?", array($name,$age))

//DELETE WITH PDO PING

$connection->ss("DELETE FROM myTable WHERE id = ?", array($name,$age), 1)

//without parameter select

$query = $connection->connect(0)->query("SELECT * From denemetry order by id desc");

foreach( $query as $row ) {

echo $row["ad"].'<br>';

}

