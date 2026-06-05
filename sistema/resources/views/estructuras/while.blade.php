<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>While</title>
</head>
<body>
    

    <p>
       {{$numero}}
    </p>
    @while($numero > 0)

        <p>{{$numero=$numero-1}}</p>
        @endwhile
    </p>
</body>
</html>