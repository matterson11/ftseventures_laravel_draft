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
            <a class="navbar-brand" href="/">FTSE Ventures</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                <li><a href="/dealings">Director Dealings</a></li>
                <li><a href="/about">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form action="/search" class="search_form" method="get" autocomplete="off">
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

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="row">
            <ul class="nav navbar-centered navbar-nav">
                <li><a href="/">Main Page</a></li>
                <li><a href="/dealings">Director Dealings</a></li>
            </ul>
        </div>
    </div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script type="text/javascript">$.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});</script>

<script type="text/javascript">
    $(function () {
        $(".search_keyword").keyup(function () {
            var search_keyword_value = $(this).val();
            var dataString = 'search_keyword=' + search_keyword_value + '&_token={{ csrf_token() }}';
            if (search_keyword_value != '') {
                $.ajax({
                    type: "POST",
                    url: "/searching",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        $("#result").html(html).show();
                    }
                });
            }
            return false;
        });

        $("#result").live("click", function (e) {
            var $clicked = $(e.target);
            if (e.target.nodeName == "STRONG")
                $clicked = $(e.target).parent().parent();
            else if (e.target.nodeName == "SPAN")
                $clicked = $(e.target).parent();
            var $name = $clicked.find('.name').html();
            var decoded = $("<div/>").html($name).text();
            $('#search_keyword_id').val(decoded);
        });

        $(document).live("click", function (e) {
            var $clicked = $(e.target);
            if (!$clicked.hasClass("search_keyword")) {
                $("#result").fadeOut();
            }
        });

        $('#search_keyword_id').click(function () {
            $("#result").fadeIn();
        });
    });
</script>


</body>
</html>