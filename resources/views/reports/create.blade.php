<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Создание</h1>
    <form action="{{route ('reports.store')}}" method="POST">
        @csrf
        <input type="text" name="number" placeholder="Номер машины">
        <textarea name="description" placeholder="Описание" ></textarea>   
      
        <br> 
        <input type="submit" value="Создать">         
    </form>
</body>
</html>