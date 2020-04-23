<?php

include_once '../config/database.php';
include_once '../objects/student.php';

$database = new Database();
$db = $database->getConnection();

$student = new student($db);

$stmt = $student->read();
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
        <body> 
		<script>
function modify(x){

	var ele=document.getElementById(x);
	
	ele.parent().remove();
}
function append(){
	var id=document.getElementById("sno").value;
	var name=document.getElementById("name").value;
	var fname=document.getElementById("fname").value;

	alert("you clicked"+id);
	var write = "<tr id="+sno+"><td>"+id+"</td><td>"+name+"</td><td>"+fname+"</td><td><a href='#'>Edit</a>&nbsp;|<a href='#'>Delete</a></td></tr>";
      //    document.getElementById("student_data").append(write);
		  $('#student_data > tbody:last-child').append(write);
}
</script>
		<?php
		$id="";
		$name="";
		$fname="";
			if (isset($_GET["id"])) {
				$id=$_GET["id"];
				$name = $student->getName($id);
				$fname = $student->getFname($id);
			}	
	  	?>
           <br /><br /> 
		   <div></div>
                 <div class="container">
                    <div class="form">
                        <h2>Insert Data</h2>
                        <form method="get">
                        <strong>ID</strong><br>
                        <input id="sno" type="text" name="id" value="<?php echo $id ?>" required><br>    
                        <strong>NAME</strong><br>
                        <input id="name" type="text" name="name" value="<?php echo $name?>" required><br>
                        <strong>FATHER</strong><br>
                        <input id="fname" type="text" name="fname" value="<?php echo $fname?>" required><br>
                        <input onClick=append() type="button" value="Insert">
                        </form>
                     </div>
                      <h3 align="center">Datatables Jquery Plugin with Php MySql and </h3>  
                      <br />  
                       <div class="table-responsive">  
                          <table  id="student_data" class="table table-striped table-bordered">  
                             <thead>  
                                 <tr>  
                                      <td>ID</td>  
                                      <td>NAME</td>  
                                      <td>FATHER</td> 
                                      <td>ACTION</td> 
                                      
                                </tr>  
                            </thead>  
                          <?php  

                             while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							$id=$row['id'];
							$name=$row['name'];
							$fname=$row['fname'];
                              echo '<tr   id='.$row['id'].'>
                                <td>'.$row['id'].'</td> 
                                <td>'.$row['name'].'</td>
                                <td>'.$row['fname'].'</td>
                                <td>
								<a href="#" >Edit</a>&nbsp;|
                                <a href="#" onClick="modify(".$id.")">Delete</a>
                                </td>
                                </tr>';
                            }  
                          ?>  
                          </table>  
                        </div>  
                    </div>  
      </body> 
</html>
<script>  
 $(document).ready(function(){  
      $('#student_data').DataTable();  syloid venture 
 });  
 </script>
 <script>
 function loadrecords(){
 
 }
 </script>