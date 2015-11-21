<? php

session_start();
var_dump($_POST);
if(!empty($_POST)){
echo $_POST['useremail'];
$useremail=$_SESSION['useremail'];
}

require 'vendor/autoload.php';

#create sns client
$sns = new Aws\Sns\SnsClient([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);

//echo "sns Topic";

$topicARN = $result['Topics'][0]['TopicArn'];
echo  $topicARN;

echo "You have not subscribed yet! please confirm subcription sent to your email, Then click redirect button!"
$result = $sns->subscribe(array(
    // TopicArn is required
    'TopicArn' => $topicARN,
    // Protocol is required
    'Protocol' => 'email',
    'Endpoint' => $useremail,
));

echo  "Sub-test".$result;
print_r($result);

echo "You have not subscribed yet! please confirm subcription sent to your email, Then click <a href="index.php"/>redirect!</a>"

?>