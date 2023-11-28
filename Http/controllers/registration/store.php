<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = LoginForm::validate($attributes = [
    'email' => $email,
    'password' => $password
]);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    $form->error('email', 'User already exists.')->throw();
    // TODO show email in the view
} else {
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]);

    $newUser = $db->query('select * from users where email = :email', [
        'email' => $email
    ])->find();

    (new Authenticator)->login($newUser);

    header('location: /');
    exit();
}