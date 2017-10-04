<?php
/**
 * Created by PhpStorm.
 * User: slon
 * Date: 04.11.2017
 * Time: 20:10
 */

$authController = new controllers\AuthController;

if (!empty($_POST['authButton'])) echo $authController->auth($_POST['login'], $_POST['password']);
if (!empty($_POST['regButton'])) echo $authController->reg($_POST['login'], $_POST['password']);