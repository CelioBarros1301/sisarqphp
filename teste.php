<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="sidebar/css/style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="sidebar/css/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="fontawesome/js/solid.js"></script>
    <script defer src="fontawesome/js/fontawesome.js"></script>


</head>



<body>
        <div class="container">
            <div row>
                <div col="sm-4">
                    <button class="btn btm-primary"><a href="sisarq.html">
                        Enviar</a>
                    </button>
                </div>
            </div>
        </div>
        <a href="https://www.w3schools.com"><button class="btn btn-primary">teste</button></a>
    
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="jquery/jquery-3.3.1.slim.min.js"></script>
    <!-- Popper.JS -->
    <script src="jquery/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap4/js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="sidebar/js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">


        $(document).ready(function () {
            $('#tbEmpresa').DataTable();
        });
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>

</html>