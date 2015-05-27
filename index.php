<!DOCTYPE html>
<html>
<head>
    <title>Perfect Hotels Premium</title>
    <meta charset="utf8">
    <link rel="stylesheet" type="text/css" href="assets/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/custom-style.css">

    <script type="text/javascript" src="assets/js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
</head>
<body role="document">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    Perfect Hotels Premium
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="#">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid front-page">
        <div class="row">
            <div class="col-md-3" id="search">
                <h2>Søk:</h2>
                <form>
                    <select class="form-control">
                        <option>Norge</option>
                        <option>Sverige</option>
                        <option>Danmark</option>
                    </select>
                    <input type="text" class="form-control" />
                </form>
            </div>
            <div class="col-md-9" id="results">
            </div>
        </div>
    </div>
</body>
</html>