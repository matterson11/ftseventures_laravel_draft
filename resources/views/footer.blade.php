<footer class="footer">
    <div class="container">
        <div class="row">
            <ul class="nav navbar-centered navbar-nav">
                <li><a href="main_page.php">Main Page</a></li>
                <li><a href="dealings_page.php">Director Dealings</a></li>
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

<script type="text/javascript">
    $(function () {
        $(".search_keyword").keyup(function () {
            var search_keyword_value = $(this).val();
            var dataString = 'search_keyword=' + search_keyword_value;
            if (search_keyword_value != '') {
                $.ajax({
                    type: "POST",
                    url: "search.php",
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