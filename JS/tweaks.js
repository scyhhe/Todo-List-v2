$( function() {

    //jquery ui
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
    
    // add active class to li element
    $( ".list-group-item" ).hover(
      function() {
      $(this).addClass("active");
  
    },
      function() {
      
      $(this).removeClass("active");

    });

    //Prevent submit if input is empty

    $ ("#submit").click(function() {

      if ($("#todo").val() == "" ) {

        $("#todo").attr
        (
          "placeholder", "Give your task a name e.g. laundry, exams, etc..."
        )
        $("#todo").css("border-bottom", "2px solid red");
        return false;
      }

    });

    //dismiss alerts and autofocus input
    $(".close").click(function() {

      $("div[role='alert']").hide();
      $("hr").hide();

      $("#todo").focus();


    });
    
    


});

//TODO: Add AJAX call to flush db window.onbeforeunload = function() {}

