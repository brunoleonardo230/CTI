<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="pt-BR" ng-app="myApp" >
 
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>5TI - {{ $title }}</title>
 
  {{ HTML::style('public/assets/foundation/css/normalize.css') }}
  {{ HTML::style('public/assets/foundation/css/foundation.css') }}
  {{ HTML::style('public/assets/foundation/css/jquery-ui.css') }}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="{{ URL::asset('public/assets/js/jquery/jquery-1.10.2.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/jquery/jquery-ui.js') }}"></script>
  <script src="{{ URL::asset('public/assets/foundation/js/vendor/modernizr.js') }}"></script>
  <script src="{{ URL::asset('public/assets/foundation/js/vendor/jquery.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/funcoes.js') }}"></script>
  <link rel="stylesheet" href="public/assets/foundation/css/app.css">

  
</head>
<body>
  
	<div class="bgimg hide-for-small-only"></div>
        @include('layouts.barra-superior_SANTI')
     
  <div class="row">
    	<div class="principal large-12 columns">
            @yield('content')
      </div>
  </div>



  <div class="footer">
    <div class="row">        
          <div class="large-12 columns">
          <p>Defensoria Pública do Estado do Maranhão - DPE MA<br>
            Rua da Estrela, 421, Praia Grande, Centro, São Luís - MA, CEP: 65010-200<br>
            Fone: 3221-6110 / 3231-0958</p>
          </div>
      </div>
  </div>
   <script>
    $(document).foundation();

  </script>
</body>
</html>    
  <script src="{{ URL::asset('public/assets/foundation/js/vendor/jquery.js') }}"></script>
  <script src="{{ URL::asset('public/assets/foundation/js/foundation.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/foundation/js/foundation/foundation.js') }}"></script>
  <script src="{{ URL::asset('public/assets/foundation/js/foundation/foundation.tab.js') }}"></script>
  <script src="{{ URL::asset('public/assets/foundation/js/foundation/foundation.topbar.js') }}"></script>
  <script src="{{ URL::asset('public/assets/foundation/js/foundation/foundation.alert.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/angular.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/jquery/jquery-ui.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/foundation/foundation.reveal.js') }}"></script>
  
  
 
  <script>
  $(document).foundation({
    tab: {
      callback : function (tab) {
        console.log(tab);
      }
    }
  });
</script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
</script>
<script>
  $(function() {
    $( "#datepicker1" ).datepicker();
  });
</script>
<script>
  jQuery(function($){
    $("#campoData").mask("99/99/9999");
    $("#campoHora").mask("99:99:99");
  });
</script>
