
$('#mpesa-express-form').on('submit',function(e){
    e.preventDefault();
    $('#pleaseWaitDialog').modal();
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
          response = (JSON.parse(response));

         if(response.ResponseCode == "0")
         {
          console.log(response);
          $('#pleaseWaitDialog').modal('hide');
          notificationAlert("Transaction Request Status",response.CustomerMessage, "success");
          $('#pleaseWaitDialog').modal();
          setTimeout(() => {
            $('#pleaseWaitDialog').modal('hide');
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
            paymentSuccess("success");
           }
           else 
           {// case where transaction is not processed successfully
      
           console.log(response);
            notificationAlert("Transaction Process Status",response[0].data.ResultDesc, "error");
            //$('#transaction-error-message').text(response[0].data.ResultDesc);
            //$('#transaction-error').toast("show")
            readNotification(response[0].id);
            paymentSuccess("failed");
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

    //--  This is specific for Current project should be removed from package after installing

    function paymentSuccess(status)
    {

      let = currency_id =  4;//$('#currency_id').val();
      let = payment_method =  $('#method').val();

      $.ajax({
        url: "/deposit/mpesa-payment",
        type:"POST",
        data : {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          status: status,
          currency_id: currency_id,
          payment_method: payment_method

        },
        success: function(response){
          Window.location.assign(window.location.hostname + "/deposit/mpesa-payment/success");
        },
        error: function(response) {
          
        },
        });
    }