<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap</title>

    <style>
        body {
            background-color: rgb(204, 203, 203) !important;
        }
        ul {
            list-style-type: none !important;
        }
        .brand-text {
            color: #0d6efd !important;
        }
        form{
             max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
        .red-text{
            color: red;
        }
        div a {
            text-decoration: none;
        }
    </style>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar bg-light p-4 navbar-light navbar-fixed-top">
        <div class="container ">
        <a class="navbar-brand fs-3 fw-bold brand-text" href="#">UEAB Recipes</a>
        <ul id="nav-mobile" class="position-end">
            <li><a href="#" class="btn btn-primary text-uppercase p-2">Add a Recipe</a></li>
        </ul>
        <ul id="nav-mobile" class="position-end">
            <li><a href="index.php" class="btn btn-danger text-uppercase p-2">Log out</a></li>
        </ul>
        </div>
    </nav>