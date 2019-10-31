<?php

//If not logged redirect to login page
if (!$auth->isLogged()) {
    echo $twig->render('login.html.twig', ['message' => 'Please LogIn']);
    exit;
}

    //add new url to the list
    if (isset($_POST['submit']) && isset($_POST['new_url'])) {
        //Check if valid URL
        if (filter_var($_POST['new_url'], FILTER_VALIDATE_URL)) {
            //get current user infos
            $currentUser = $auth->getCurrentUser();

            $sth = $dbh->prepare('INSERT INTO rssnewsreader_urls (id, uid, url) VALUES (?,?,?)');
            if ($sth->execute([null, $currentUser['id'], $_POST['new_url']])){
                //After insert into the database show the URL list page
                //echo $twig->render('showurls.html.twig', ['message' => 'URL Inserted', 'islogged' => $auth->isLogged()]);
                $_SESSION['message'] = 'URL Inserted';
                header('Location: index.php?url=showurls');
                exit;
            } else{
                $_SESSION['message'] = 'Some error occurred. Please try again or contact the administrator';
                    header('Location: index.php?url=showurls');
                    exit;
            }
        } else {
            //Show message if Invalid URL
            echo $twig->render('addnewurl.html.twig', ['message' => 'Invalid URL', 'islogged' => $auth->isLogged()]);
        }
    } else {
        //Render Addnewurl page
        echo $twig->render('addnewurl.html.twig',['islogged' => $auth->isLogged()]);
    }