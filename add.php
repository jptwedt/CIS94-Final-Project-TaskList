<?php

include 'Page.php';
$page = new Page();
$page->title = 'Add Task';
include 'header.php';
include_once 'Tasklist.php';
include 'form_tpl.php';

// 1.
// Put the Task class in a file called Task.php
// Then include it here as is done for the header.php and form_tpl.php and footer.php 
// files above

function addTask($input){
  $task = new Task();
  $tasklist = new Tasklist();
  $newtask = $newcompleted = $newdesc = $datecomp = "";
  if(!empty($_POST)){
    $newtask = $_POST['task'];
    $desc = $_POST['note'];
    $completed = $_POST['completed'];
    $datecomp = $_POST['datecompleted'];
    if(preg_match("~[\w\s]+~",$newtask)){
      $task->setTaskname($newtask);
      $task->setDescription($desc);
      $task->setCompleted($completed);
      if($newcompleted === 'yes'){
        $task->setDateCompleted($datecomp);
      }   
      else{
        $task->setDateCompleted("N/A");
      }
      $tasklist->saveTask($task);
      echo "Task added.";
    }
    else{
      echo "Error:  invalid entry.";
    }
  }
}


// 3. 
// this check is what will start the process to add the task , it assures
// the process of not printing anything other than the form and a success message
// when the task is successfully added.

if(isset($_POST['submittask'])) {
   addTask($_POST); 
}

include 'footer.php';
?>
