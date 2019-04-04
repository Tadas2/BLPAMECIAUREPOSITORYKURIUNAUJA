<?php

namespace Core\Abstracts;

abstract class Cookie {

    /**
     * Cookie pavadinimas
     * 
     * Jis naudojamas tiek nuskaitant duomenis iÅ¡
     * $_COOKIE, tiek funkcijoje setcookie
     * @var string 
     */
    protected $name;

    /**
     * Konstruktorius paprasÄ�iausia turi nuset'tintis $name
     */
    abstract public function __construct(string $name);

    /**
     * Turi patikrinti ar cookie duotu pavadinimu
     * egzistuoja
     */
    abstract public function exists(): bool;

    /**
     * Turi return'inti json_decode'intÄ… cookie'o
     * turinÄ¯. 
     * 
     * Patikrinti ar pavyko json_decode'inti
     * (Use Google)
     * Jei nepavyko, funkcija turi mesti warning'Ä…
     * (ne EXCEPTION'Ä…, bet WARNING'Ä… - Use Google).
     * ir return'inti tuÅ¡Ä�iÄ… array
     *  
     * Jei cookie'is nustatytu pavadinimu neegzistuoja,
     * turi return'inti tuÅ¡Ä�iÄ… array'Å³
     */
    abstract public function read(): array;

    /**
     * Turi Ä¯ Cookie duotu pavadinimu
     * iÅ¡saugoti json_encode'intÄ… $data array'jÅ³
     * (Google setcookie)
     * 
     * Ä® cookie galima Ä¯raÅ¡yt tik string'Ä….
     * Kadangi mes norim galimybÄ™ turÄ—ti Ä¯ tÄ… patÄ¯
     * Cookie storinti daugiau data'os, galim tiesiog
     * encode'inti ir decode'inti array'jÅ³ su json'u.
     * 
     * Mes Ä¯ cookie Ä¯raÅ¡ysim uÅ¾'json_encodinÄ™ $data
     * ir atkursim atgal json_decode'inÄ™ tai kÄ… radom Cookie
     * 
     * @param $data array
     * @param $expires_in int UÅ¾ kiek laiko sekundemis cookie nebegalios
     */
    abstract public function save(array $data, int $expires_in = 3600): void;

    /**
     * Turi iÅ¡trinti Cookie
     * (Use google)
     */
    abstract public function delete(): void;
    
}