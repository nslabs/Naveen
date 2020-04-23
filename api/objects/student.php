<?php
class student{
  
    // database connection and table name
    private $conn;
    private $table_name = "student";
  
    // object properties
    public $id;
    public $name;
    public $fname;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


// read students
function read(){
  
    // select all query
    $query = "SELECT * FROM student";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
//read onestudent
function getName($id){

	$name="";
	$query = "SELECT * FROM student where id='$id'";

	// prepare query statement
	$stmt = $this->conn->prepare($query);

	// execute query
	$stmt->execute();
	 if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$name=$row['name'];
	 }
	return $name;


}

function getFname($id){

	$fname="";
	$query = "SELECT * FROM student where id='$id'";

	// prepare query statement
	$stmt = $this->conn->prepare($query);

	// execute query
	$stmt->execute();
	 if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$fname=$row['fname'];
	 }
	return $fname;


} 
// create student
function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                id=:id, name=:name, fname=:fname";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->fname=htmlspecialchars(strip_tags($this->fname));
    
    // bind values
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":fname", $this->fname);
    
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}




// update the student
function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET 
                 
                name = :name,
                fname = :fname
                            WHERE
                id = :id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->fname=htmlspecialchars(strip_tags($this->fname));
    
    // bind new values
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':fname', $this->fname);
    
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
// delete the student
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
}
?>