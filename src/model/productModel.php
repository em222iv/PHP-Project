<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 15:26
 */

class productModel{

    private $array;
  function categories($categories) {


      foreach($categories as $categorie){
          $this->array['id'] =  $categorie[0];
          $this->array['name'] = $categorie[1];
          $this->array['image'] = "<dd>" .
              '<img src="data:image/jpeg;base64,'.
              base64_encode($categorie[2]).
              '" width="20" height="20">' . "</dd>";

      }

  }

    public function getCategories(){
        return $this->categories;

    }
    public function getCategoryArray(){
        return $this->array;

    }
}
