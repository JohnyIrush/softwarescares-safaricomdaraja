$('#account-balance-form').on('submit',function(e){
    e.preventDefault();
    
    $.ajax({
      url: "/account-balance",
      type:"POST",
      data:{
        '_token': $('meta[name="csrf-token"]').attr('content'),
      },
      success: function(response){
          response = (JSON.parse(response));

         if(response.ConversationID)
         {
          console.log(response);
          notificationAlert("Transaction Request Status",response.ResponseDescription, "success");
          setTimeout(() => {
            transactionResultNotification();
          }, 7000);
         }
         else 
         {// case where transaction is not accepted for processing
  
          console.log(response);
          notificationAlert("Transaction Request Status",response.errorMessage, "error");
         }
        swal({
           title: "Transaction Status",
           text: message, //response.data.CustomerMessage,
           icon: ICON,
           button: "ok",
         });

      },
      error: function(response) {
          console.log(response);
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

           if(response[0].data.ResultCode == 0)
           {
            console.log(response[0].data.ResultDesc);
           // alert(response[0].data.ResultDesc, "success");
            notificationAlert("Transaction Process Status",response[0].data.ResultDesc, "success");
            //$('#transaction-success-message').text(response[0].data.ResultDesc);
            //$('#transaction-success').toast("show")
            readNotification(response[0].id);
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
            '_token': $('meta[name="csrf-token"]').attr('content'),
            id: ID
          },
          success: function(response){

          },
          error: function(response) {
            
          },
          });
    }