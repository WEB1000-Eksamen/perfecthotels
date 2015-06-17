<?php
    require_once 'app/bootstrap.php';
    require_once('app/views/layout/head.html');
?>
    <div class="container front-page">
        <div class="navbar-left active navbar-left-perfecthotels" id="search">
            <h1>Meny</h1>
            <ul class="navbar-left-menu">
                <li><a data-toggle="modal" data-target="#info-modal">Hjelp</a></li>
                <li><a class="edit-bookings-btn" data-toggle="modal" data-target="#edit-bookings-modal" >Dine bookings</a></li>
                <li><a class="checkin-btn" data-toggle="modal" data-target="#checkin-modal">Sjekk inn</a></li>
                <div class="clearfix"></div>
            </ul>
            <p>Finn et hotell som passer deg ved å benytte denne søkemodulen.</p>
            <form id="lookup-form">

                <div class="row select-query">
                    <div class="col-md-12 text"><strong>Jeg ønsker et hotell i</strong></div>
                    <div class="col-md-12 select-country">
                        <img class="ajax-loader-gif" alt="Laster inn" src="assets/images/ajax-loader.gif" />
                        <select tabindex="1" name="country" style="display: none;" class="form-control select-country-group">
                            <option disabled selected>Velg land...</option>
                        </select>
                    </div>
                </div>

                <div class="row select-query">
                    <div id="date-from-to" class="col-md-12 text"><strong>og vil ha rommet fra</strong></div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span id="fromDateButton" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input tabindex="2" readonly name="fromDate" type="text" id="fromDate" class="form-control" aria-describedby="date-from-to" />
                        </div>

                    </div>
                    <div id="date-from-to" class="col-md-12 text"><strong>til</strong></div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span id="toDateButton" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input tabindex="3" readonly name="toDate" type="text" id="toDate" class="form-control" aria-describedby="date-from-to" />
                        </div>
                    </div>
                </div>

                <div class="row select-query select-roomtype">
                    <div class="col-md-12 text"><strong>med romtype</strong></div>
                    <div class="col-md-12 select-roomtype-col">
                        <img style="display: none;" class="ajax-loader-gif" alt="Laster inn" src="assets/images/ajax-loader.gif" />
                        <p class="roomtype-error-text">Velg land først.</p>
                        <select tabindex="4" name="roomtype" style="display: none;" class="form-control select-roomtype-group">
                            <option disabled selected>Velg romtype...</option>
                        </select>
                    </div>
                </div>

                <div class="row select-query">
                    <div class="col-md-12">
                        <button id="searchBtn" tabindex="5" class="btn btn-lg btn-danger btn-block">Søk</button>
                    </div>
                </div>

            </form>
            <div class="navbar-hamburger">
                <i class="glyphicon glyphicon-menu-hamburger"></i>
                <i class="glyphicon glyphicon-remove"></i>
            </div>
        </div>
        <div class="row" id="results">
            <div class="col-md-12 page-header">
                <h1>Perfect Hotels Premium <img class="ajax-loader-gif" style="display: none;" alt="Laster inn" src="assets/images/ajax-loader-black.gif" /></h1>
            </div>
            <div class="col-md-12" id="the-results">
                <div class="row search-terms">
                    <div class="col-md-4 col-xs-4 text-center">Dato: <strong><span id="search-term-fromdate">10 Jun 2015</span> - <span id="search-term-todate">13 Jun 2015</span></strong></div>
                    <div class="col-md-4 col-xs-4 text-center">Land: <strong id="search-term-country">Norge</strong></div>
                    <div class="col-md-4 col-xs-4 text-center">Romtype: <strong id="search-term-roomtype">Suite</strong></div>
                </div>
                <div class="row result-errors">
                    <div class="col-md-12 please-search">
                        <h3>Vennligst velg hotell med søkeboksen til venstre.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once 'app/views/layout/footer.php';
?>