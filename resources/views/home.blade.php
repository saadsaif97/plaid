<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home</title>
   </head>
   <style>
      .transaction:not(:last-of-type) {
         border-bottom: 1px solid #e9e9e9;
      }

   </style>

   <body>
      Home

      <button id="link-button">Link Account</button>

      <div id="accounts"></div>

      <div id="transactions" style="padding: 20px;">

      </div>

      <script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
      <script src="{{ asset('js/app.js') }}"></script>
   </body>

</html>
