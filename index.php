<?php
include('./User.php');

/* Init Object */
$user = new User();

/* Insertion */
$user->setName('Unes');
$user->setEmail('unes@mm.ma');
$user->setPassword('123456');
$user->Create();

/* Get All Users */
$allUsers = $user->All();
echo json_encode($allUsers);


/* Get One User */
$user->setId(1);
$row = $user->Single();
echo json_encode($row);

/* Update User */
$user->setId(1);
$user->setName('Younes');
$user->setEmail('unes@zizo.ma');
$user->Update();


/* Delete User */
$user->setId(1);
$user->Delete();