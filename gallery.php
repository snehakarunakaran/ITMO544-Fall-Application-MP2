<html>
<head><title>Gallery</title>
  <!-- jQuery -->
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <!-- Fotorama -->
  <link href="fotorama.css" rel="stylesheet">
  <script src="fotorama.js"></script>
</head>
<body>
<div class="fotorama" data-width="700" data-ratio="700/467" data-max-width="100%">
<?php
session_start();
$email = $_POST["email"];
echo $email;
require 'vendor/autoload.php';


$rds = new Aws\Rds\RdsClient([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);

$result = $rds->describeDBInstances(array(
    'DBInstanceIdentifier' => 'db1'
   
));
$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
    echo "============\n". $endpoint . "================";


$link = mysqli_connect($endpoint,"testconnection1","testconnection1","Project1");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

else {
echo "Success";
}

//below line is unsafe - $email is not checked for SQL injection -- don't do this in real life or use an ORM instead
$link->real_query("SELECT * FROM MiniProject1 where email= '$email'");

$res = $link->use_result();
echo "Result set order...\n";
while ($row = $res->fetch_assoc()) {

    echo "<img src =\" " . $row['raws3url'] . "\" /><img src =\"" .$row['finisheds3url'] . "\"/>";
echo $row['id'] . "Email: " . $row['email'];
}
$link->close();


?>

</div>
</body>
</html>
