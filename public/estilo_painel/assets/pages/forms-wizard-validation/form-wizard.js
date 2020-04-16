  'use strict';
  $(document).ready(function() {

      // $('#date,#datejoin').bootstrapMaterialDatePicker({
      //        time: false,
      //        clearButton: true
      //    });
      //  $("#example-date-inputS").bootstrapMaterialDatePicker({
      //                time: false,
      //                clearButton: true
      //            });
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        
      $("#basic-forms").steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slideLeft",
          autoFocus: true
      });
      $("#verticle-wizard").steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slide",
          stepsOrientation: "vertical",
          autoFocus: true
      });

      $("#design-wizard").steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slideLeft",
          autoFocus: true
      });




      var form = $("#example-advanced-form").show();

      form.steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slide",
          stepsOrientation: "vertical",
          autoFocus: true,
          onStepChanging: function(event, currentIndex, newIndex) {

              // Allways allow previous action even if the current form is not valid!
              if (currentIndex > newIndex) {
                  return true;
              }
              // Forbid next action on "Warning" step if the user is to young
              if (newIndex === 3 && Number($("#age-2").val()) < 18) {
                  return false;
              }
              // Needed in some cases if the user went back (clean up)
              if (currentIndex < newIndex) {
                  // To remove error styles
                  form.find(".body:eq(" + newIndex + ") label.error").remove();
                  form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
              }
              form.validate().settings.ignore = ":disabled,:hidden";
              return form.valid();
          },
          onStepChanged: function(event, currentIndex, priorIndex) {

              // Used to skip the "Warning" step if the user is old enough.
              if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
                  form.steps("Próximo");
              }
              // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
              if (currentIndex === 2 && priorIndex === 3) {
                  form.steps("Anterior");
              }
          },
          onFinishing: function(event, currentIndex) {

              form.validate().settings.ignore = ":disabled";
              return form.valid();
          },
          onFinished: function(event, currentIndex) {
              
              $('.content input[type="text"]').val('');
              $('.content input[type="email"]').val('');
              $('.content input[type="password"]').val('');
          }
      }).validate({
          errorPlacement: function errorPlacement(error, element) {

              element.before(error);
          },
          rules: {
              confirm: {
                  equalTo: "#password-2"
              }
          }
      });
      
      var formDizimista = $("#form-dizimista").show();

      formDizimista.steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slideLeft",
          enableKeyNavigation: true,
          enablePagination: true,
    
          onStepChanging: function(event, currentIndex, newIndex) {

              // Allways allow previous action even if the current formDizimista is not valid!
              if (currentIndex > newIndex) {
                  return true;
              }
              // Forbid next action on "Warning" step if the user is to young
              if (newIndex === 3 && Number($("#age-2").val()) < 18) {
                  return false;
              }
              // Needed in some cases if the user went back (clean up)
              if (currentIndex < newIndex) {
                  // To remove error styles
                  formDizimista.find(".body:eq(" + newIndex + ") label.error").remove();
                  formDizimista.find(".body:eq(" + newIndex + ") .error").removeClass("error");
              }
              formDizimista.validate().settings.ignore = ":disabled,:hidden";
              return formDizimista.valid();
          },
          onStepChanged: function(event, currentIndex, priorIndex) {

              // Used to skip the "Warning" step if the user is old enough.
              if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
                  formDizimista.steps("Próximo");
              }
              // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
              if (currentIndex === 2 && priorIndex === 3) {
                  formDizimista.steps("Anterior");
              }
          },
          onFinishing: function(event, currentIndex) {
             /* nome_validate = $(this).data("nome_validate");
              $.ajax({
                  url:nome_validate,
                  type:"POST",
                  dataType:"JSON",
                  cache:false,
                  beforeSend:function(){
                      
                  },
                  success:function(){
                      
                  }
              });*/
              formDizimista.validate().settings.ignore = ":disabled";   
              return formDizimista.valid();
          },
          onFinished: function(event, currentIndex) {
            
               var form_data = $(this).serialize();
                    var form_url = $(this).attr("action");
                    var form_method = $(this).attr("method").toUpperCase();

    
                    
                    $.ajax({
                        url: form_url, 
                        type: form_method,      
                        data: form_data, 
                        dataType:'JSON',
                        cache: false,
                        beforeSend:function(){
                           
                        },
                        success: function(data){                          
                            
                        if(data){
                            swal("Parabens!", "Agora "+data.nome+" é um dizimista!", "success");
                        }

                        }           
                    }); 
              //$('.content input[type="text"]').val('');
              //$('.content input[type="email"]').val('');
             // $('.content input[type="password"]').val('');
          }
      }).validate({
          errorPlacement: function errorPlacement(error, element) {

              element.before(error);
          },
          rules: {
              
              d_nasc:{
                required:true,
                date:true
              },
              confirm: {
                  equalTo: "#password-2"
              },
              cep:{
                  required:true
              },
              num_casa:{
                  required:true
              },
              rua:{
                  required:true
              },
              bairro:{
                  required:true
              },
              cidade:{
                  required:true
              },
              estado:{
                  required:true
              }
          }
      });
  });
