<?php
include "routes.php";

//change to extract the route from link

if (!isset($URI))
    $URI = explode('/', $_SERVER['REQUEST_URI']);

if (isset($URI[$ROUTER_STEP])) {
    //There is another part of the link
    //So the router tries to resolute the path in CURRENT_ROUTE
    if ($ROUTER_STEP == 0) {
        echo "<br> Routing to /";
        $CURRENT_ROUTE = $routes['/'];
    } else if (isset($CURRENT_ROUTE["error"])) {
        echo "<br> Routing to Error";
        //if the URI still has a path, but the router already resolved an error
        //show the error page
        //(ignore further routing)
    } else if ($URI[$ROUTER_STEP] == '') {
        if (isset($CURRENT_ROUTE["title"])) {
            //link to a page with a trailing slash
            //ignore this last slash and still show the page
            //(only ignores routing when there is no trailing path after the file, in that case an error will be thrown)
        } else if (isset($CURRENT_ROUTE["default"])) {
            $CURRENT_ROUTE = $CURRENT_ROUTE["default"];
        } else {
            $CURRENT_ROUTE = $routes['error'];
        }
    } else {
        echo "<br> Routing to " . $URI[$ROUTER_STEP];
        if (isset($CURRENT_ROUTE[$URI[$ROUTER_STEP]])) {
            $CURRENT_ROUTE = $CURRENT_ROUTE[$URI[$ROUTER_STEP]];
        } else {
            $CURRENT_ROUTE = $routes['error'];
        }
    }
    $ROUTER_STEP += 1;
    include './router.php';
} else {
    //change to set variables $path/$route etc. and $head or $title
    $PAGE_TITLE = isset($CURRENT_ROUTE["title"]) ? $CURRENT_ROUTE["title"] : (isset($PAGE_TITLE) ? $PAGE_TITLE : '');
    $PAGE_PATH = isset($CURRENT_ROUTE["path"]) ? $CURRENT_ROUTE["path"] : (isset($PAGE_PATH) ? $PAGE_PATH : "");
    $USE_HEADER = isset($CURRENT_ROUTE["header"]) ? $CURRENT_ROUTE["header"] : (isset($USE_HEADER) ? $USE_HEADER : true);
    $USE_NAV = isset($CURRENT_ROUTE["nav"]) ? $CURRENT_ROUTE["nav"] : (isset($USE_NAV) ? $USE_NAV : true);
    $USE_FOOTER = isset($CURRENT_ROUTE["footer"]) ? $CURRENT_ROUTE['footer'] : (isset($USE_FOOTER) ? $USE_FOOTER : true);
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