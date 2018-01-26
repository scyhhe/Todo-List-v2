<?php 
     
    include('Db.php');
    include('Todo.php');
    // include('todolist.php'); // won't need it as we will be using a DB

    $db = new DB();
    // $myList = new TodoList();

    
    $success = "";
    $error = "";
    $duplicate = true;

    // DELETE TODO BY ID
    if ( isset($_POST['id'])) {

        $id = $_POST['id'];
        $res = $db->delete($id);
        $success = "Todo deleted!";
      
    }
    
    //ADD TODO TO DB
    else if ( isset($_POST['todo']) && isset($_POST['tags']) ) {
        
        $todo = $_POST['todo'];
        $tags = $_POST['tags'];

       

        if (strlen($todo) < 3) {
            
            $error .= "Task name must be <strong>at least</strong> 3 characters long";
        
        }

        //TODO: add duplicate data protection
        
        else {
            $db->insert($todo,$tags);
            $success .= "Todo added!";
        }
        
    }

        
    $table = 'todo';
    $res = $db->select($table);

    $num_rows = mysqli_num_rows($res);



    
?>



<!doctype html>


<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Todo List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" /> 
    

    <!-- STYLES -->
    <link rel="stylesheet" href="/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/main.css" />

</head>
<body>
    
    <!-- ALERT -->
    <div class="container" id="alert-container">

            <?php if ($error) { ?>

                    <div class='alert alert-danger alert-dismissible rounded-0' role="alert">
                        <span class"alert-message"><?php echo $error; ?></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                <?php }

                else if($success) { ?>
                    
                    <div class='alert alert-light alert-dismissible rounded-0' role="alert">
                        <span class"alert-message"><?php echo $success; ?></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

            <?php    
                
                }

            ?>

    </div>

    <?php
            
        //I feel wrong for doing this in this particular way
           
        if ($error || $success) { ?>

            <div class="container">
                <hr />
            </div>            
    <?php     
            
        }

    ?>

    <!-- MAIN DIV -->
    <div class="container rounded-right" id="main">

        

      <form class="form-group" method="post">
        <div class="row">
          
            <!-- INPUTS AND ADD BUTTON -->

            <div class="col-sm-4 col-md-6 align-items-center">
                <h3><label for="todo">Specify a name for your task</label><h3>
                <input type="text" name="todo" id="todo" class="form-control" autofocus>
                <h3><label for="todo">Add tag/s to identify your task</label></h3>
                <input type="text" name="tags" id="tags" class="form-control" >

                <input type="submit" class="btn btn-secondary" id="submit" value="Add"/>
            </div>
            <div class="col-sm-8 col-md-6">
                <h1 class="display-4">My List
                    <small class="text-muted">(<?php echo $num_rows; ?>)</small>
                </h1>
                
                <!-- FETCH TODOS FROM DB AND DISPLAY THEM -->
                <ul class="list-group list-group-flush" id="sortable">
                    <?php 
                            while ($row = mysqli_fetch_row($res)) {
                    ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $row[1]; ?>
                                    <span class="badge badge-secondary badge-pill"><?php echo $row[2]; ?></span>
                                    
                                    <button type="submit" class="close" name="id" value=<?php echo $row[0]; ?> >
                                        &times;                                       
                                    </button>
                                </li>
                    <?php 
                           }
                    ?>
                </ul>
            
            </div>
        </div>

                          
       
      </form>

      

      
    </div>

    
    <!-- JQUERY/JS SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/tweaks.js"></script>


</body>

</html>