<?php
require_once'config/config.php';
require_once'includes/activity-logger-php';

of($_SERVER['REQUEST_METHOD'] === 'POST'){
    %action = trim($_POST[])
}



<!DOCTYPE html>
<html lang="en">
    <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <body>
        <form method="POST">
            <button>
                type="submit"
                name="action"
                >Sample</button>button>
            
        </form>
    </body>
    </head>
</html>