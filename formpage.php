<?php
//PDO statement to connect to database or call PDOutil class
include_once 'creds.php';


function renderForm($app_id = '', $reviewer = '', $enroll = '', $academic = '', $research = '',
$degree = '', $mentor = '', $Q1 = '', $Q2 = '', $Q3 = '',
$Q4 = '', $Q5 = '', $Q6 = '', $fund = '',$error = ''){
  //get application number from ReviewStudents (set button values to application number)
  //$app_id = $_POST['btn'];
  if ($error != '') {
      echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
      . "</div>";
  }
  include 'formpage.html';

}

$submitted = (isset($_POST['submit'])) ? true : false;
//echo $app_id;
if($submitted)
{

  //get reviewer id from sso?
  $reviewer = 0;
  $app_id = 0;


  $enroll = htmlentities($_POST['enroll'], ENT_QUOTES);
  $academic = htmlentities($_POST['academic'], ENT_QUOTES);
  $research = htmlentities($_POST['research'], ENT_QUOTES);
  $degree = htmlentities($_POST['degree'], ENT_QUOTES);
  $mentor = htmlentities($_POST['mentor'], ENT_QUOTES);
  $eligibility_comments = htmlentities($_POST['comments'], ENT_QUOTES);
  $Q1 = htmlentities($_POST['learn'], ENT_QUOTES);
  $Q2 = htmlentities($_POST['justified'], ENT_QUOTES);
  $Q3 = htmlentities($_POST['method'], ENT_QUOTES);
  $Q4 = htmlentities($_POST['time'], ENT_QUOTES);
  $Q5 = htmlentities($_POST['project'], ENT_QUOTES);
  $Q6 = htmlentities($_POST['budget'], ENT_QUOTES);
  $fund = htmlentities($_POST['fund'], ENT_QUOTES);
  $qual_comments = htmlentities($_POST['qual_comments'], ENT_QUOTES);

  //concat comments
  $comments = 'ELIGIBILTY COMMENTS: '.$eligibility_comments.' QUALITY COMMENTS: '.$qual_comments;

  //check if any fields are empty, if so renderform again
  if($enroll == '' || $academic == '' || $research == '' ||
  $degree == '' || $mentor == '' || $Q1 == '' || $Q2 == '' || $Q3 == '' ||
  $Q4 == '' || $Q5 == '' || $Q6 == '' || $fund == ''){
    $error = 'ERROR: Please fill in all required fields!';
    renderForm($app_id, $reviewer, $enroll, $academic, $research,
    $degree, $mentor, $Q1, $Q2, $Q3, $Q4, $Q5, $Q6, $fund, $error);
  }
  //check if basic qualifications are all met
  else if($enroll == 'No' || $academic == 'No' || $research == 'No' || $degree == 'No' || $mentor == 'No'){
    include 'ReviewStudents.html';
  }
  //store application id, reviewer id, comments, questions 1-6 and fund recommendation
  else{
    $stmt = $pdo->prepare('INSERT INTO ReviewedApps VALUES (?,?,?,?,?,?,?,?,?,?)');
    $stmt->execute([$app_id, $reviewer, $comments, $Q1, $Q2, $Q3, $Q4, $Q5, $Q6, $fund]);
    $user = $stmt->fetch();
    include 'ReviewStudents.html';
  }

}
// if the form hasn't been submitted yet, show the form
else {
  renderForm();
}

?>
