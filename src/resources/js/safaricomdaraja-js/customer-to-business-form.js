
alert("changes1");
$('#customer-to-business-form').on('submit',function(e){
    alert("submitted");
    e.preventDefault();

    let Amount = $('#Amount').val();
    let Phone = $('#Phone').val();
    let Phone = $('#Account').val();
    
    $.ajax({
      url: "/customer-to-business",
      type:"POST",
      data:{
        '_token': $('meta[name="csrf-token"]').attr('content'),
        Amount:Amount,
        Phone:Phone,
        Account:Account,
      },
      success: function(response){
          var message = "";
          var ICON = "";
          response = (JSON.parse(response));

         if(response.ResponseCode == "0")
         {
          console.log(response);
          message = response.CustomerMessage;
          ICON = "success";
         }
         else 
         {// case where transaction is not accepted for processing
    
         console.log(response);
          message = response.errorMessage;
          ICON = "error";
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