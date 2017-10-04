<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/core.php';
require_once __DIR__ . '/src/autoload.php';

$user = new models\Users\User;
if (!$user->isAuth()) {
    header('Location: auth.php');
}

if (!empty($_POST['logout'])) {
    echo $user->logout();
    die;
}

$tasksController = new controllers\TasksController;

if (!empty($_POST['addTask'])) {
    $tasksController->add();
    echo $tasksController->getLastTask();
    die;
}

if (!empty($_POST['getAllUsers'])) {
    echo $user->getAllUsers();
    die;
}

if (!empty($_POST['isDoneChange'])) {
    echo $tasksController->changeStatus();
    die;
}

if (!empty($_POST['delete'])) {
    $tasksController->delete();
    die;
}

if (!empty($_POST['editDescription'])) {
    echo $tasksController->editDescription();
    die;
}

if (!empty($_POST['sortBy'])) {
    echo $tasksController->sort($_POST['sortBy']);
    die;
}

if (!empty($_POST['changeAssignedUser'])) {
    echo $tasksController->changeAssignedUser($_POST['assignedUser']);
    die;
}

$users = $user->getAllUsers();

$task = new models\Tasks\Task;
$tasksOfUser = $task->getTasksOfUser();
$tasksForUser = $task->getTasksForUser();

$loader = new Twig_Loader_Filesystem('src/views/twig');
$twig = new Twig_Environment($loader);

echo $twig->render('index.twig', [
    'tasksOfUser' => $tasksOfUser,
    'tasksForUser' => $tasksForUser,
    'quantityForUserTasks' => $tasksForUser->rowCount(),
    'quantityOfUserTasks' => $tasksOfUser->rowCount(),
    'sessionUser' => $_SESSION['user'],
    'users' => $users
]);


