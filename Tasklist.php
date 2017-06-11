<?php

include 'Task.php';
/*
 * Author:  John Twedt
 * Email:  twedtj93614@student.vvc.edu
 * Class:  CIS94 Spring '17, Professer Tonning
 *
 * Description:
 *
 * Develop a Task class which has the following private properties
 * $description
 * $completed
 * $date_created
 * $date_completed
 * Create setter and getter methods for all of the properties of the Task class.
 * Develop a Tasklist class which will have the following properties:
 * an array to store tasks a method called addTask which takes a task as a
 * parameter and adds it to the list a method called printTasks which will
 * iterate through the list and print out each task.  The task printed will be
 * the description, whether completed or not and the date completed if it is
 * completed. When completed with this assignment, upload the directory to 
 * google drive.  Share the folder with vvcinstructor@gmail.com and past the 
 * link to the folder in the submission box provided on the assignment page.
 *
 */
/*
 * The following code will create a CSV (Comma Separated Value) file which is 
 * helpful for transferring data from one program to another (like 
 * spreadsheets), it also allows a programmer to save (or persist) data in a web
 *  program:
 *
 *  <?php
 *  $myfile = fopen("test.csv", "w") or die("Unable to open file!");
 *  $txt = "id,description,completed,date\n";
 *  fwrite($myfile, $txt);
 *  $txt = "1,Go to the dentist,yes,5/7/2017\n";
 *  fwrite($myfile, $txt);
 *  $txt = "2,Finish PHP project,no,\n";
 *  fwrite($myfile, $txt);
 *  $txt = "3,Go to the store,yes,5/2/2017\n";
 *  fwrite($myfile, $txt);
 *  fclose($myfile);
 *  $myfile = fopen("test.csv", "r") or die("Unable to open file!");
 *  echo fread($myfile,filesize("test.csv"));
 *  fclose($myfile);
 *  $row = 1;
 *  $header = ["id","description","completed","date"];
 *  if (($handle = fopen("test.csv", "r")) !== FALSE) {
 *    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
 *       $num = count($data);
 *       $row++;
 *       for ($c=0; $c < $num; $c++) {
 *          // the $header array defined above is how we can identify what 
 *          // the field index is describing
 *          echo $header[$c].": ".$data[$c]."\t";
 *       }
 *       echo "\n";
 *    }
 *    fclose($handle);
 *  }
 *  ?>
 *
 */

class Tasklist{
   private $tArr = array();
   private $csvfile;
   private $headers = array();
   public function __construct(){}
   public function __destruct(){}
   public function setHeaders($_headers){
      for($i = 0; $i < $_headers.count(); $i++){
        $headers[$i] = $_headers[$i];
      }
   }
   public function getHeader($index){
      return $this->headers[$index];
   }
   public function getHeaderCount(){
      return $this->headers.count();
   }
   public function getTaskCount(){
      return count($this->tArr);
   }
   public function getTaskname($index){
      return $this->tArr[$index]->getTaskname();
   }
   public function getTaskDescription($index){
      return $this->tArr[$index]->getDescription();
   }
   public function getTaskCompleted($index){
      return $this->tArr[$index]->getCompleted();
   }
   public function getTaskDateCompleted($index){
     $date;
     if(preg_match("~(y[es]?|no?)~i",$this->tArr[$index]->getCompleted())){
         $date = $this->tArr[$index]->getDateCompleted();
     }
     else{
         $date = "N/A";
     }
     return $date;
   }
   public function clearFile($filename){
      //clears the file of any text
      if(file_exists($filename)){
         file_put_contents($filename, "");
         //echo $filename." has been cleared. \n";
      }
   }
   public function clearArray(){
      //clears $tArr any values
      unset($this->tArr);
      $this->tarr = array();
   }
   public function addTask($newTask){
      $this->tArr[] = $newTask;
   }
   public function deleteTask($index){
     if(count($this->tArr) >= $index){
       unset($this->tArr[$index]);
       $this->tArr = array_values($this->tArr);
      }
      else{
        echo "task not found.";
      }
   }
   public function printTask(){
      if(is_array($this->tArr) || is_object($this->tArr)){
         foreach($this->tArr as $Task => $value){
            echo $value->getTaskname()."<br />";
            echo $value->getDescription()."<br />";
            echo $value->getCompleted()."<br />";
            if($value->getCompleted() == "yes"){
                echo $value->getDateCompleted()."<br /><br />";
            }
            else{
                echo "<br />";
            }
         }
      }
      else{
         echo "Source is neither an array nor object."."<br />";
      }
   }
   public function saveTask($_task){
      //saves individual tasks to $csvfile
      $this->csvfile = fopen("test.csv", "a") or die("Cannot open file!\n");
      $addTaskTxt = $_task->getTaskname().",".$_task->getDescription().",".$_task->getCompleted().","
         .",".$_task->getDateCompleted()."\n";
      fwrite($this->csvfile, $addTaskTxt);
      fclose($this->csvfile);
   }
   public function saveAll(){
      //saves all tasks in $tArr to file
      $this->csvfile = fopen("test.csv", "a") or die("Cannot open file!\n");
      if(is_array($this->tArr) || is_object($this->tArr)){
         foreach($this->tArr as $Tasks => $Task){
            $this->saveTask($Task);
         }
      }
      else{
         echo "Source is not an array or object."."<br />";
      }
   }
   public function loadRecords(){
      //loads all tasks listed in .csv file to $tArr
      if (($this->csvfile = fopen("test.csv", "r")) !== FALSE) {
         while (($data = fgetcsv($this->csvfile, 1000, ",")) !== FALSE) {
            $tempTask = new Task;
            $tempTask->setTaskname($data[0]);
            $tempTask->setDescription($data[1]);
            $tempTask->setCompleted($data[2]);
            if(preg_match("~y[es]?~i",$data[2])){
              $tempTask->setDateCompleted($data[3]);
            }
            else{
              $tempTask->setDateCompleted("N/A");
            }
            $this->addTask($tempTask);
         }
      }
      fclose($this->csvfile);
      //echo "<br />"."File loaded.\n"."<br />";
   }
   public function printCSVFileToHTML(){
      //outputs all tasks listed in .csv file
      $header = ["id","description","completed","date"];
      if (($this->csvfile = fopen("test.csv", "r")) !== FALSE) {
         while (($data = fgetcsv($this->csvfile, 1000, ",")) !== FALSE) {
            $num = count($data);
            for ($c=0; $c < $num; $c++) {
               echo $header[$c].": ".$data[$c]."\t";
         }
         echo "<br />";
         }
      }
      echo "<br />";
      fclose($this->csvfile);
   }
}
/*
$test1 = new Task();
$test1->setDescription("homework");
$test1->setCompleted("yes");
$test1->setDateCreated("4-28-17");
$test1->setDateCompleted("5-1-17");
$test2 = new Task();
$test2->setDescription("mow lawn");
$test2->setCompleted("no");
$test2->setDateCreated("1-19-04");
$test2->setDateCompleted("n/a");
$list = new Tasklist();
$list->addTask($test1);
$list->addTask($test2);
//$list->printTask();
$list->clearFile("test.csv");
$list->saveTask($test1);
echo "Output from .csv after first task added:"."<br />";
$list->printCSVFileToHTML();
$list->saveTask($test2);
echo "Output from .csv after second task added: <br/>";
$list->printCSVFileToHTML();
$list->clearFile("test.csv");
$list->saveAll();
echo "Output from file after all tasks in array saved to .csv: <br/>";
$list->printCSVFileToHTML();
echo "Clearing array... <br/><br />";
$list->clearArray();
echo "Adding array values from .csv file back into array...<br/><br />";
$list->loadRecords();
echo "Output from array: <br />"; 
$list->printTask();
 */
?>
