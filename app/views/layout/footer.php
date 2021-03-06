
    <div data-backdrop="static" data-keyboard="false" class="modal fade" id="order-hotel-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="ajax-loader-container">
                    <img class="ajax-loader-big" alt="Laster inn" src="assets/images/ajax-loader-big.gif">
                </div>
            </div>
        </div>
    </div>

    <div data-backdrop="static" data-keyboard="false" class="modal fade" id="checkin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2>Sjekk inn</h2>
                </div>
                <div class="modal-body checkin-modal-container">
                    <div class="step1">
                        <div class="row">
                            <div class="col-md-12" id="checkin-modal-step1-container">
                                <p>Vennligst oppgi referansenummer</p>
                                <input class="form-control modal-checkin-reference-input"
                                       type="text"
                                       name="referenceNumber"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Referansenummeret må være 6 tegn" />
                                <button role="button" class="btn btn-default btn-lg btn-block modal-checkin-submit" disabled>Sjekk inn</button>
                            </div>
                        </div>
                    </div>
                    <div class="step2">
                        <div class="row">
                            <div class="col-md-12" id="checkin-modal-step2-container">
                                <div class="ajax-loader-container">
                                    <img src="assets/images/ajax-loader-big.gif" alt="Laster inn...">
                                </div>
                                <div class="checkin-modal-step2-error" style="display: none;">
                                    <p class="checkin-modal-step2-error-text"></p>
                                </div>
                                <div class="checkin-modal-step2-success" style="display: none;">
                                    <p>Vi fant <span class="checkin-modal-step2-number-of-bookings"></span> booking(s) du kan sjekke inn på i dag.</p>
                                    <p>Vennligst velg booking(s) under du ønsker å sjekke inn på.</p>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th class="text-center">Velg</th>
                                            <th>Hotellnavn</th>
                                            <th>Romtype</th>
                                            <th>Fra</th>
                                            <th>Til</th>
                                        </thead>
                                        <tbody class="checkin-modal-step2-table-body">
                                        </tbody>
                                    </table>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="step3">
                        <div class="row">
                            <div class="col-md-12" id="checkin-modal-step3-container">
                                <div class="ajax-loader-container">
                                    <img src="assets/images/ajax-loader-big.gif" alt="Laster inn...">
                                </div>
                                <div class="checkin-modal-step3-error" style="display: none;">
                                    <p class="checkin-modal-step3-error-text"></p>
                                </div>
                                <div class="checkin-modal-step3-success" style="display: none;">
                                    <p>Du er nå sjekket inn! Velkommen skal du være.</p>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Hotellnavn</th>
                                            <th>Referanse</th>
                                            <th>Romnummer</th>
                                            <th>Romtype</th>
                                        </thead>
                                        <tbody class="checkin-modal-step3-table-body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button style="display: none;" class="btn btn-success pull-right checkin-modal-step2-do-booking">Sjekk inn</button>
                    <button style="display: none;" class="btn btn-primary pull-left checkin-modal-go-back">Gå tilbake</button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div data-backdrop="static" data-keyboard="false" class="modal fade" id="edit-bookings-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2>Dine bookings</h2>
                </div>
                <div class="modal-body edit-bookings-modal-container">
                    <div class="step1">
                        <div class="row">
                            <div class="col-md-12" id="edit-bookings-modal-step1-container">
                                <p>Vennligst oppgi referansenummer</p>
                                <input class="form-control modal-bookings-reference-input"
                                       type="text"
                                       name="referenceNumber"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Referansenummeret må være 6 tegn" />
                                <button role="button" class="btn btn-default btn-lg btn-block modal-bookings-submit" disabled>Se/endre bookings</button>
                            </div>
                        </div>
                    </div>
                    <div class="step2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ajax-loader-container">
                                    <img src="assets/images/ajax-loader-big.gif" alt="Laster inn...">
                                </div>

                                <div style="display: none;" class="edit-bookings-modal-step2-error">
                                </div>
                                <div style="display: none;" class="edit-bookings-modal-step2-table-container">
                                    <p>Du har <span class="edit-bookings-modal-step2-number-of-bookings"></span> booking(s).</p>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Hotellnavn</th>
                                            <th>Romtype</th>
                                            <th>Fra</th>
                                            <th>Til</th>
                                            <th>Innsjekket</th>
                                            <th>Endre</th>
                                            <th>Slett</th>
                                        </thead>
                                        <tbody class="edit-bookings-modal-step2-table"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button style="display: none;" class="btn btn-primary edit-bookings-modal-go-back">Gå tilbake</button>
                </div>
            </div>
        </div>
    </div>

<?php
// templates
    require_once 'app/views/templates/result.html';
    require_once 'app/views/templates/error.html';

// modals
    require_once 'app/views/modals/info-modal.html';
    require_once 'app/views/modals/order-modal.html';
    require_once 'app/views/modals/order-modal-error.html';
?>
    
    <script type="text/javascript" src="assets/js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jsrender/jsrender.min.js"></script>
    <script type="text/javascript" src="assets/js/moment-with-locales.js/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/menu.js"></script>
    <script type="text/javascript" src="assets/js/result-helpers.js"></script>
    <script type="text/javascript" src="assets/js/modal-helpers.js"></script>
    <script type="text/javascript" src="assets/js/order-modal.js"></script>
    <script type="text/javascript" src="assets/js/checkin.js"></script>
    <script type="text/javascript" src="assets/js/checkin-modal.js"></script>
    <script type="text/javascript" src="assets/js/edit-bookings-modal.js"></script>
    <script type="text/javascript" src="assets/js/edit-bookings.js"></script>
    <script type="text/javascript" src="assets/js/init.js"></script>
</body>
</html>