<?php
/*

Features:

* create database
* connect to database
* display a form with two fields
* save the form data in the database
* display the saved data from the database
* using object oriented approach because it is better for large projects

*/
class CMS {
    // Variables
    var $host;
    var $username;
    var $password;
    var $table;
    
    // Methods

    // PUBLIC METHODS

    // public users
    public function display_public() {
        // GET posts from database
        $q = "SELECT * FROM testDB ORDER BY created DECS LIMIT 3";
        $r = mysql_query($q);

        if ($r !== false && mysql_num_rows($r) > 0) {
            while ( $a = mysql_fetch_assoc($r) ) {
                $title = stripslashes($a['title']);
                $bodytext = stripslashes($a['bodytext']);

                $entry_display .= <<<ENTRY_DISPLAY

                <h2>$title</h2>
                <p>
                $bodytext
                </p>
ENTRY_DISPLAY;
            } // end while
        } else {
            $entry_display = <<<ENTRY_DISPLAY
            
            <h2>This Page is Under Construction </h2>
            <p> No entries have been made on this page.
                Please check back soon, or click the link
                below to add an entry!
            </p>
ENTRY_DISPLAY;

        } // end if-else

        $entry_display .= <<<ADMIN_OPTION

        <p class="admin-link">
            <a href="{$_SERVER['PHP_SELF']}?ADMIN=1">Add a New Entry</a>
        </p>

ADMIN_OPTION;

        return $entry_display;
    }
    // admin users
    public function display_admin() {
        return <<<ADMIN_FORM

        <form action="{$_SERVER['PHP_SELF']}" method="post">
            <label for="title">Title:</label>
            <input name="title" id="title" type="text" maxlength="150" />
            <label for="bodytext">Body Text:</label>
            <textarea name="bodytext" id="bodytext"></textarea>
            <input type="submit" value="Create This Entry!" />
        </form>

ADMIN_FORM;
    }

    // write post
    public function write_post() {
        if ( $p['title'] )
            $title = mysql_real_escape_string($p['title']);
        if ( $p['bodytext'] )
            $bodytext = mysql_real_excape_string($p['bodytext']);
        if ( $title && $bodytext ) {
            $created = time();
            $sql = "INSERT INTO testDB VALUES('$title', '$bodytext', '$created')";
            return mysql_query($sql);
        } else {
            return false;
        } // end if-else
    }

    //connect to batabase
    public function connect_db() {
        mysql_connect($this->host,$this->username, $this->password) or die("Could not connect. " . mysql_error());
        mysql_select_db($this->table) or die("Could not select database. " . mysql_error());

        return $this.build_db();
    } // end connect

    // PRIVATE METHODS
    // build database
    private function build_db() {
        // check to see if database exists
        $sql = <<<MySQL_QUERY
        CREATE TABLE IF NOT EXISTS cms_posts (
            title	VARCHAR(150),
            bodytext	TEXT,
            created	VARCHAR(100)
        )
MySQL_QUERY;

        return mysql_query($sql);
}

} // end class CMS
?>