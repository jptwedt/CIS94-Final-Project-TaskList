<form  class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<fieldset>

<!-- Form Name -->
<legend><?php echo $page->title; ?></legend>

<!-- Task -->
<div class="form-group">
  <label class="col-md-4 control-label" for="task">Task</label>  
  <div class="col-md-4">
  <input id="task" name="task" type="text" placeholder="Enter Task" class="form-control input-md">
  <span class="help-block">Enter the task in the box above.</span>  
  </div>
</div>

<!-- Note -->
<div class="form-group">
  <label class="col-md-4 control-label" for="note">Note</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="note" name="note"></textarea>
  </div>
</div>
<!-- Completed -->
<div class="form-group">
  <label class="col-md-4 control-label" for="completed">Completed?</label>
    <label class="form-check-label"><input type="radio" class="radio-inline" style="padding-left:20px"id="completed" name="completed" value="yes">yes</label>
    <label class="form-check-label"><input type="radio" class="radio-inline" id="completed" name="completed" value="no" checked>no</label>
</div>
<!-- Date Completed -->
<div class="form-group">
  <label class="col-md-4 control-label" for="datecompleted">Date Completed</label>
  <div class="col-md-4">                     
    <input type="date" class="form-control" id="datecompleted" name="datecompleted">
  </div>
</div>


<div class="form-group">
  <div class="col-md-8">
    <button id="submittask" name="submittask" class="btn btn-success">Add</button>
  </div>
</div>

</fieldset>
</form>
