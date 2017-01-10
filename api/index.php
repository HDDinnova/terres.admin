<?php
require 'flight/Flight.php';
require 'flight/helpers.php';
//require_once 'passwordHash.php';

$dbuser = 'zk1woweu_admin';
$dbpass = '6S8,fs)u.9Ra';

///////
// Connection to database
///////
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=zk1woweu_terres',$dbuser,$dbpass),
  function($db){
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
);

///////
// List all competitors
///////
Flight::route('GET /', function(){
  $db = Flight::db();

  $sql = "SELECT fullName,comName,country,paymentproof,payment FROM competitors";
  $comp = $db->prepare($sql);
  $comp->execute();
  $comps = $comp->fetch(PDO::FETCH_ASSOC);

  $db = NULL;

  Flight::json($comps);
});

Flight::start();
