
alert("changes17");
$('#mpesa-express-form').on('submit',function(e){
    alert("submitted");
    e.preventDefault();

    let Amount = $('#Amount').val();
    let Phone = $('#Phone').val();

    
    $.ajax({
      url: "/mpesa-express",
      type:"POST",
      data:{
        '_token': $('meta[name="csrf-token"]').attr('content'),
        Amount:Amount,
        Phone:Phone,
      },
      success: function(response){
          var message = "";
          var ICON = "";

         if(response.ResponseCode == true && response.ResponseCode == "0")
         {
          console.log(typeof response);
          message = response.CustomerMessage;
          ICON = "success";
         }
         else 
         {// case where transaction is not accepted for processing
         console.log(response.errorMessage);
          message = response.errorMessage;
          ICON = "error";
          alert(response.errorMessage);
         }

alert(message);
        swal({
           title: "Transaction Status",
           text: message, //response.data.CustomerMessage,
           icon: ICON,
           button: "ok",
         });

        //console.log(response);
        //alert(response.data.CustomerMessage);
      },
      error: function(response) {
          //console.log(response);
          //alert(response.data.errorMessage);
      },
      });
    });