<?php

include 'Page.php';
$page = new Page();
$page->title = 'List';
include 'header.php';
//include 'tablemaker.php';
include_once 'Tasklist.php';
// Add code here that will load the CSV file with the tasks in it
// and will print the tasks in a table
// The following is an example of how the table will be printed 
// between the header and the footer

$tasklist = new Tasklist();
$tasklist->loadRecords();

echo '<table class="table">';  // this is styled as a bootstrap table
echo '    <thead>';
echo '      <tr>';
echo '        <th>Task</th>';
echo '        <th>Description</th>';
echo '        <th>Completed(Y/N)</th>';
echo '        <th>Date Completed</th>';
echo '      </tr>';
echo '    </thead>';
echo '    <tbody>';
for($i = 0; $i < $tasklist->getTaskCount(); $i++){
  echo '      <tr>';
  echo '        <td>';
  echo $tasklist->getTaskname($i).'</td>';
  echo '        <td>';
  echo $tasklist->getTaskDescription($i).'</td>';
  echo '        <td>';
  echo $tasklist->getTaskCompleted($i).'</td>';
  echo '        <td>';
  echo $tasklist->getTaskDateCompleted($i).'</td>';
  echo '      </tr>';
}
echo '    </tbody>';
echo '</table>';

include 'footer.php';

