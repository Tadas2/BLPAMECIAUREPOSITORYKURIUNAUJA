<?php

class Girl {

    function beSmart() {
        return 'im smart';
    }

    function beBeautiful() {
        return 'im beautiful';
    }

}

class Girlfriend extends Girl {

    function pistiProta() {
        return 'prisikai trusikus o man plaut';
    }

}

class Wife extends Girlfriend {
    function pistiProta() {
        return 'prisikai trusikus o man plaut tik as su ziedu';
    }
}

?>