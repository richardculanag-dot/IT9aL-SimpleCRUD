<?php 
echo "PHP Functions <br><br>";
echo "Activity 1 ";
echo "<br> <br>";
$name = "Richard Culanag";
echo "Name: $name <br>";

echo "Today is: " .date('F j, Y');
echo "<br>----------------------------------------- <br>";

echo "Activity 2 <br> <br>";
$username = "admin";
$role = "administrator";

$loginattempt = 2;
$maxlogin = 2;
$canlogin = $loginattempt <= $maxlogin;
echo " username: $username <br>";
echo "Role: $role <br>";
echo "Login Attempts: $loginattempt";

echo "<br> Access Allowed: " .($canlogin ? "Yes" : "No");

echo "<br>------------------------------------------  <br>";

echo "Activity 3 ";
echo "<br>";
for ($i = 1; $i <4; $i++){
    echo "<br> Login Attempt/s: $i <br>";
}

echo "-----------------------------------------  <br>";
echo " Activity 4 <br> <br> ";
$list =["username" => "admin", "role" => "administrator", "status" => "active"];
echo "user info: <br>";

echo "username : " . $list["username"];
echo "<br>";
echo "role : " . $list["role"];
echo "<br>";
echo "status : " . $list["status"];
echo "<br>";
echo "-----------------------------------------
  <br>";

echo "Activity 5 <br><br>";

$user = ["username" => "Richard", "status" => "active"];

if ($user["status"] === "active") {
    echo "User can login";
} else {
    echo "User is blocked";
}

echo "<br>-----------------------------------------
 <br>";

echo "Activity 6 <br><br>";

$users = [
    ["username" => "admin", "role" => "admin"],
    ["username" => "jan", "role" => "user"],
    ["username" => "jim", "role" => "user"]
];

foreach ($users as $u) {
    if ($u["role"] === "admin") {
        echo "User: " . $u["username"] . " (Admin)<br>";
    } else {
        echo "User: " . $u["username"] . " (User)<br>";
    }
}
?>

