<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_counselling";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE e_counselling";
if ($conn->query($sql) === TRUE) {
  //  echo "Database created successfully";
} else {
  //  echo "Error creating database: " . $conn->error;
}

$conn->close();
//-------------------------------------------------

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  //  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE `admin` (
  `ID` int(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `status` varchar(9) NOT NULL
);
";

if ($conn->query($sql) === TRUE) {
  // echo "Table MyGuests created successfully";

} else {
 //echo "Error creating table: " . $conn->error;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
  $sql = "INSERT INTO admin (ID, username, password, fullname, status) VALUES
  (1, 'admin', 'admin123', 'Administrator', 'Active')";
  
  
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();


//----------------------------------
//-------------------------------------------------
//-------------------------------------------------

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  //  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE `convo_list` (
 `id` int(30) NOT NULL,
  `from_user` int(30) NOT NULL,
  `to_user` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
);
";

if ($conn->query($sql) === TRUE) {
  // echo "Table MyGuests created successfully";
} else {
 //echo "Error creating table: " . $conn->error;
}

//-------------------------------------------------

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  //  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE `messages` (
  `id` int(30) NOT NULL,
  `from_user` int(30) NOT NULL,
  `to_user` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = text , 2 = photos,3 = videos, 4 = documents',
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `popped` tinyint(1) NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `file_upload` varchar(500) NOT NULL
);
";


if ($conn->query($sql) === TRUE) {
  // echo "Table MyGuests created successfully";
} else {
 //echo "Error creating table: " . $conn->error;
}
//----------------------------------


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  //  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE `users` (
   `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `user_ID` varchar(20) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `avatar` varchar(500) NOT NULL
);
";

if ($conn->query($sql) === TRUE) {
  // echo "Table MyGuests created successfully";
} else {
 //echo "Error creating table: " . $conn->error;
}
//----------------------------------

$conn->close();

//==============================================================

?>

