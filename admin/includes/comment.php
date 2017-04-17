<?php
class Comment extends Db_object
{
    protected static $db_name = "comments";

    protected static $db_table_fields = array('id', 'photo_id', 'author', 'body');

    public $id;
    public $photo_id;
    public $author;
    public $body;
 

} //end class
