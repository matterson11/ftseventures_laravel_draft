<?php

/*
//Check if search data was submitted
if (isset($_GET['s'])) {
    // Include the search class
    // require_once(dirname(__FILE__) . 'class-search.php');
    require_once ("class-search.php");
    // Instantiate a new instance of the search class
    $search = new search();

    // Store search term into a variable
    $search_term = htmlspecialchars($_GET['s'], ENT_QUOTES);

    $search_term = $_GET['s'];

    // Send the search term to our search class and store the result
    $search_results = $search->search($search_term);
}
*/
?>

        <!DOCTYPE html>
<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/website.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">


</head>
<body>

<nav class="navbar navbar-custom navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="main_page.php">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="main_page.php">Home</a></li>
                <li><a href="dealings_page.php">Director Dealings</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form action="company_page.php" class="search_form" method="get" autocomplete="off">
                    <div class="form-field">
                        <input type="text" name="s" class="search_keyword" id="search_keyword_id"
                               placeholder="Search the FTSE 100 & 250" required/>
                        <button type="submit" class="search_button" onclick="submitdata()">Search</button>
                        <div id="result"></div>
                    </div>
                </form>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
