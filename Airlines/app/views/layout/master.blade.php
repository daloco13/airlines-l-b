<!DOCTYPE html>
<html>
    <head>
       <title>
       	
       </title>
      
      <!-- Loading Bootstrap -->
      {{ HTML::style('dist/css/vendor/bootstrap.min.css') }}

      <!-- Loading Flat UI -->
      {{ HTML::style('dist/css/flat-ui.css') }}
      {{ HTML::style('docs/assets/css/demo.css') }}

      {{ HTML::style('css/jquery-ui-1.10.4.custom.css') }}
      
      {{ HTML::script('js/bootstrap.js') }}
      {{ HTML::script('js/jquery-1.10.2.js') }}
      {{ HTML::script('js/jquery-ui-1.10.4.custom.js') }}

      

    </head>
    <body> 
       <section name="main">
           <section name="content"> 
               @yield('content')
           </section>
       </section>
    </body>

    <script type="text/javascript">
    
      function disablefield() {
      if(document.getElementById('intTripTypeReturn').checked == true) {
        document.getElementById('intReturn').disabled = false;
      } else {
        document.getElementById('intReturn').disabled = true;
        document.getElementById('intReturn').value = "";
      }

      $errorMessage.addClass('hide');
      $('.has-error').removeClass('has-error');
    }

    

    // datepicker
      $(document).ready(function(){
      $("#intDepart").datepicker({
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 2, 
        minDate: 0,
        onSelect: function(selected) {
          $("#intReturn").datepicker("option", "minDate", selected);
          setTimeout(function(){
            if(document.getElementById('intReturn').disabled == false)
              $("#intReturn").datepicker('show');
          });
        }
      });

      $("#intReturn").datepicker({ 
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 2,
        minDate: 0,
        onSelect: function(selected) {
          $("intDepart").datepicker("option", "maxDate", selected)
        }
      });
    });

      // display on the trip summary upon clicking the radio button
      function writeResultDepart(value) {
            var data = value.split(';');
            $("#oFlight").html(data[0]);
            $("#oDepart").html(data[1] );
            $("#oDeparture").html(data[2]);
            $("#oArrive").html(data[3]);
            $("#oArrival").html(data[4]);
            //$("#oFare").html(data[5]);

            var adult = ( {{ Session::get('adult') }} * data[5]).toFixed(0);
            var child = (( ( {{ Session::get('children') }} * data[5] - {{ Session::get('children') }} * data[5] * 0.15)  )).toFixed(0);

            $("#adultDep").html(adult);
            $("#childDep").html(child);
            var total = parseInt($("#adultDep").html()) + parseInt($("#childDep").html())<?php if(Session::get('tripType') != 'oneway') echo ' + parseInt($("#adultRet").html()) + parseInt($("#childRet").html())'; ?>;
            $("#total").html(total);
                     
        }

      // display on the trip summary upon clicking the radio button
      function writeResultReturn(value) {
          var data = value.split(';');
            $("#dFlight").html(data[0]);
            $("#dDepart").html(data[1] );
            $("#dDeparture").html(data[2]);
            $("#dArrive").html(data[3]);
            $("#dArrival").html(data[4]);
            //$("#oFare").html(data[5]);

            var adult = ( {{ Session::get('adult') }} * data[5]).toFixed(0);
            var child = (( ( {{ Session::get('children') }} * data[5] - {{ Session::get('children') }} * data[5] * 0.15)  )).toFixed(0);

            $("#adultRet").html(adult);
            $("#childRet").html(child);
            var total = parseInt($("#adultDep").html()) + parseInt($("#childDep").html()) + parseInt($("#adultRet").html()) + parseInt($("#childRet").html());
            $("#total").html(total);
      }

        $(document).ready(function(){
        $(".intBday").datepicker({
          dateFormat: 'yy-mm-dd',
          changeYear: true,
          changeMonth: true,
          showMonthAfterYear: true,
          maxDate: 0
        });
      });

      

    </script>
</html>    