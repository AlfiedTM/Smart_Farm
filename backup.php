<?php //Backup script for backing a copy of the database
session_start();
error_reporting(0);

//Verification logic as script should be accessed only by logged on admin
if (strlen($_SESSION['smaid']==0)) { 
  header('location:logout.php');
  } else{
    //   Database backing up funtion
    function backupDatabaseTables($tables = '*'){
    //connect & select the database
        $Conn = new mysqli("localhost", "root", "1Bervin@6154", "smart farm"); 

        //get all of the tables from a database
        if($tables == '*'){
            $tables = array();
            $result = $Conn->query("SHOW TABLES");
            // fetch each result as a row
        while($row = $result->fetch_row()){
            $tables[] = $row[0];
        }
        }else{
            $tables = is_array($tables)?$tables:explode(',',$tables);
        }

        //loop through the tables
        foreach($tables as $table){
            // Querying the database
            $result = $Conn->query("SELECT * FROM $table");
            $numColumns = $result->field_count;

            $return .= "DROP TABLE $table;";

            $result2 = $Conn->query("SHOW CREATE TABLE $table");
            $row2 = $result2->fetch_row();

            $return .= "\n\n".$row2[1].";\n\n";

        // For the collected table fetch each data from a row
        for($i = 0; $i < $numColumns; $i++){
            while($row = $result->fetch_row()){
                $return .= "INSERT INTO $table VALUES(";
                for($j=0; $j < $numColumns; $j++){
                    $row[$j] = addslashes($row[$j]);
                    // $row[$j] = preg_replace("\n","\n",$row[$j]);
                    if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
                    if ($j < ($numColumns-1)) { $return.= ','; }
                }
                $return .= ");\n";
            }
        }

        $return .= "\n\n\n";
    }

    //save file
    // Path to store the database
    $dir = dirname(__FILE__)."\database";
    // Open the file 
    $handle = fopen($dir.'\db-backup-'.date("d-m-Y").'.sql','w+');
    // Write to the file
    fwrite($handle,$return);
    // Close
    fclose($handle);
}
    //Backup the database 
    backupDatabaseTables();
    // Alert the admin that backup was a success and redirect the browser to the dashboard
    echo "<script>alert('Backup Successful. File stored in Backup Folder');</script>";
    echo "<script type='text/javascript'>document.location ='dashboard.php';</script>";
  }
?>