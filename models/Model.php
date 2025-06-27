<?php

abstract class Model
{
    protected static string $table;
    protected static string $primaryKey = 'id';

    public static function all(mysqli $mysqli) // return array of model instances
    {  //get all records from table
        $query = sprintf("SELECT * FROM  %s", static::$table);
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result(); // return obj 
        $all = [];
        while ($row = $result->fetch_assoc()) { // fetch on array {
            $all[] = new static($row); // creating obj of type static and add obj to array all (depending on class constructor)
            // passes the row array to the constructor
        }
        return $all;
    }


    public static function find(mysqli $mysqli, int $id) // return single model instance or null
    {
        $query = sprintf("SELECT * FROM %s WHERE %s = ?", static::$table, static::$primaryKey);
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();

        return $data ? new static($data) : null; // data have now the assoc array or null if no record
    }
}