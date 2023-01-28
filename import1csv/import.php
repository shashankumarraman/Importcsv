<?php

if(!empty($_FILES['file']['name']))
{
 $connect = new PDO("mysql:host=localhost;dbname=studentdetails;", "root", "", array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true,
    ));

 $total_row = count(file($_FILES['file']['tmp_name']));

 $file_location = str_replace("\\", "/", $_FILES['file']['tmp_name']);

 $query_1 = '
 LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 INTO TABLE user_info 
 FIELDS TERMINATED BY "," 
 LINES TERMINATED BY "\r\n" 
 IGNORE 1 LINES 
 (@column1,@column2,@column3) 
 SET name = @column1, age = @column2,  class = @column3
 ';

 $statement = $connect->prepare($query_1);

 $statement->execute();

 $query_2 = "
 SELECT MAX(u_id) as u_id FROM user_info
 ";

 $statement = $connect->prepare($query_2);

 $statement->execute();

 $result = $statement->fetchAll();

 $u_id = 0;

 foreach($result as $row)
 {
  $u_id = $row['u_id'];
 }

 $first_u_id = $u_id - $total_row;

 $first_u_id = $first_u_id + 1;

 $query_3 = 'SET @u_id:='.$first_u_id.'';

 $statement = $connect->prepare($query_3);

 $statement->execute();

 $query_4 = '
 LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 INTO TABLE user_add 
 FIELDS TERMINATED BY "," 
 LINES TERMINATED BY "\r\n" 
 IGNORE 1 LINES 
 (@column1,@column2,@column3,@column4,@column5,@column6,@column7,@column8,@column9) 
 SET u_id = @u_id:=@u_id+1, add_street = @column4,  add_city = @column5, add_state = @column6, hobby1 = @column7, hobby2 = @column8, hobby3 = @column9
 ';

 $statement = $connect->prepare($query_4);

 $statement->execute();

 $output = array(
  'success' => 'Total <b>'.$total_row.'</b> Data imported'
 );

 echo json_encode($output);
}

?>
