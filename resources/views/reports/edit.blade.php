<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <h1>Редактирование</h1>
    <form action="{{route('reports.update', $report->id)}}" method="POST">
        @csrf
        @method('put')
        <input type="text" name="number" value="{{$report->number}}">
        <textarea name="description">{{$report->description}}</textarea>   
        <br> 
        <input type="submit" value="Редактировать">     
    </form>
</body>
</html>