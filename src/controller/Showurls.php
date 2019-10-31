<?php

//Redirect if not logged in
if (!$auth->isLogged()) {
    echo $twig->render('login.html.twig',['message' => 'Please LogIn']);
}

//read and destroy session message
$message = '';
if (isset($_SESSION['message'])) {
$message = $_SESSION['message'];
unset($_SESSION['message']);
}

//get current user infos
$currentUser = $auth->getCurrentUser();

//modify url
if(isset($_GET['modify_id']))
{
    //retrieve url to modify
    $sth = $dbh->prepare('SELECT url FROM rssnewsreader_urls WHERE uid =? AND id =? LIMIT 1');
    $sth->execute([$currentUser['id'], $_GET['modify_id']]);
    $result = $sth->fetch();
    echo $twig->render('modifyurl.html.twig', ['message' => $message, 'urlid' => $_GET['modify_id'], 'url' => $result, 'islogged' => $auth->isLogged()]);
    exit;
}

//delete url
if(isset($_GET['delete_id']))
{
    $sth = $dbh->prepare('DELETE FROM rssnewsreader_urls WHERE id='.$_GET['delete_id']);
    $sth->execute();
    //After delete show the remained URL list
    $_SESSION['message'] = 'URL Deleted';
    header('Location: index.php?url=showurls');
    exit;
}

//retrieve user urls
$sth = $dbh->prepare('SELECT id, uid, url FROM rssnewsreader_urls WHERE uid =?');
$sth->execute([$currentUser['id']]);
$result = $sth->fetchAll();
echo $twig->render('showurls.html.twig', ['message' => $message,'urls' => $result, 'islogged' => $auth->isLogged()]);