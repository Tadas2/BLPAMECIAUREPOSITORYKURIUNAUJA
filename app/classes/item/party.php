<?php

namespace App;

class Party {

    private $users;
    private $gerimai;

    const STATUS_POOP = 'poop';
    const STATUS_SLOPPY = 'sloppy';
    const STATUS_GOOD = 'good';
    const STATUS_FIRE = 'fire';
    const STATUS_VOMITTRON = 'vomittron';
    const STATUS_PENDING = 'pending';
    const PURE_ALC_IN_VODKA_L = 400;

    public function __construct(\App\Model\ModelUser $model_user, \App\Model\ModelGerimai $model_gerimai) {

        $this->users = $this->model_user->loadAll();
        $this->gerimai = $this->model_gerimai->loadAll();
    }
    public function getUserCount() {
        return count($this->users);
    }

}

?>