<?php require_once('../Connections/CMS.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
                $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

mysqli_select_db($con, $database_CMS);
$query_Recordset1 = "SELECT Station_Name FROM policestation_tbl";
$Recordset1 = mysqli_query($con, $query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Crime Management System</title>
        <link href="templatemo_style.css" rel="stylesheet" type="text/css" />
        <script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
        <script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
        <link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            <!--
            .style1 {font-size: 12px}
            .style2 {color: #FFFFFF}
            -->
        </style>
        <link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            <!--
            .style3 {color: #000000}
            .style6 {color: #CCCCCC}
            -->
        </style>
    </head>
    <body>
        <div id="templatemo_wrapper">
            <?php
            include "Header.php"
            ?>
            <div id="templatemo_content">
                <div class="section_w800">
                    <h2>Post Your Complaints</h2>
                    <div id="TabbedPanels1" class="TabbedPanels">
                        <ul class="TabbedPanelsTabGroup">
                            <li class="TabbedPanelsTab style1 style2" tabindex="0">Post Complaints</li>
                            <li class="TabbedPanelsTab style1 style2" tabindex="0">Track Complaints</li>
                        </ul>
                        <div class="TabbedPanelsContentGroup">
                            <div class="TabbedPanelsContent">
                                <form id="form1" name="form1" method="post" action="InsertComplain.php">
                                    <table width="100%" height="252" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><span class="style3">Select Police Station:</span></td>
                                            <td><label>
                                                    <select name="cmbStation" id="cmbStation">
                                                        <?php
                                                        do {
                                                            ?>
                                                            <option value="<?php echo $row_Recordset1['Station_Name'] ?>"><?php echo $row_Recordset1['Station_Name'] ?></option>
                                                            <?php
                                                        } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
                                                        $rows = mysqli_num_rows($Recordset1);
                                                        if ($rows > 0) {
                                                            mysql_data_seek($Recordset1, 0);
                                                            $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
                                                        }
                                                        ?>
                                                    </select>
                                                </label></td>
                                        </tr>
                                        <tr>
                                            <td><span class="style3">Select Complaint Type:</span></td>
                                            <td><label>
                                                    <select name="cmbType" id="cmbType">
                                                        <option>Robery</option>
                                                        <option>Murder</option>
                                                        <option>MisBehaviour</option>
                                                    </select>
                                                </label></td>
                                        </tr>
                                        <tr>
                                            <td><span class="style3">Complaint Description:</span></td>
                                            <td><span id="sprytextarea1">
                                                    <label>
                                                        <textarea name="txtDesc" id="txtDesc" cols="35" rows="3"></textarea>
                                                    </label>
                                                    <span class="textareaRequiredMsg">A value is required.</span></span></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td><label>
                                                    <input type="submit" name="button" id="button" value="Submit" />
                                                </label></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <div class="TabbedPanelsContent">
                                <table width="100%" border="1" bordercolor="#E3B71A" >
                                    <tr>
                                        <th height="32" bgcolor="#E3B71A" class="style6"><div align="left" class="style9 style2 style4"><strong>Id</strong></div></th>
                                        <th bgcolor="#E3B71A" class="style6"><div align="left" class="style9 style2 style4"><strong>Station Name</strong></div></th>
                                        <th height="32" bgcolor="#E3B71A" class="style6"><div align="left" class="style9 style2 style4"><strong>Type</strong></div></th>
                                        <th bgcolor="#E3B71A" class="style6"><div align="left" class="style9 style2 style4"><strong>Complaint</strong></div></th>
                                        <th height="32" bgcolor="#E3B71A" class="style6"><div align="left" class="style9 style2 style4"><strong>Date</strong></div></th>
                                        <th bgcolor="#E3B71A" class="style6"><div align="left" class="style9 style2 style4"><strong>Status</strong></div></th>
                                    </tr>
                                    <?php
// Establish Connection with Database
                                    $con = mysqli_connect("localhost", "root");
// Select Database
                                    mysqli_select_db($con, "cms");
// Specify the query to execute
                                    $sql = "select * from complaint_tbl where User_Id='" . $_SESSION['ID'] . "'";
// Execute query
                                    $result = mysqli_query($con, $sql);
// Loop through each records 
                                    while ($row = mysqli_fetch_array($result)) {
                                        $Id = $row['Complaint_Id'];
                                        $Name = $row['Station_Name'];
                                        $Type = $row['Complaint_Type'];
                                        $Desc = $row['Complaint_Desc'];
                                        $Status = $row['Status'];
                                        $Date = $row['Complaint_Date'];
                                        ?>
                                        <tr>
                                            <td class="style6"><div align="left" class="style9 style5 style4 style3"><strong><?php echo $Id; ?></strong></div></td>
                                            <td class="style6"><div align="left" class="style9 style5 style4 style3"><strong><?php echo $Name; ?></strong></div></td>
                                            <td class="style6"><div align="left" class="style9 style5 style4 style3"><strong><?php echo $Type; ?></strong></div></td>
                                            <td class="style6"><div align="left" class="style9 style5 style4 style3"><strong><?php echo $Desc; ?></strong></div></td>
                                            <td class="style6"><div align="left" class="style9 style5 style4 style3"><strong><?php echo $Date; ?></strong></div></td>
                                            <td class="style6"><div align="left" class="style9 style5 style4 style3"><strong><?php echo $Status; ?></strong></div></td>
                                        </tr>
                                        <?php
                                    }
// Retrieve Number of records returned
                                    $records = mysqli_num_rows($result);
                                    ?>
                                    <?php
// Close the connection
                                    mysqli_close($con);
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="cleaner"></div>
                </div> <!-- end of section_w760 -->

            </div> <!-- end of templatemo_content -->
            <?php
            include "Footer.php";
            ?>

        </div> <!-- end of templatemo_wrapper -->
        <script type="text/javascript">
        <!--
            var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
            var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
        //-->
        </script>
    </body>
</html>
<?php
mysqli_free_result($Recordset1);
?>