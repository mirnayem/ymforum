<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

    </head>
    <body>
         <div id="app">
            <v-app>
               <app-home></app-home>
            </v-app>
        
         </div>
         <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
         <script src="{{asset('js/app.js')}}"></script>
        
    </body>
</html>
