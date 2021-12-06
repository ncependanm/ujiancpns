<?php
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'tocpnsco_dbuser';
$db['default']['password'] = '5xP4MW[Kf,b*';
$db['default']['database'] = 'tocpnsco_tocpns';
$db['default']['dbdriver'] = 'mysql';
 $db_conn = mysqli_connect("localhost", "tocpnsco_dbuser", "5xP4MW[Kf,b*", "tocpnsco_tocpns");

// Evaluate the connection
if (mysqli_connect_errno())
{
    echo mysqli_connect_error();
    exit();
}
else
{
    echo "Successful database connection, happy coding!!!";
}
