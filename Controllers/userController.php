<?php
require_once(__DIR__ . '/../Models/UserModel.php');


function login()
{
    $userModel = new UserModel();

    if (isset($_POST['login']) && isset($_POST['pwd']) && (!empty($_POST['login'])) && (!empty($_POST['pwd']))) {
        $login = strip_tags($_POST['login']);
        $pwd = strip_tags($_POST['pwd']);
        $userModel->login($login, $pwd);
    }
}

function signin()
{
    $userModel = new UserModel();

    if (isset($_POST['login']) && isset($_POST['pwd']) && (!empty($_POST['login'])) && (!empty($_POST['pwd']))) {
        $login = strip_tags($_POST['login']);
        $pwd = strip_tags($_POST['pwd']);

        //ICI on hash le password pour plus de sécurité
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $userModel->signin($login, $pwd);
    }
}