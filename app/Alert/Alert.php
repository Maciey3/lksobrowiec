<?php
    namespace App\Alert;

    class Alert{
        public $status;
        public $message;
        public $duration;

        public function __construct($status, $message = "", $duration = 7){
            $this->status = strtolower($status);
            $this->message = $message;
            $this->setDefaultMessage();
            $this->duration = $duration;
        }

        public function setDefaultMessage() : void{
            if($this->message != ""){
                return;
            }
            
            if($this->status == 'success'){
                $this->message = "Pomyślnie wykonano zadanie";
            }
            else if($this->status == 'fail'){
                $this->message = "Nie udało się wykonać zadania";
            }
        }

        public function use(){
            session()->flash('alert', $this);
        }
    }

?>