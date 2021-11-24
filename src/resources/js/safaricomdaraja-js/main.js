
alert("changes7");
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
      success:function(response){
          var message = "";
          var ICON = "";

          if(response.data.ResponseCode && response.data.ResponseCode == "0") // case where transaction is accepted for processing
          {
          message = response.data.CustomerMessage;
          ICON = "success";
          console.log(response);
          }
          else // case where transaction is not accepted for processing
          {
          message = response.data.CustomerMessage;
          ICON = "error";
          console.log(response);
          }

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