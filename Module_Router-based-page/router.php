<?php
    include "routes.php";

    //change to extract the route from link

    if(!isset($URI)) $URI = explode('/',$_SERVER['REQUEST_URI']);

    if(isset($URI[$ROUTER_STEP])){
        echo "<br> Routing to " . ($URI[$ROUTER_STEP] == '' ? '/' : $URI[$ROUTER_STEP]);
        //There is another part of the link
        //So the router tries to resolute the path in CURRENT_ROUTE
        if($ROUTER_STEP == 0) {
            $CURRENT_ROUTE = $routes['/'];
        } else if(isset($CURRENT_ROUTE["error"])) {
            //if the URI still has a path, but the router already resolved an error
            //show the error page
            //(ignore further routing)
        } else if($URI[$ROUTER_STEP] == '') {
            if(isset($CURRENT_ROUTE["title"])) {
                //link to a page with a trailing slash
                //ignore this last slash and still show the page
                //(only ignores routing when there is no trailing path after the file, in that case an error will be thrown)
            } else if(isset($CURRENT_ROUTE["default"])) {
                $CURRENT_ROUTE = $CURRENT_ROUTE["default"];
            } else {
                $CURRENT_ROUTE = $routes['error'];
            }
        } else {
            if(isset($CURRENT_ROUTE[$URI[$ROUTER_STEP]])) {
                $CURRENT_ROUTE = $CURRENT_ROUTE[$URI[$ROUTER_STEP]];
            } else {
                $CURRENT_ROUTE = $routes['error'];
            }
        }
        $ROUTER_STEP += 1;
        include './router.php';
    } else {
        //change to set variables $path/$route etc. and $head or $title
        $PAGE_TITLE = $CURRENT_ROUTE["title"];
        $PAGE_PATH = $CURRENT_ROUTE["path"];
        $USE_HEADER = $CURRENT_ROUTE["header"];
        $USE_NAV = $CURRENT_ROUTE["nav"];
        $USE_FOOTER = $CURRENT_ROUTE["footer"];
    }

    /*
    $currentRoute = $_SERVER['REQUEST_URI'];
    $currentPage = $routes[$currentRoute];
    $filePath = $currentPage["path"];
    if($currentPage["header"]) include "../components/header.php";
    if($currentPage["nav"]) include "../components/nav.php";
    include $filePath;
    if($currentPage["footer"]) include "../components/footer.php";
    */
    
?>