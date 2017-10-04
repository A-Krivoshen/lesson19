<?php

namespace controllers;

use models\Users\User;

class AuthController
{
    private function isInputCorrect($login, $password)
    {
        if (empty($login) || empty($password)) {
            $answer['error'] = 'Логин или пароль не введены';
            return json_encode($answer);
        }
        return true;
    }

    public function getNickname()
    {
        return $_SESSION['user'];
    }

    public function auth($login, $password)
    {
        if ($this->isInputCorrect($login, $password) !== true) return $this->isInputCorrect($login, $password);

        $auth = new User;
        if ($auth->login($login, $password)) {
            return json_encode(['location' => 'index.php']);
        } else {
            $answer['error'] = 'Неверный логин или пароль';
            return json_encode($answer);
        }
    }

    public function reg($login, $password)
    {
        if ($isInputCorrect = $this->isInputCorrect($login, $password) !== true) return $isInputCorrect;

        $auth = new User;
        if ($auth->isUserAlreadyExist($login)) {
            $answer['error'] = 'Такой пользователь уже есть в БД';
            return json_encode($answer);
        }

        if ($auth->register($login, $password)) {
            $answer['notice'] = 'Теперь войдите, используя креденшилз';
            return json_encode($answer);
        }
    }
}