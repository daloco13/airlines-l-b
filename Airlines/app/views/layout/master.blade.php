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

    //  validation
    $(function() {
      $('form.require-validation').bind('submit', function(e) {
        var $form = $(e.target).closest('form');
        if(document.getElementById('intTripTypeReturn').checked == false) {
          inputSelector = ['input[id=intDepart]', 'select'].join(', ');
        } else {
          inputSelector = ['input[type=text]', 'select'].join(', ');
        }
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;       

        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
                e.preventDefault(); // cancel on first error
            }
        });
      });
    });

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

            
        }

      // display on the trip summary upon clicking the radio button
      function writeResultReturn(text) {
          var data = text.split(';');
          $("#dFlight").html(data[1]);
          $("#dDepart").html(data[2] + ', ' + data[3]);
          $("#dDeparture").html(data[4]);
          $("#dArrive").html(data[5] + ', ' + data[6]);
          $("#dArrival").html(data[7]);

          
      }
    </script>
</html>    