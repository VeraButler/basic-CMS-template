<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vera Butler Design CMS</title>
</head>
<body>
    <?php
        include_once('_class/CMS.php');
        $obj = new CMS();
        $obj->host = 'localhost';
        $obj->username = 'db-username';
        $obj->password = 'db_password';
        $obj->table = 'cms_posts';
        $obj->connect();

        if( $_POST )
            $obj->write($_POST);
        
        echo ( $_GET['admin'] == 1) ? $obj->display_admin() : $obj->display_public();
    ?>
</body>
</html>