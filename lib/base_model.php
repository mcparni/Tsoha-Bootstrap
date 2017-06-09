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

    private function validate_ID($id) {
        if(!(is_numeric($id)))
          return "Id virhe";
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

    public function validate_player_description() {
      return $this->validate_string_length("Kuvaus", $this->description, 5);
    }

    public function validate_name() {
      return $this->validate_string_length("Nimi" , $this->name, 5);
    }

    public function validate_general_ID($id) {
      return $this->validate_ID($id);
    }

    public function validate_result() {
      return $this->validate_string_length("Tulos", $this->result, 1);
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
          $error = $this->{$validator}();
          if($error)
            array_push($errors, $error);
      }
      return $errors;
    }

  }
