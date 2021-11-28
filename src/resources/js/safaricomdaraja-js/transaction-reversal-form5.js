
$('#transaction-reversal-form').on('submit',function(e){
    e.preventDefault();

    let Amount = $('#Amount').val();
    let transactionid = $("#transactionid").val();
    let transaction_type = $("#transaction_type").val();
    let transaction_id = $("#transaction_id").val();

    
    $.ajax({
      url: "/transaction-reversal",
      type:"POST",
      data:{
        '_token': $('meta[name="csrf-token"]').attr('content'),
        Amount:Amount,
        transactionid: transactionid,
        transaction_id: transaction_id, 
        transaction_type: transaction_type 
      },
      success: function(response){
          console.log(response);
          response = (JSON.parse(response));

         if(response.ResponseCode == "0")
         {
          notificationAlert("Transaction Request Status",response.ResultDescription, "success");
          setTimeout(() => {
            transactionResultNotification();
          }, 7000);
         }
         else 
         {// case where transaction is not accepted for processing
          console.log(response);
          notificationAlert("Transaction Request Status",response.errorMessage, "error");
         }

      },
      error: function(response) {
          console.log(response)
      },
      });
    });


    function transactionResultNotification()
    {
      $.ajax({
        url: "/transaction/result/notification",
        type:"GET",
        success: function(response){

          //response = (JSON.parse(response));
          console.log(response[0].data);

           if(response[0].data.ResultCode == 21)
           {
            console.log(response[0].data.ResultDesc);
           // alert(response[0].data.ResultDesc, "success");
            notificationAlert("Transaction Process Status",response[0].data.ResultDesc, "success");
            //$('#transaction-success-message').text(response[0].data.ResultDesc);
            //$('#transaction-success').toast("show")
            readNotification(response[0].id);
            $("#reverse-state").html('<p class="text-success">Reversed</p>')
           }
           else 
           {// case where transaction is not processed successfully
      
           console.log(response);
            notificationAlert("Transaction Process Status",response[0].data.ResultDesc, "error");
            //$('#transaction-error-message').text(response[0].data.ResultDesc);
            //$('#transaction-error').toast("show")
            readNotification(response[0].id);
           }

        },
        error: function(response) {
            console.log(response);
        },
        });
    }

    function notificationAlert(title,message, ICON)
    {
      swal({
        title: title,
        text: message, //response.data.CustomerMessage,
        icon: ICON,
        button: "ok",
      });
    }

    function readNotification(ID)
    {


        $.ajax({
          url: "transaction/result/notification/read",
          type:"POST",
          data : {
            "_token": "{{ csrf_token() }}",
            id: ID
          },
          success: function(response){

          },
          error: function(response) {
            
          },
          });
    }