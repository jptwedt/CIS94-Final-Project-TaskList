<?php

include 'Page.php';
$page = new Page();
$page->title = 'Delete';
include 'header.php';
include_once'Tasklist.php';


function removeTask($input, $_tasklist){
  $_tasklist->deleteTask($input);
  $_tasklist->clearFile('test.csv');
  $_tasklist->saveAll();
}
$tasklist = new Tasklist();
$tasklist->loadRecords();

echo '<form  class="form-vertical" action="';
echo htmlspecialchars($_SERVER['PHP_SELF']);
echo '" method="post">';
echo '<fieldset>';
echo '<!-- Form Name -->';
echo '<legend>';
echo $page->title;
echo '</legend>';
echo '';
echo '<!-- Task -->';
echo '<!-- Completed -->';
if($tasklist->getTaskCount() > 0){
  echo '<div class="form-check">';
  for($i = 0; $i < $tasklist->getTaskCount(); $i++){
    echo '  <input class = "form-check-input" type="radio" class="radio" id="delete" name="delete" value='.$i.'>';
    echo '   <label class="form-check-label" for="delete">'.$tasklist->getTaskname($i).'</label><br>';
  }
  echo '</div>';
}
echo '<div class="form-group">';
echo '  <div class="col-md-8">';
echo '    <button id="submitdelete" name="submitdelete" class="btn btn-success">Delete</button>';
echo '  </div>';
echo '</div>';
echo '</fieldset>';
echo '</form>';


if(isset($_POST['submitdelete'])){
  if($tasklist->getTaskCount() > 0){
    removeTask($_POST['delete'], $tasklist);
  }
  else{
    echo "no more tasks";
  }
}
include 'footer.php';
