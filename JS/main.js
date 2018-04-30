// MAIN JS FILE FOR HANDLING AJAX REQUESTS

//main init function for reading DB entries and displaying them - defined here so it is global

function loadData(sortBy = '', desc = false) {

 

  $.ajax({
    type: "GET",
    url: "read.php?load=true&sortBy=" + sortBy + "&desc=" + desc,
    dataType: "json",
    success: function(response) {

      let elem =  $('tbody');
      let count = response.length;
      let badge = $('.badge');

      elem.empty();

      //add response data to table
      
      $.each(response, function(key,value) {
        
        elem.append("<tr id=" + value.id +">");
        elem.append("<th scope='row'>" + value.id);
        elem.append("<td>" + value.todo);
        elem.append("<td>" + value.tags);
        elem.append("<td>" + value.created_on);
        elem.append('<td><i id=' + value.id + ' class="far fa-edit"></i>');
        elem.append('<td><i id=' + value.id + ' class="fas fa-times"></i>');
        elem.append("</tr>");

      })
      
      // display row count
      
      if (count) {
        badge.show();
        badge.html('(' + count + ')');
      
      } else {
        badge.hide();
      }

         
    },
    error: function(response) {

      //handle redirect to non-ajax version (really bad one :D) or remain here
      let redirect = 'http://vankolivehosting-com.stackstaging.com/todo/';

      swal({
        
        title: "Something went wrong...",
        text: "There is a problem with the database or the server itself which will reflect upon the functionality of this app.To avoid mishaps, the ADD button will be disabled. Please use the earlier version without AJAX by clicking the 'Redirect' button.",
        icon: "warning",
        buttons: [ 'Stay Here', 'Redirect'  ]
      
      }).then(function(value) {
        
        if (value) {
          window.location.href = redirect;
        } 
      
      });

      $('#submit, .table, #results > h2').hide();


    }
    
  })

  //end of AJAX CALL


}

//end of loadData
///////////////////////////////////////////////////////////////////////////////////////////////////

//start of beautify function //////

function beautify() {
      
  let btn = $('#submit');
  let divBorder = $('#main');
  let todo = $('#todo');
  
  if ( todo.val().length >= 3 || todo.val().length > 15 ) {     

    btn.removeAttr('disabled');
    btn.css('cursor', 'pointer');
    btn.removeClass('btn-danger');
    btn.val('Add Todo');
    
    divBorder.css('border-top', '15px solid #007bff');
    

  } else {

    btn.attr('disabled', true);
    btn.css('cursor', 'not-allowed');
    btn.addClass('btn-danger');
    btn.val('Please enter at least 3 symbols');

    divBorder.css('border-top', '15px solid #dc3545');

  }

}

//////////
// end of beautify
/////////


//start of autoloaded func

$(function() {

  loadData();  //init load


  // button ux and color switches

  

  //end of beautify()     

  $('#todo').keyup(function() {

    beautify();
    
  });

    //main button functionality (ADD)

    $("#submit").click(function(e) {

      e.preventDefault()

      let todoValue = $('#todo').val().toLowerCase();
      let todoTags = $('#select option:selected').val().toLowerCase(); 

      let format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
          
        if (todoValue.trim().length < 3 || format.test(todoValue)) {
        
          // throw new Error("All whitespace strings are not allowed. Please enter at least two valid characters");
          swal({
            title: "Try again.",
            text: "All whitespace strings and special characters are not allowed. Please enter at least three VALID characters",
            icon: "warning",
          });
          
        
        } else {

          // ajax call to php script CREATE
          
          $.ajax({
            
            method: 'POST',
            url: "create.php",
            data: {
              todo: todoValue,
              tags: todoTags
            },
            success: function(result) {

              beautify();
              loadData();

              if (result == "success") {

                swal({
                  title: "Success!",
                  text: "Todo added!",
                  icon: 'success',
                  button: "Great!",
                });

              }
                            
            },
            error: function(result) {

              beautify();
              loadData();
            
            }
          })

          $('#todo').val("");
        }
    });

});

// AJAX call to DELETE & UPDATE
$('tbody').on('click', '[data-fa-i2svg]', function(e) {

  let target = $(e.currentTarget);
  let targetId = target.attr('id');

  // call to delete 
  if (target.hasClass('fa-times')) {

    swal({

      title: 'Are you sure?',
      text: 'You are about to permanently delete this row.',
      icon: 'warning',
      buttons: ['Nevermind', 'Delete']
    }).then(function(value) {

      // if user confirms the popup then send call to delete.php
      if (value) {
        
        $.ajax({
          type: 'GET',
          url: 'delete.php?id=' + targetId,
          success: function(response) {

            // console.log(response);
            beautify();
            loadData();

            swal({
              title: "Deleted successfully!",
              icon: "success",
            });

          },
          error: function(response) {

            console.log(response);
          }
        })

        
        
      } 
      loadData();
    })
 
  } else if (target.hasClass('fa-edit')) {

  
    

    swal({
      text: 'Enter a new value for your todo: ',
      content: 'input',
      button: {
        text: 'Edit'
      }
    }).then(value => {
      if (!value) {
        throw null;
      } else if (value.trim().length < 3 || format.test(value)) {

        swal({
          title: "Try again.",
          text: "All whitespace strings and special characters are not allowed. Please enter at least three VALID characters",
          icon: "warning",
        });
      
      } else {

      $.ajax({
        type: 'POST',
        url: 'update.php',
        data: {
          id: targetId,
          text: value
        },
        success: function(response) {

          loadData();

          swal('Success!', { icon: 'success'});
          
        }
      })
      }
    })
  }


})

// sort functionality
$('#sort').on('change', function() {
  
  let value = this.value;

  if (value != "#") {
    
    loadData(value);

  }

})

// and descending sort functionality - has some annoying bug atm so its disabled
// $('#descending').on('change', function() {

//   let sortMethod = $('#sort').val();

//   console.log('onChange alert. Current sort method is ' + sortMethod);

//   if ( $(this).prop("checked") ) {

//     loadData(sortMethod, true);
  
//   } else {
    
//     loadData(sortMethod);
  
//   }
// })

// Add AJAX call to flush db when user closes the page .... TODO : flush DB even if user follows a link / redirects to another page


$(window).on('beforeunload', function() {
  $.ajax({
    url: 'dbflush.php',
    type: 'POST'
  });



});
    



