<?
include ("../include.inc");
$user = $_REQUEST['id'];
$query = mysqli_query($mdb, "SELECT * FROM wt_users WHERE id=$user");
while($row = mysqli_fetch_object($query)){
	echo "<img src='images/user/500/$row->avatar'>";
}
?>