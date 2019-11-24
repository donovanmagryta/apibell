<?php
$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 180; URL=$url1");

if (!isset($_COOKIE["api"])) {
  if (!isset($_POST["submit"])) {

  echo '<html><style>body { font-size: 300%; }input { font-size: 150%; } select { font-size: 150%; }</style> <body> <form action="apibell.php" method="post">
  <input type="url" name="api" placeholder="API URL"/>
  <br>
  <input type="text" name="lookin" placeholder="look in"/>
  <br>
  <select name="delay" id="delay">
  <option value="">Refresh Every</option>
  <option value="180">3 minutes</option></select>
  <br>
  <select name="mode" id="mode">
  <option value="">Action</option>
  <option value="equal">does match</option>
  </select><br><input type="text" name="lookfor" placeholder="look for"/><br><input type="submit" name="submit"/> </form> </body> </html>';
  }
  if (isset($_POST["submit"])) {
  $lookin = urldecode($_POST["lookin"]);
  $api= urldecode($_POST["api"]);
  //echo $api;
  $lookfor = urldecode($_POST["lookfor"]);
  $delay = urldecode($_POST["delay"]);
  $mode = urldecode($_POST["mode"]);
  setcookie("lookin", $lookin);
  setcookie("lookfor", $lookfor);
  $apicookie = urlencode($api);
  setcookie("api", $apicookie);
  setcookie("delay", $delay);
  setcookie("mode", $mode);
  //setcookie("out", "out");
  echo "<html><style>body { font-size: 300%; font-family: Arial; color: cyan; background-color: black;}</style><body><h1>Loading...</h1></body></html>";
}
}
else if (isset($_COOKIE["api"])) {
$api = $_COOKIE["api"];
$apiurl = urldecode($api);
$lookin = $_COOKIE["lookin"];
$lookfor = $_COOKIE["lookfor"];
echo '<form action="apibell.php" method="post"><input style="position:absolute; top:0; right:0" type="submit" value="logout" placeholder="logout" name="logout"></form>';
if (isset($_POST["logout"])) {
  setcookie("api", "yourValue", 1);
  setcookie("lookin", "yourValue", 1);
  setcookie("lookfor", "yourValue", 1);
  setcookie("delay", "yourValue", 1);
}
$json = file_get_contents($apiurl);
$obj = json_decode($json);
$see = $obj->$lookin;
if ($see != $lookdfor) {
echo "<html><style>body { font-size: 300%; font-family: Arial; color: cyan; background-color: black;}</style><body><h1>Tracking...</h1></body></html>";
}
if ($see == $lookfor) {
echo "<html><style>body { font-size: 300%; font-family: Arial; color: yellow; background-color: black;}</style><body> <h1>$lookfor
  matches!</h1></body></html>";
echo "<script> var audio = new Audio('http://tipscale.digital/bell.wav'); audio.play();  </script>";
}
}
?>
