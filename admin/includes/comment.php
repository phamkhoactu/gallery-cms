<?php
class Comment extends Db_object
{
    protected static $db_name = "comments";

    protected static $db_table_fields = array('id', 'photo_id', 'author', 'body');

    public $id;
    public $photo_id;
    public $author;
    public $body;

    public static function create_comment($photo_id, $author = "Anh Khoa", $body = "")
    {
        if (!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment           = new Comment();
            $comment->photo_id = (int) $photo_id;
            $comment->author   = $author;
            $comment->body     = $body;
            return $comment;
        } else {
            return false;
        }
    } // end create_comment()

    public static function find_the_comment($photo_id)
    {
        global $database;
        $sql = "SELECT * FROM " . self::$db_name;
        $sql .= "WHERE photo_id=". $database->escape_string($photo_id);
        $sql .= "ORDER BY photo_id ASC";

        return self::find_by_query($sql);
    } // end find_the_comment()

} //end class
