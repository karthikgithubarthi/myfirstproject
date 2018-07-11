<?php
  include "database.php";
  $selectQuery = mysqli_query($con,"select * from type_list");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 
</head>
<body>


  
<div class="container">
  <div class="col-sm-12">
    <div class="row">
        <form id="target" action="#">
            <div class="col-sm-4">
             <select class="form-control" id='taskdet' name="task_types" >

                <option value="">select</option>
                <?php
                  while($fetQuery = mysqli_fetch_array($selectQuery)){
                    echo '<option value="'.$fetQuery['id'].'">'.$fetQuery['type_name'].'</option>';
                  }
                ?>

            </select>
            </div>
            <div class="col-sm-2">
              <select class="form-control" name="opr">
                <option value="">select</option>
                  <option value="1">=</option>
                   <option value="2">!=</option>
                  
                 
                </select>
            </div>
            <div class="col-sm-4">
             <select class="form-control type_lists" name="type_lists">
                <option value="">select</option>
              </select>
            </div>
            <div class="col-sm-2">
             <input type="submit" name="submit" value="search">
            </div>
          </form>
        </div>
  </div>
  <div class="col-sm-12">
    <table class="table table-hover">
   <thead>
      <tr>
         <th>#</th>
         <th>Emp Name</th>
         <th>depart Name</th>
         <th>prject</th>
         <th>Task List</th>
         <th>Task Status</th>
         <th>Food</th>
      </tr>
   </thead>
   <tbody class="tast_table">
      
   </tbody>
</table>
  </div>
</div>



</body>

<script type="text/javascript">
  
  $(document).ready(function() {
    $('#taskdet').change(function(){
      var type_id = $(this).val();
      if(type_id){
        var ajaxReturn = ajaxCall('actions.php','json',{ type_id : type_id, type : "getTypes" });
        var listHtml = '';
        listHtml += '<option value="">Select type list</option>';
        if(ajaxReturn.length){
            $.each(ajaxReturn, function(ajaxReturnKey, ajaxReturnValue){
                listHtml += `<option value="${ajaxReturnValue.id}">${ajaxReturnValue.name}</option>`;
            });
        }
        $('.type_lists').html(listHtml);
      }
    });
  });


  $('#target').submit(function(e){
      e.preventDefault();
      var formValue =`${$(this).serialize()}&type=getTaskList`;
      var ajaxReturn = ajaxCall('actions.php','json',formValue);
      if(ajaxReturn.length){
         var listHtml = '';
         $.each(ajaxReturn, function(ajaxReturnKey, ajaxReturnValue){
            listHtml += `
              <tr> 
                 <th scope="row">${parseInt(ajaxReturnKey) + parseInt(1)}</th>
                 <td>${ajaxReturnValue.emp_name}</td>
                 <td>${ajaxReturnValue.dep_name}</td>
                 <td>${ajaxReturnValue.project_name}</td>
                 <td>${ajaxReturnValue.task_name}</td>
                 <td>${ajaxReturnValue.task_status}</td>
                 <td>${ajaxReturnValue.food_name}</td>
              </tr>
            `;
         });
         $('.tast_table').html(listHtml);
      }
  });


function ajaxCall(url, type = null, data = null, method = null){
  var returnData = '';
   $.ajax({
        url: url,
        method: (method) ? method : 'post',
        dataType: (type) ? type : 'html',
         data: (data) ? data : '' ,
         async : false,
        success: function(data) {
          returnData =  data;
        },
        error : function(err){
          returnData = err;
        }
    });
   return returnData;
}
//
</script>

</html>





