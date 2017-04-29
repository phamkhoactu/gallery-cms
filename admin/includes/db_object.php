<?php
class Db_object
{
     public $upload_errors_array = array(
        UPLOAD_ERR_OK         => 'There is no error, the file uploaded with success',
        UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE    => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.',
    );
    public static function find_all()
    {
        return static::find_by_query("SELECT * FROM " . static::$db_name);

    }

    public static function find_by_id($user_id)
    {
        global $database;
        $result_set = static::find_by_query("SELECT * FROM " . static::$db_name . " WHERE id=$user_id LIMIT 1");

        return !empty($result_set) ? array_shift($result_set) : false;

    }

    public static function find_by_query($sql)
    {
        global $database;
        $result_set       = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantation($row);
        }

        return $the_object_array;
    }

    public static function instantation($the_record)
    {
        $calling_class = get_called_class();

        $the_object = new $calling_class;

        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);

    }

    protected function clean_properties()
    {
        global $database;

        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            //  echo "<pre>".$key."=".$value."</pre>";
            $clean_properties[$key] = $database->escape_string($value);
        }
        // echo "<pre>".print_r($clean_properties)."</pre>";
        return $clean_properties;
    }

    protected function properties()
    {
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
//echo "<pre>".print_r($properties)."</pre>";
        return $properties;
    }

    public function create()
    {
        global $database;
        $properties = $this->clean_properties();
        //echo "<pre>".print_r($properties)."</pre>";
        $sql = "INSERT INTO " . static::$db_name . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= " VALUES ('" . implode("','", array_values($properties)) . "')";

        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }

    }

    public function update()
    {
        global $database;

        $properties = $this->clean_properties();

        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key} = '{$value}'";
        }

        $sql = "UPDATE " . static::$db_name . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id=" . $database->escape_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }

    public function delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_name;
        $sql .= " WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_name;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
   
        return array_shift($row);
    }

}
