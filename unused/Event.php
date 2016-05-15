<?php
class Event{

    // database connection and table name
    private $conn;
    private $table_name = "events";

    // object properties
    public $id;
    public $name;
    public $description;
    public $coordinates;
    public $location;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create product
    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, coordinates=:coordinates, location=:location, description=:description, created=:created";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->coordinates));
        $this->price=htmlspecialchars(strip_tags($this->location));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":coordinates", $this->coordinates);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created", $this->created);

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // read events
    function readAll(){

        // select all query
        $query = "SELECT
                id, name, description, coordinates, location, created
            FROM
                " . $this->table_name . "
            ORDER BY
                id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readOne(){

        // query to read single record
        $query = "SELECT
                name, description, coordinates, location
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->coordinates = $row['coordinates'];
        $this->description = $row['description'];
        $this->location = $row['location'];

    }
}