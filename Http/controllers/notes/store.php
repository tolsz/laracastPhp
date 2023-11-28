<?php

use Core\Validator;
use Core\App;

$db = App::resolve('Core\Database');

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query('INSERT into notes(body, user_id) VALUES (:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => getUserId()
]);

header('location: /notes');
die();