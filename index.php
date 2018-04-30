


<!doctype html>


<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Todo List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu|Oswald|Righteous" rel="stylesheet" /> 
    

    <!-- STYLES -->
    <link rel="stylesheet" href="/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous" />
    <link rel="stylesheet" href="/Todo-List-PHP/CSS/main.css" />

</head>
<body>
    

    <h2>Todo List</h2>

    <hr/>

   

    <!-- MAIN DIV -->
    <div class="container" id="main">

        

            <form class="form-group" method="post">
            <!-- INPUTS AND ADD BUTTON -->

                <div class="align-items-center input-div">
                    <h3><label for="todo">Specify a name for your task:</label><h3>
                    <input type="text" name="todo" id="todo" class="form-control" autofocus autocomplete="off">
                    <h3><label for="select">Add optional tags</label></h3>

                    <select class="custom-select" id="select">
                        <option value="Appointment">Appointment</option>
                        <option value="Work">Work</option>
                        <option value="Uni">Uni</option>
                        <option value="Home">Home</option>
                        <option value="Holiday">Holiday</option>
                    </select>

                    <input type="submit" class="btn btn-danger btn-block btn-primary" id="submit" value="Add"  disabled />
                </div>
                
        
            </form>


      
    </div>


    <!-- AJAX DATA LOADED HERE -->
    <div class="container" id="results">
        
        <h2 id="list-count">Your List <span class="badge badge-danger"></span></h2>

        <div class="container d-flex justify-content-end" id="sort-items">

            <label for="sort" class="custom-select-label"  style="margin-right: 10px">Sort</label>
            <select class="custom-select custom-select-sm" id="sort">
                <option value="#" selected>--</option>
                <option value="id">id</option>
                <option value="todo">alphabetical</option>
                <option value="date">timestamp</option>
            </select>
            

            <div class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="top" title="Still not functional">
                <input type="checkbox" class="custom-control-input" id="descending" disabled>
                <label class="custom-control-label" for="descending" >Descending</label>
            </div>

        </div>

         <table class="table table-light">
            <caption>List of todos</caption>
            
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Todo</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Timestamp</th>                    
                <tr>
            </thead>
           
            <tbody> 
            

            </tbody>

         </table>

    </div>         
    
    <!-- FOOTER ...  -->
    <footer class="container">
            
            <hr>	
			<ul>
				<li><i class="fab fa-facebook-f"></i></li>
				<li><i class="fab fa-github"></i></li>
				<li><i class="fab fa-twitter"></i></li>
				<li><i class="fab fa-linkedin-in"></i></li>
            
            </ul>       
            <span>&copy; Untitled. Design by <a href="https://www.github.com/scyhhe">Ivan Toporkov</a> 2018</span>
    
    </footer>

    
    <!-- JQUERY/JS SCRIPTS -->
    <script
              src="https://code.jquery.com/jquery-3.3.1.min.js"
              integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
              crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script src="js/fontawesome-all.js"></script>
    <script src="js/main.js"></script>



</body>

</html>