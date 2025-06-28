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


    // used AI
    public static function create(mysqli $mysqli, array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $query = sprintf("INSERT INTO %s (%s) VALUES (%s)", static::$table, $columns, $placeholders);
        $stmt = $mysqli->prepare($query);

        // Bind parameters dynamically
        $types = str_repeat('s', count($data)); // Assume all strings for now
        $stmt->bind_param($types, ...array_values($data));

        if ($stmt->execute()) {
            $id = $mysqli->insert_id;
            return static::find($mysqli, $id); // Return the created object
        }

        return null;
    }

    public static function delete(mysqli $mysqli, int $id)
    {
        $query = sprintf("DELETE FROM %s WHERE %s = ?", static::$table, static::$primaryKey);
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public static function update(mysqli $mysqli, array $data, int $id)
    {
        $setClause = implode(' = ?, ', array_keys($data)) . ' = ?';

        $query = sprintf(
            "UPDATE %s SET %s WHERE %s = ?",
            static::$table,
            $setClause,
            static::$primaryKey
        );

        $stmt = $mysqli->prepare($query);

        $values = array_values($data);
        $values[] = $id;

        $types = str_repeat('s', count($values));
        $stmt->bind_param($types, ...$values);

        if ($stmt->execute()) {
            return static::find($mysqli, $id); //get updated record
        }

        return null;
    }


}
