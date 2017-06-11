<?php
class Task{
   private $taskname;
   private $description;
   private $completed;
   private $date_completed;
   public function __construct(){}
   public function getTaskname(){
      return $this->taskname;
   }
   public function setTaskname($_taskname){
      $this->taskname = $_taskname;
   }
   public function getDescription(){
      return $this->description;
   }
   public function setDescription($_desc){
      $this->description = $_desc;
   }
   public function getCompleted(){
      return $this->completed;
   }
   public function setCompleted($_comp){
      $this->completed = $_comp;
   }
   public function getDateCompleted(){
      return $this->date_completed;
   }
   public function setDateCompleted($_dcomp){
      $this->date_completed = $_dcomp;
   }
};
?>
