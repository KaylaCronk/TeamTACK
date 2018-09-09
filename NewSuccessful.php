<!DOCTYPE html>
<html>
<head>
<title>Admin</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: "Lato", sans-serif;
}
legend {
    background-color: #000;
    color: #fff;
    padding: 3px 6px;
}

.output {
    font: 1rem 'Fira Sans', sans-serif;
}

input {
    margin: .4rem;
}

label {
    display: inline-block;
    text-align: right;
    width: 20%;
}

.sidenav {
    height: 100%;
    width: 200px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: lightgray;
    overflow-x: hidden;
    padding-top: 20px;
}

.sidenav a {
    padding: 6px 6px 6px 32px;
    text-decoration: none;
    font-size: 25px;
    color: black;
    display: block;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.main {
    margin-left: 200px; /* Same as the width of the sidenav */
}
select.search{
	margin-right:15px;
	}
	input{
		width :300px;}
	
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.stats-container {
    float: left;
    width: 33.33%;
    padding: 5px;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.w3-text-white, .w3-hover-text-white:hover {
    color: #fff!important;
    }
.w3-row-padding, .w3-row-padding>.w3-half, .w3-row-padding>.w3-third, .w3-row-padding>.w3-twothird, .w3-row-padding>.w3-threequarter, .w3-row-padding>.w3-quarter, .w3-row-padding>.w3-col {
    padding: 0 8px;}
    
    .w3-left {
    float: left!important;
}
.w3-right {
    float: right!important;
}
.w3-orange, .w3-hover-orange:hover {
    color: #000!important;
    background-color: #ff9800!important;
}
.w3-container, .w3-panel {
    padding: 0.01em 16px;
}
.w3-margin-bottom {
    margin-bottom: 16px!important;
}
</style>
<?php
$host = 'localhost';
$db   = 'researchGrant';
$user = 'root';
$pass = '*b37h-M3p&T';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$sth = $pdo->prepare("SELECT * FROM Settings");
$sth->execute();
$result= $sth->fetch();
$start = $result[2];

$begin = mysqli_real_escape_string($pdo, $_REQUEST['start']);
$deadline = mysqli_real_escape_string($pdo, $_REQUEST['end']);

echo $begin;

$sql = $pdo->prepare("UPDATE Settings SET Deadline=".$deadline .", BeginDate=" .$begin." WHERE BeginDate =".$start);
$sql->execute();


?>
</head>
<form action="NewSuccessful.php" method="post">
<body>
<div class="sidenav">
<img src ="img/ewueagle.png" height=200px; width = 200px;>
<br>


  <a href="Admin.html">Home</a>
  <br>
  <a href="edit.html">Edit</a>
  <br>
  <a href ="results.html">Results</a>
  <br>
  <a href="prior.html">Prior Awards</a>
  <br>
  <a href="search.html">Search</a>
  <br>
  <a href="new.html">New</a>
</div>

<div class="main">
   <div class="w3-container">
<h1>Begin a new Scholarship Process</h1>
<h4> By beginning a new Scholarship process you'll make all data currently stored historical and can no longer select any awardee's</h4>
<?php  echo $begin?>
<br>

<fieldset>
    <legend>New Scholarship Dates</legend>

    <div>
        <label for="start">Begin Date</label>
        <input type="date" id="start" name="start"
               value= <?php echo htmlspecialchars($begin); ?>
                />
    </div>

    <div>
        <label for="end">Deadline</label>
        <input type="date" id="end" name="end"
               value= <?php echo htmlspecialchars($deadline); ?>
               />
    </div>
</fieldset>
<br>
<button>Begin New Process</button>
</div>
</div>
</body>
</html>

