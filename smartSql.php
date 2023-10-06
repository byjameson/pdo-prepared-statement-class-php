<?php


/*
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


*/



class smartSql {
  public function __construct($user, $password, $database, $database_type = "mysql", $host = 'localhost', $charset = 'utf8') {
    $this->user = $user;
    $this->password = $password;
    $this->database = $database;
    $this->host = $host;
    $this->database_type = $database_type;
    $this->connection = new PDO("$this->database_type:host=$this->host;dbname=$this->database;charset=$charset", $this->user, $this->password);
  }
  public function connect($tryConnect) {
    if($tryConnect==true and !$this->connection->query("SELECT 1")){
      for(;;){
      $con = $this->connection = new PDO("$this->database_type:host=$this->host;dbname=$this->database;charset=$charset", $this->user, $this->password);
      if($con==true)
      break;
      sleep(1);
      }
    }
    return $this->connection;
  }
  public function ss($query,  $data, $tryConnect = 0){
    // Connect to the database

    $db = $this->connect($tryConnect);
    $stmt = $db->prepare($query);
    $stmt->execute($data);
    $result = $stmt->rowCount();
    if(preg_match("/SELECT.*?FROM/", $query))
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    elseif(preg_match("/INSERT.*?INTO/", $query))
    $result = $db->lastInsertId();
    $stmt = null;
    return $result;
  }

}
function create_slug($string){
  $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
  return $slug;
}
function clean($string){
  return trim(strip_tags($string));
}

$connection = new smartSql('root', 'pass', 'databaseUser', 'databaseType(mysql,postgresql,..etc)');
