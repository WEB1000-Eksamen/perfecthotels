<?php
    require_once('app/views/layout/head.html');
?>
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
                    <input type="text" id="dateFrom" class="form-control" />
                </form>
            </div>
            <div class="col-md-9" id="results">
            </div>
        </div>
    </div>
<?php
    require_once('app/views/layout/footer.html');
?>