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

    <script>
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
    </script>
</html>    