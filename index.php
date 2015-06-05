<?php
    require_once 'app/bootstrap.php';
    require_once('app/views/layout/head.html');
?>
<<<<<<< HEAD
    <div class="container-fluid front-page">
        <div class="row">
            <div class="col-md-3" id="search">
                <h2>Søk:</h2>
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Velg land</p>
                        </div>
                        <div class="col-md-8">
                        <select class="form-control">
                            <option>Norge</option>
                            <option>Sverige</option>
                            <option>Danmark</option>
                        </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input placeholder="Innsjekking" name="date[]" type="text" id="dateFrom" class="form-control date" />
                        </div>
                        <div class="col-md-6">
                            <input placeholder="Utsjekking" name="date[]" type="text" id="dateTo" class="form-control date" />
                        </div>
                    </div>
                </form>
=======

    <div class="container front-page">
        <div class="navbar-left active navbar-left-perfecthotels" id="search">
            <h1>Meny</h1>
            <ul class="navbar-left-menu">
                <li><a href="">Hjelp</a></li>
                <li><a href="">Se bookings</a></li>
                <li><a href="">Sjekk inn</a></li>
                <div class="clearfix"></div>
            </ul>
            <p>Finn et hotell som passer deg ved å benytte denne søkemodulen.</p>
            <form>

                <div class="row select-query">
                    <div class="col-md-12 text"><strong>Jeg ønsker et hotell i</strong></div>
                    <div class="col-md-12 select-country">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" name="country" value="Norge" id="option1" autocomplete="off" checked> <strong>Norge</strong>
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="country" value="Norge" id="option2" autocomplete="off"> <strong>Sverige</strong>
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="country" value="Norge" id="option3" autocomplete="off"> <strong>Danmark</strong>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row select-query">
                    <div id="date-from-to" class="col-md-12 text"><strong>og vil ha rommet fra</strong></div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input name="fromDate" type="text" id="fromDate" class="form-control" aria-describedby="date-from-to" />
                        </div>

                    </div>
                    <div id="date-from-to" class="col-md-12 text"><strong>til</strong></div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input name="toDate" type="text" id="toDate" class="form-control" aria-describedby="date-from-to" />
                        </div>
                    </div>
                </div>

                <div class="row select-query select-roomtype">
                    <div class="col-md-12 text"><strong>med romtype</strong></div>
                    <div class="col-md-12">
                        <select class="form-control">
                            <option>Suite (2 senger)</option>
                            <option>Grupperom (4 senger)</option>
                        </select>
                    </div>
                </div>

                <div class="row select-query">
                    <div class="col-md-12">
                        <button id="searchBtn" class="btn btn-lg btn-danger btn-block">Søk</button>
                    </div>
                </div>

            </form>
            <div class="navbar-hamburger">
                <i class="glyphicon glyphicon-menu-hamburger"></i>
                <i class="glyphicon glyphicon-remove"></i>
>>>>>>> 5323306bd0854b37738bd510490dfed3cddf8e4f
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
                            <div style="background: url(https://placeholdit.imgix.net/~text?txtsize=50&txt=750%C3%97250&w=750&h=250) no-repeat center; background-size: cover;" class="col-md-3 result-image"></div>
                            <div class="col-md-9 result-content">
                                <div class="row result-header">
                                    <div class="col-md-12">
                                        <h2>
                                            The Overlook Hotel
                                        </h2>
                                        <p>Ledige rom: <strong>9</strong></p>
                                        <div class="clearfix"></div>
                                        <span class="address">Raveien 227 A, 3084 Borre</span>
                                    </div>
                                </div>
                                <div class="row result-description">
                                    <div class="col-md-9">
                                        <div class="result-body">
                                            <p>Vær ikke redd for de to søstrene som står i gangen og vil leke. De er egentlig snille! (Stol på oss, ok???)</p>
                                            <p>Vær ikke redd for de to søstrene som står i gangen og vil leke. De er egentlig snille! (Stol på oss, ok???)</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h2 class="result-price">1 000 NOK</h2>
                                        <p class="result-price-info">pr natt, pr pers</p>
                                    </div>
                                </div>
                                <div class="row result-footer">
                                    <div class="col-md-9 result-categories">
                                        <ul>
                                            <li>Kort vei til sentrum</li>
                                            <li>Fine damer på by'n</li>
                                            <li>Åtte potte søppelskotte</li>
                                            <li>Rånere er det mye av</li>
                                            <div class="clearfix"></div>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 result-order">
                                        <button data-hotel-id="" class="btn btn-primary">
                                            Velg
                                        </button>
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