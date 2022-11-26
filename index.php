<html>
 <head>
  <title>Live Add Edit Delete Datatables Records using PHP Ajax</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }


  /* Dropdown Button */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}

  </style>
 </head>
 <body>
  <div class="container box">

   <h1 align="center">Add Edit Delete Datatables Records </h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
    </div>
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered">
     <thead>
      <tr>
                      <th>Name</th>
                      <th>Mark 1</th>
                      <th>Mark 2</th>
                      <th>Mark 3</th>
                      <th>Total</th>
                      <th>Rank</th>
       <th></th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
 </body>
</html>

<script type="text/javascript" language="javascript" >
  
  $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetch.php",
     type:"POST",
     success:function(data){
        var result= JSON.parse(JSON.stringify(data)); 
        console.log(result);
        var html;
        $.each( data, function( key, value ) {              
             html += "<tr> <td><div data-column='student_id' data-id="+value['student_id']+">"+value['student_id']+"</div></td>  <td><div contenteditable class='update' data-column='mark_1' data-id="+value['student_id']+">"+value['mark_1']+"</div></td><td><div contenteditable class='update' data-column='mark_2' data-id="+value['student_id']+">"+value['mark_2']+"<div></td><td><div contenteditable class='update' data-column='mark_3' data-id="+value['student_id']+">"+value['mark_3']+"</div></td><td><div contenteditable class='update' data-column='total' data-id="+value['student_id']+">"+value['total']+"<div></td><td><div contenteditable class='update' data-column='rank' data-id="+value['student_id']+">"+value['rank']+ "</div></td> <td><button type='button' name='delete' class='btn btn-danger btn-xs delete' id="+value['student_id']+">Delete</button></td></tr>";              
        }); 
        $('#user_data tbody').prepend(html);
     }
   }
   });
  }


  function update_data(id, column_name, value)
  {
    console.log(id);
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function()
  {
   var html = '<tr>';
   html += '<td><div id="data1"></div></td>';
   html += '<td><div id="data2"></div></td>';
   html += '<td><div id="data3"></div></td>';
   html += '<td><div id="data4"></div></td>';
   html += '<td><div id="data5"></div></td>';
   html += '<td><div id="data6"></div></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function()
  {
   var student_id = $('#data1').text();
   var mark_1 = $('#data2').text();
   var mark_2 = $('#data3').text();
   var mark_3 = $('#data4').text();
   var total = $('#data5').text();
   var rank = $('#data6').text();

    console.log(rank);
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{student_id:student_id, mark_1:mark_1, mark_2:mark_2, mark_3:mark_3, total:total, rank:rank},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
 });
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });


</script>
