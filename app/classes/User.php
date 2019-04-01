<?php

namespace App;

class User {

    /**
     * @var array
     */
    private $data;

    const ORIENTATION_GAY = 'g';
    const ORIENTATION_STRAIGHT = 's';
    const ORIENTATION_BISEXUAL = 'b';
    const GENDER_FEMALE = 'f';
    const GENDER_MALE = 'm';

    /**
     * User constructor.
     * @param null $data
     */
    public function __construct($data = null) {
        if (!$data) {
            $this->data = [
                'username' => null,
                'email' => null,
                'full_name' => null,
                'age' => null,
                'gender' => null,
                'orientation' => null,
                'photo' => null
            ];
        } else {
            $this->setData($data);
        }
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username) {
        $this->data['username'] = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->data['username'];
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email) {
        $this->data['email'] = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->data['email'];
    }

    /**
     * @param string $full_name
     */
    public function setFullName(string $full_name) {
        $this->data['full_name'] = $full_name;
    }

    /**
     * @return mixed
     */
    public function getFullName() {
        return $this->data['full_name'];
    }

    /**
     * @param int $age
     */
    public function setAge(int $age) {
        $this->data['age'] = $age;
    }

    /**
     * @return mixed
     */
    public function getAge() {
        return $this->data['age'];
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender) {
        if (in_array($gender, [$this::GENDER_FEMALE, $this::GENDER_MALE])) {
            $this->data['gender'] = $gender;
        }
    }

    /**
     * @return mixed
     */
    public function getGender() {
        return $this->data['gender'];
    }

    /**
     * @return array
     */
    public static function getGenderOptions() {
        return [
            self::GENDER_FEMALE => 'Female',
            self::GENDER_MALE => 'Male'
        ];
    }

    /**
     * @param string $orientation
     */
    public function setOrientation(string $orientation) {
        if (in_array($orientation, [$this::ORIENTATION_GAY, $this::ORIENTATION_STRAIGHT, $this::ORIENTATION_BISEXUAL])) {
            $this->data['orientation'] = $orientation;
        }
    }

    /**
     * @return mixed
     */
    public function getOrientation() {
        return $this->data['orientation'];
    }

    /**
     * @return array
     */
    public static  function getOrientationOptions() {
        return [
            self::ORIENTATION_GAY => 'Gay',
            self::ORIENTATION_STRAIGHT => 'Straight',
            self::ORIENTATION_BISEXUAL => 'Bisexual'
        ];
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo) {
        $this->data['photo'] = $photo;
    }

    /**
     * @return mixed
     */
    public function getPhoto() {
        return $this->data['photo'];
    }

    /**
     * @param array $data
     */
    public function setData(array $data) {
        $this->setUsername($data['username'] ?? '');
        $this->setEmail($data['email'] ?? '');
        $this->setFullName($data['full_name'] ?? '');
        $this->setAge($data['age'] ?? null);
        $this->setGender($data['gender'] ?? '');
        $this->setOrientation($data['orientation'] ?? '');
        $this->setPhoto($data['photo'] ?? '');
    }

    /**
     * @return array
     */
    public function getData() {
        return $this->data;
    }
}