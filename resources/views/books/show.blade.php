<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>show</title>
    </head>
    <body>
        <ul>
            <li>ISBN10: {{$book->isbn10}}</li>
            <li>ISBN13: {{$book->isbn13}}</li>
            <li>Name: {{$book->name}}</li>
            <li>Author: {{$book->author}}</li>
            <li>Description: {{$book->description}}</li>
        </ul>
    </body>
</html>
