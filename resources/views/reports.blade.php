<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>Tkambio</title>

   <!-- Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

   <!-- Styles -->
   <link rel="stylesheet" href="{{ url('/css/app.css') }}">
   <script>
      window._asset = '{{ asset("") }}';
   </script>
</head>
<body class="antialiased">
   <nav class="nav-title">
      <a href="#" class="brand-logo">
         <img src="{{ asset('images/logo-tkambio.svg') }}" alt="Logo" width="500px">
      </a>
   </nav>
   <div id="app">
      <div class="lg:text mt-6 bold:text center:text">Generador de reportes TK</div>
      <reports-component ref="report" @new="openModal('generarModal')"></reports-component>
      <modal-component ref="generarModal">
         <div class="md:text bold:text center:text">Reporte por fecha de nacimiento</div>
         <div class="sm:text gray:text">Ingresa los siguientes datos para generar tu reporte</div>
         <fieldset class="mt-4">
            <legend>Descripción del reporte</legend>
            <input type="text" v-model="form.description" maxlength="100">
         </fieldset>
         <div>Fecha de nacimiento</div>
         <div class="row">
            <div class="col">
               <fieldset>
                  <legend>Inicio</legend>
                  <input type="date" v-model="form.start_date">
               </fieldset>
            </div>
            <div class="col">
               <fieldset>
                  <legend>Fin</legend>
                  <input type="date" v-model="form.end_date">
               </fieldset>
            </div>
         </div>
         <div class="center:text">
            <button @click="crearReporte" class="btn mt-4" :disabled="!form.description || !form.start_date || !form.end_date">Crear reporte</button>
         </div>
      </modal-component>
   </div>
   <script src="{{asset('js/app.js')}}"></script>
</body>
</html>