<?php

class GetBookingsFn {
    
    public function referenceIsValid ($Reference) {
        if (strlen($Reference) != 6) {
            return false;
        }
        if (!ctype_alnum($Reference)) {
            return false;
        }
        
        return true;
    }
    
}