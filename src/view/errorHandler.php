<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 20/10/14
 * Time: 18:54
 */

class ErrorHandler{
    private $addView;
    private $editView;
    private $errorCase;

    public function __construct(EditView $editView, AddView $addView) {
        $this->addView = $addView;
        $this->editView = $editView;

    }
    public function setErrorMSG($errorMSG) {
        $this->errorCase = $errorMSG;
        $this->errorHandlingSwitch();
    }
    //gets info on what errormsg should be rendering in its view
    public function errorHandlingSwitch() {
        if(is_int($this->errorCase)){
            switch ($this->errorCase) {
                case 0:
                    $this->addView->setErrorMSG("nameError");
                    $this->editView->setEditErrorMSG("Invalid name: Name has to be longer than 2 character and only alphabetic or numeric character");
                    break;
                case 1:
                    $this->addView->setErrorMSG("descError");
                    $this->editView->setEditErrorMSG("Invalid description: Description must be longer than 10 characters");
                    break;
                case 2:
                    $this->addView->setErrorMSG("priceError");
                    $this->editView->setEditErrorMSG("Invalid price: Price must be between 1 - 10000 and be of numeric characters");
                    break;
                case 3:
                    $this->addView->setErrorMSG("imageError");
                    $this->editView->setEditErrorMSG("Invalid picture: Picture must be smaller than 1,5MB and be of types JPG/JPEG, PNG or GIF");
                    break;
            }
        }
    }
}