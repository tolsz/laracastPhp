<?php

use Core\App;

$db = App::resolve('Core\Database');

$id = getUserId();

$notes = $db->query("select * from notes where user_id = {$id}")->get();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);