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
      

    </head>
    <body> 
       <section name="main">
           <section name="content"> 
               @yield('content')
           </section>
       </section>
    </body>
</html>    