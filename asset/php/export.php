<?php
if(isset($_POST['subex'])){
    if($_POST['format']=="xls"&&$_GET['table']!="log"){
        xls($_POST['ename'],$_GET['table']);
    }
    if($_POST['format']=="csv"&&$_GET['table']!="log"){
        csv($_POST['ename'],$_GET['table']);
    }
    date_default_timezone_set('Asia/Hong_Kong');
  	require_once '../db/admindb.php';
    if($_POST['format']=="csv"&&$_GET['table']=="log"){
        csv($conn,$_POST['ename'],$_GET['table']);
    }
    if($_POST['format']=="xls"&&$_GET['table']=="log"){
        xls($conn,$_POST['ename'],$_GET['table']);
    }

}

function xls($conn,$ename,$table){
    ob_start();
    if($table!="log"){
      require 'config.php';
      $Connect = @mysql_connect($host, $username, $password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
      $Db = @mysql_select_db($dbname, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());
    }else{
      $Connect=$conn;
    }

    $DB_TBLName = $table;
    $filename = $ename;
    $sql = "Select * from $DB_TBLName";


    $result = @mysqli_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysqli_error(). "<br>" . mysqli_error());
    $file_ending = "xls";
    $sep = "\t";
    for ($i = 0; $i < mysql_num_fields($result); $i++) {
        echo mysql_field_name($result,$i) . "\t";
    }
    print("\n");
        while($row = mysql_fetch_row($result)){
            $schema_insert = "";
            for($j=0; $j<mysql_num_fields($result);$j++){
                if(!isset($row[$j]))
                    $schema_insert .= "NULL".$sep;
                elseif ($row[$j] != "")
                    $schema_insert .= "$row[$j]".$sep;
                else
                    $schema_insert .= "".$sep;
            }
            $schema_insert = str_replace($sep."$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
        }

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 1");
    ob_end_flush();
}

function csv($conn,$ename,$table){
        ob_start();
        if($table!="log"){
          require 'config.php';
        };
        $filename=$ename;
        $sql="select * from $table";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
            $data = $stmt->get_result();
                 $result = array();
                 while($row = $data->fetch_assoc()) {
                      $result[] = $row;
                  }
                //print_r($result);

        $fp = fopen('php://output', 'w');

        foreach ($result as $fields) {
            fputcsv($fp, $fields);
        }
            header('Content-Type: text/csv; charset=utf-8');
            header("Content-Disposition: attachment; filename=$filename.csv");
            header("Pragma: no-cache");
            header("Expires: 1");
            ob_end_flush();
}


?>
