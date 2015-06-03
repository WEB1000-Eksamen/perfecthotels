<?php
    require_once 'app/bootstrap.php';
    require_once('app/views/layout/head.html');
?>
<div class="container front-page">
    <div class="navbar-left active navbar-left-perfecthotels" id="search">
        <h1>Meny</h1>
        <p>Finn et hotell som passer deg</p>
        <form>
            <div class="row select-query">
                <div class="col-md-4">Velg land:</div>
                <div class="col-md-8">
                    <select class="form-control">
                        <option>Norge</option>
                        <option>Sverige</option>
                        <option>Danmark</option>
                    </select>
                </div>
            </div>
            <div class="row select-query">
                <div id="date-from-to" class="col-md-12">Velg Tidsrom:</div>
                <div class="col-md-6 first">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="text" id="dateFrom" class="form-control" aria-describedby="date-from-to" />
                    </div>
                    
                </div>
                <div class="col-md-6 last">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="text" id="dateTo" class="form-control" aria-describedby="date-from-to" />
                    </div>
                </div>
            </div>
            
        </form>
        <div class="navbar-hamburger">
            <i class="glyphicon glyphicon-menu-hamburger"></i>
        </div>
    </div>
    <div class="row" id="results">
        <div class="col-md-12 page-header">
            <h1>Perfect Hotels Premium</h1>
        </div>
        <div class="col-md-12">
            <div class="row  result-container">
                <div class="col-md-12">
                    <div class="row">
                        <div style="background: url(http://placekitten.com/g/250/250) no-repeat center; background-size: cover;" class="col-md-3 result-image"></div>
                        <div class="col-md-9">
                            
                            <div class="row result-header">
                                <div class="col-md-9">
                                    <h2>Hotell Kattetoppen</h2>
                                </div>
                                <div class="col-md-3">
                                    <p class="text-right">Ledige rom: <strong>9</strong></p>
                                </div>
                            </div>
                            <div class="row result-description">
                                <div class="col-md-9">
                                    <div class="result-body">
                                        <p>Velkommen til <strong>Hotell Kattetoppen</strong></p>
                                        <p>Curabitur sed bibendum tortor, ac vehicula sem. Phasellus ac ante id ante consectetur semper. Donec sagittis congue mi, eget varius nunc lacinia quis.</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h2 class="text-right">1 000 NOK</h2>
                                    <p class="text-right">pr natt, pr pers</p>
                                </div>
                            </div>
                            <div class="row result-footer">
                                <div class="col-md-9">

                                </div>
                                <div class="col-md-3">
                                    <div class="result-order pull-right">
                                        <button class="btn btn-xl btn-primary">Bestill Kattetoppen</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require_once('app/views/layout/footer.html');
?>