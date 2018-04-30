<?php


class DB {


    protected $_host = "localhost";
	protected $_username = "root";
	protected $_password = "";
    protected $_database = "todo_list";
    public $link;

    public function __construct() {

        $this->link = mysqli_connect($this->_host, $this->_username, $this->_password) or die(mysqli_error());
        mysqli_select_db($this->link, $this->_database);
    }

    public function insert($todo, $tags = "", $timestamp) {

        $result = mysqli_query($this->link, "INSERT INTO todo(todo,tags,created_on) VALUES ('$todo', '$tags', '$timestamp') " );
        return $result;
    }

    public function select($sortBy = '', $desc = false) {

        $query = 'SELECT * FROM todo';    

        if (!empty($sortBy)) {

            switch($sortBy) {

                case 'id':
                    $query .= ' ORDER BY id';
                    break;
                case 'todo':
                    $query .= ' ORDER BY todo';
                    break;
                case 'date':
                    $query .= ' ORDER BY created_on';
                    break;
                default:
                    break; 
            }
            
            // if ($desc) {

            //     $query .= ' DESC;';
            // } 
        }
        
        $result = mysqli_query($this->link, $query);
        return $result;
    }

    public function delete($id) {
        $result = mysqli_query($this->link, "DELETE FROM todo WHERE id=" . $id . "");
        return $result;
    }

    public function update($id, $value) {
        $result = mysqli_query($this->link, "UPDATE todo A SET A.todo='$value' WHERE id='$id'");
        return $result;
    }

    public function truncate() {

        $result = mysqli_query($this->link, "TRUNCATE TABLE todo");
        return $result;
    }

    public function close() {

        mysqli_close($this->link);
    }

}

?>