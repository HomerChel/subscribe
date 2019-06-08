<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>ITSpecial test task</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" enctype="multipart/form-data">
        @csrf
      <h1 class="h3 mb-3 font-weight-normal">Press button 'Send' to send.</h1>
        <label for="type" class="sr-only">Type</label>
        <select class="form-control" id="type" name="type">
            <option value="active" selected>Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <label for="url" class="sr-only">Url</label>
        <select class="form-control" id="url" name="url">
            <option value="google.com" selected>Google</option>
            <option value="yahoo.com">Yahoo</option>
            <option value="duckduckgo.com">DuckDuckGo</option>
        </select>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
    </form>
  </body>
</html>
