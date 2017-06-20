<?php

  class BaseModel{

    protected $validators;

    public function __construct($attributes = null){

      foreach($attributes as $attribute => $value){

        if(property_exists($this, $attribute)){

          $this->{$attribute} = $value;

        }
      }
    }

    private function validate_string_length($field, $string, $length) {
      if(strlen($string) < $length)
        return $field . ' -kentän pituus täytyy olla vähintään '.$length.' merkkiä.';
    }

    private function validate_string_max($field, $string, $length) {
      if(strlen($string) > $length)
        return $field . ' -kentän pituus saa olla enintään '.$length.' merkkiä.';
    }

    private function validate_ID($id) {
        if(!(is_numeric($id)))
          return "Id virhe";
    }

    public function validate_name_max() {
      return $this->validate_string_max("Nimi", $this->name, 50);
    }
    public function validate_description_max() {
      return $this->validate_string_max("Kuvaus", $this->description, 500);
    }

    public function validate_description() {
      return $this->validate_string_length("Kuvaus", $this->description, 10);
    }

    public function validate_sport_sort() {
      $order = $this->sort_order;
      $order = (int) $order;
      if($order === 1 || $order === 0)
        return null;
      else
        return "Väärä tulosjärjestys.";

    }

    public function validate_new_password_max()  {
      return $this->validate_string_max("Uusi salasana", $this->n_password_1, 50);
    }
    public function validate_new_password2_max() {
      return $this->validate_string_max("Uusi salasana uudestaan", $this->n_password_2, 50);
    }

    public function validate_player_description() {
      return $this->validate_string_length("Kuvaus", $this->description, 5);
    }

    public function validate_name() {
      return $this->validate_string_length("Nimi" , $this->name, 1);
    }

    public function validate_password_length() {
      return $this->validate_string_length("Salasana" , $this->password, 8);
    }

    public function validate_new_password_length() {
      return $this->validate_string_length("Uusi salasana" , $this->n_password_1, 8);
    }

    public function validate_new_password2_length() {
      return $this->validate_string_length("Uusi salasana uudestaan" , $this->n_password_2, 8);
    }

    public function validate_admin_name_change() {
      if($this->name != $this->oldname && $this->password != $this->oldpassword)
        return "Salasana ei täsmää.";
      else
        return null;
    }

    public function validate_new_password_match() {
        if($this->n_password_1 != $this->n_password_2)
          return "Uudet salasanat eivät täsmää.";
        else
          return null;

    }

    public function validate_old_password_match() {
        if($this->password != $this->oldpassword)
          return "Vanha salasana ei täsmää.";
        else
          return null;

    }

    public function validate_general_ID($id) {
      return $this->validate_ID($id);
    }

    public function validate_result() {
      return $this->validate_string_length("Tulos", $this->result, 1);
    }

    public function validate_result_integer() {
      $result = $this->result;
      

      if(is_numeric($this->result))
        $result = $result + 0;
      else
        return "Tuloksen täytyy olla kokonaisluku."; 

      
      if(is_int($result))
        return null;
      else 
        return "Tuloksen täytyy olla kokonaisluku."; 
    
    }

    public function validate_sport() {
      $sport = Sport::find((int) $this->sport_id);
      if($sport)
        return null;
      else
        return "Lajia ei löydy";
    }

    public function validate_player() {
      $player = Player::find((int) $this->player_id);
      if($player)
        return null;
      else
        return "Pelaajaa ei löydy";
    }

    public function validate_player_ID() {
      return $this->validate_ID($this->id);
    }

    public function errors(){
      $errors = array();
      foreach($this->validators as $validator){
          
          $error =$this->{$validator}();
          if($error)
            array_push($errors, $error);
      }
      return $errors;
    }

  }
