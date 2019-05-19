<?php require_once('../Connections/myconnect.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM sitetable WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($deleteSQL, $myconnect) or die(mysql_error());

  $deleteGoTo = "user.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_myconnect, $myconnect);
$query_Recordset1 = "SELECT * FROM sitetable";
$Recordset1 = mysql_query($query_Recordset1, $myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<title>user</title>
<p><strong>สวัสดีชาวโลก</strong> <?php echo $_SESSION['myname']; ?><?php echo $_SESSION['names']; ?></p>
<p></p>
<form id="form1" name="form1" method="post" action="for-admin.php">
  <input type="submit" name="Upload" id="Upload" value="Upload" />
</form>
<p></p>
<table border="1">
  <tr>
    <td>id</td>
    <td>sitename</td>
    <td>siteworkingtype</td>
    <td>sitedetail</td>
    <td>siteimage</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['sitename']; ?></td>
      <td><?php echo $row_Recordset1['siteworkingtype']; ?></td>
      <td><?php echo $row_Recordset1['sitedetail']; ?></td>
      <td><p><?php echo $row_Recordset1['siteimage']; ?></p></td>
    <td> <a href="delete.php?id=<?php echo $row_Recordset1['id']; ?>?id=<?php echo $row_Recordset1['id']; ?>">delete</a></td>
      <td><a href="editdata.php?id=<?php echo $row_Recordset1['id']; ?>&amp;sitename=<?php echo $row_Recordset1['sitename']; ?>&amp;siteworkingtype=<?php echo $row_Recordset1['siteworkingtype']; ?>&amp;sitedetail=<?php echo $row_Recordset1['sitedetail']; ?>&amp;siteimage=<?php echo $row_Recordset1['siteimage']; ?>">Edit </a></td>
      
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table> 
<p>ออกจากระบบ <a href="<?php echo $logoutAction ?>">Log out</a></p>
<?php
mysql_free_result($Recordset1);
?>
