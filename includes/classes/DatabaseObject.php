<?


class DatabaseObject{
    protected static $table_name;

    // Returns an array of objects.
    public static function find_all() {

        return static::find_by_sql("SELECT * FROM " . Static::$table_name);
    }

    // Returns an array of objects.
    public static function find_all_reverse() {
        return static::find_by_sql("SELECT * FROM " . Static::$table_name . " ORDER BY id DESC");
    }

    public static function count_all() {
        return count(Self::find_all());
    }

    public static function count_sql($sql) {
        return count(static::find_by_sql($sql));
    }

    public static function count($input) {
        return count($input);
    }

    // Returns an object by id
    public static function find_by_id($id=0) {
        $result_array = static::find_by_sql("SELECT * FROM ".Static::$table_name." WHERE id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    // Finds by sql and returns it as objects
    public static function find_by_sql($sql="") {
        $database = new Database();
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    // Checks all column names and see if there is an attribute for it.
    private static function instantiate($record) {
        $class_name = get_called_class();
        $object = new $class_name;

        // More dynamic, short-form approach:
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)) {
                $object->$attribute = utf8_encode($value);
            }
        }
        return $object;
    }

    // Checks if an attribute exists
    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->attributes());
    }

    protected function attributes() {
        // return an array of attribute names and their values
        $attributes = array();
        foreach(static::$db_fields as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach($this->attributes() as $key => $value){
            if(!empty($value))
            $clean_attributes[$key] = $database->mysql_prep($value);
        }
        return $clean_attributes;
    }

    public function save() {
        // A new record won't have an id yet.
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO ".static::$table_name." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if($database->query($sql)) {
            return $this->id = $database->insert_id();
        } else {
            echo "Nothing was added";
            return false;
        }
    }

    public function update() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".static::$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $database->mysql_prep($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function delete() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        $sql = "DELETE FROM ".static::$table_name;
        $sql .= " WHERE id=". $database->mysql_prep($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;

        // NB: After deleting, the instance of User still
        // exists, even though the database entry does not.
        // This can be useful, as in:
        //   echo $user->first_name . " was deleted";
        // but, for example, we can't call $user->update()
        // after calling $user->delete().
    }

    public static function add_new(){
        $class_name = get_called_class();
        $object = new $class_name;
        $object->id = NULL;
        foreach($_POST as $field=>$val) {
            $object->$field = $val;
        }
        $object->created_at = strftime("%Y-%m-%d %H-%M-%S", time());
        $object->updated_at = strftime("%Y-%m-%d %H-%M-%S", time());

        $id = $object->save();
        if($id){
            return $id;
        }


    }




}