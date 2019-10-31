<?php

//attempt to regist the user
if (isset($_POST['uemail']) && isset($_POST['psw'])){
    //register the user
    $registeredUser = $auth->register($_POST['uemail'], $_POST['psw'], $_POST['psw-repeat'], Array(), null, null);

    if ($registeredUser['error']) {
        echo $twig->render('register.html.twig',['message' => $registeredUser['message']]);
    } else {
        echo $twig->render('login.html.twig',['message' => 'Please LogIn']);
    }
} else {
    //Render Registration page
    echo $twig->render('register.html.twig');
}