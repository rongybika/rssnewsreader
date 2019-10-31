<?php

//If not logged redirect to login page
if (!$auth->isLogged()) {
    echo $twig->render('login.html.twig', ['message' => 'Please LogIn']);
    exit;
}

    if(isset($_POST['submit']) && isset($_POST['new_url'])){
        //Check if valid URL
        if (filter_var($_POST['new_url'], FILTER_VALIDATE_URL)) {
            //get current user infos
            $currentUser = $auth->getCurrentUser();

            $sth = $dbh->prepare('UPDATE rssnewsreader_urls SET url = "'.$_POST['new_url'].'" WHERE id=? AND uid=?');
            if ($sth->execute([$_POST['url_id'], $currentUser['id']])) {
                //After modify/update show URL list
                $_SESSION['message'] = 'URL Updated';
                header('Location: index.php?url=showurls');
                exit;
            } else {
                $_SESSION['message'] = 'Some error occurred. Please contact the administrator';
                header('Location: index.php?url=showurls');
                exit;
            }    
        } else {
            //Show message if Invalid URL
            echo $twig->render('modifyurl.html.twig', ['message' => 'Invalid URL', 'islogged' => $auth->isLogged()]);
            exit;
        }
    } else {
        echo $twig->render('modifyurl.html.twig');
        exit;
    }