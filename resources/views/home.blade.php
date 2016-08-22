<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">You are authenticated</div>
                <h2>Name : {{$user->name}}</h2>
                <h3>Email : {{$user->email}}</h3>
                <h3>Organization : {{$user->organization}}</h3>
                <h3>Address : {{$user->address}}</h3>
                <h3>Lastname : {{$user->lastname}}</h3>
                <h3>IM : {{$user->im}}</h3>
                <h3>URL : {{$user->url}}</h3>
                <h3>Country : {{$user->country}}</h3>
                <h3>Mobile : {{$user->mobile}}</h3>
                <h3>Mobile : {{$user->mobile}}</h3>
                <h3><a href="/logout">Logout</a></h3>
            </div>
        </div>
    </body>
</html>
