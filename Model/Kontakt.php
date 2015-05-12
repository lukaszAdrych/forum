<?php
/**
 * Created by PhpStorm.
 * User: aich
 * Date: 2015-05-12
 * Time: 16:23
 */

class Model__Kontakt extends Model__DB {

    public $imie;

    public $nazwisko;

    public $email;

    public $telefon;

    public $data_urodzenia;

    public $id_user;

    /**
     * @param mixed $imie
     */
    public function setImie($imie)
    {
        $this->imie = $imie;
    }

    /**
     * @param mixed $nazwisko
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $telefon
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;
    }

    /**
     * @param mixed $data_urodzenia
     */
    public function setDataUrodzenia($data_urodzenia)
    {
        $this->data_urodzenia = $data_urodzenia;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * @return mixed
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * @return mixed
     */
    public function getDataUrodzenia()
    {
        return $this->data_urodzenia;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }


    public function save() {

        if (strlen($this->nazwisko) > 0) {

            $stmt = $this->pdo->prepare("
                INSERT into post (nazwisko, imie, email, telefon, data_urodzenia, id_user)
                VALUES (:nazwisko, :imie, :email, :telefon, :data_urodzenia, :id_user)"
            );

            $stmt->execute(array(':nazwisko' => $this->nazwisko,
                ':imie' => $this->imie,
                ':email' => $this->email,
                ':telefon' => $this->telefon,
                ':data_urodzenia' => $this->data_urodzenia,
                ':id_user' => $this->id_user,
            ));

        }

    }

    public function update() {

        $stmt = $this->pdo->prepare("
                UPDATE post SET nazwisko=:nazwisko, imie=:imie, email=:email,
                telefon=:telefon, data_urodzenia=:data_urodzenia, id_user=:id_user WHERE id = $this->id"
        );

        $stmt->bindValue(':nazwisko', $this->nazwisko, PDO::PARAM_STR);
        $stmt->bindValue(':imie', $this->imie, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':telefon', $this->telefon, PDO::PARAM_INT);
        $stmt->bindValue(':data_urodzenia', $this->data_urodzenia, PDO::PARAM_STR);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);

        $stmt->execute();
    }


    public function find($parametry) {
        $zapytanie = "SELECT * FROM $this->table WHERE ";

        foreach ($parametry as $key => $val) {
            if(isset($key)) {

                $zapytanie = $zapytanie . $key . "=" . $val . " AND ";
            }
        }

        $zapytanie = substr($zapytanie, 0, strlen($zapytanie) - 4);
        $zapytanie = $zapytanie . "LIMIT 1";

        $stmt = $this->pdo->prepare($zapytanie);
        $stmt->execute();

        $kontakt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($kontakt) == 1) {
            $this->id = $kontakt[0]['id'];
            $this->nazwisko = strip_tags($kontakt[0]['nazwisko']);
            $this->imie = strip_tags($kontakt[0]['imie']);
            $this->email = strip_tags($kontakt[0]['email']);
            $this->telefon = strip_tags($kontakt[0]['telefon']);
            $this->data_urodzenia = strip_tags($kontakt[0]['data_urodzenia']);
            $this->id_user = strip_tags($kontakt[0]['id_user']);

            return true;
        }
        return false;
    }


}