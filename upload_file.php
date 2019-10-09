<?php
$target_path = "uploads/";

$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "The file ".  basename( $_FILES['uploadedfile']['name']).
    " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
}
// var_dump($target_path);
$handle = fopen($target_path, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $line = str_replace("\n", "", $line);
        $name = explode( ":" , $line );
        $name_st= str_replace("_"," ",$name[1]);
        $password = "Test@123";
        mysql_query("insert into students(studentName,StudentRegno,password) values('$name_st','$name[0]','$password')");
        
    }
    fclose($handle);
}