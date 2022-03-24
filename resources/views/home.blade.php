<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pinterest</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <script type="text/javascript">
        (function() {
            var css = document.createElement('link');
            css.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
            css.rel = 'stylesheet';
            css.type = 'text/css';
            document.getElementsByTagName('head')[0].appendChild(css);
        })();
    </script>
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/app1.css')}}">
    

</head>

<body>
    <div id="app">
        <home-page></home-page>
    </div>

    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
    <script src="{{asset('js/style.js')}}"></script>
    <script src="{{asset('js/theme.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

</body>

</html>