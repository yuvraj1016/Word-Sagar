<?php
                    $search = $_POST["word"];
                    $servername = 'localhost';   // name of the server 
                    $database = 'Database';     // name of the database
                    $username = 'username';     // name of the user of the database for most cases its value is root
                    $password = '********';     // users database password
                    $dbh = new PDO("mysql:host=$servername;dbname=$database", $username, $password);  // connection with the database
?>