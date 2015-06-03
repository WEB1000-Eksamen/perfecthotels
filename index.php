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
            <div class="row">
                <div class="col-md-12 result-container">
                    <div class="row">
                        <div style="background: url(http://placekitten.com/g/250/250) no-repeat center; background-size: cover;" class="col-md-3 result-image"></div>
                        <div class="col-md-9 result-description">
                            <div class="result-header">
                                <h2>
                                    Hotell Kattetoppen
                                    <div class="result-order pull-right">
                                        <button class="btn btn-xl btn-primary">Bestill Kattetoppen</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </h2>
                                <p>Ledige rom: <strong>9</strong></p>
                            </div>
                            <div class="result-body">
                                <p>
                                    Velkommen til <strong>Hotell Kattetoppen</strong>
                                </p>
                                <p>
Curabitur sed bibendum tortor, ac vehicula sem. Phasellus ac ante id ante consectetur semper. Donec sagittis congue mi, eget varius nunc lacinia quis. Etiam nec purus vitae elit suscipit suscipit vitae eget erat. Duis dapibus porta diam, vitae tincidunt risus dictum ac. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris facilisis nisl nisi, et pellentesque enim imperdiet id. Nullam bibendum massa eget metus tincidunt, eu vulputate nisl auctor. Aliquam egestas dignissim tempus. Curabitur ac fringilla odio. Proin posuere libero enim, in pharetra mauris sagittis quis. Etiam dictum fringilla congue. Sed feugiat sem lorem, in viverra sapien efficitur sit amet.
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 result-container">
                    <div class="row">
                        <div style="background: url(http://lorempixel.com/output/business-q-c-640-480-2.jpg) no-repeat center; background-size: cover;" class="col-md-3 result-image"></div>
                        <div class="col-md-9 result-description">
                            <div class="result-header">
                                <h2>
                                    Hotell Runketoppen
                                    <div class="result-order pull-right">
                                        <button class="btn btn-xl btn-primary">Bestill Kattetoppen</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </h2>
                                <p>Ledige rom: <strong>9</strong></p>
                            </div>
                            <div class="result-body">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum vulputate sem. Morbi interdum purus consectetur fermentum efficitur. Nam vitae interdum turpis. Fusce porta sagittis dui, et scelerisque ex interdum a. Nam venenatis faucibus felis, tempor porta quam sagittis sit amet. Nunc et euismod arcu. Vivamus vulputate nibh enim. Suspendisse non lacinia velit, ac volutpat leo. Sed aliquam ultricies odio ullamcorper vestibulum.
                                </p>
                                <p>
Curabitur sed bibendum tortor, ac vehicula sem. Phasellus ac ante id ante consectetur semper. Donec sagittis congue mi, eget varius nunc lacinia quis. Etiam nec purus vitae elit suscipit suscipit vitae eget erat. Duis dapibus porta diam, vitae tincidunt risus dictum ac. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris facilisis nisl nisi, et pellentesque enim imperdiet id. Nullam bibendum massa eget metus tincidunt, eu vulputate nisl auctor. Aliquam egestas dignissim tempus. Curabitur ac fringilla odio. Proin posuere libero enim, in pharetra mauris sagittis quis. Etiam dictum fringilla congue. Sed feugiat sem lorem, in viverra sapien efficitur sit amet.
                                </p>
                            </div>
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
<?php
    require_once('app/views/layout/footer.html');
?>