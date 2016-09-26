<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>index</title>
    </head>
    <body>
        <table>
            <tr>
                <th>
                    ISBN 10
                </th>
                <th>
                    ISBN 13
                </th>
                <th>
                    Name
                </th>
                <th>
                    Author
                </th>
                <th>
                    Description
                </th>
            </tr>
            @foreach($books as $book)
                <tr>
                    <td>
                        {{$book->isbn10}}
                    </td>
                    <td>
                        {{$book->isbn13}}
                    </td>
                    <td>
                        {{$book->name}}
                    </td>
                    <td>
                        {{$book->author}}
                    </td>
                    <td>
                        {{$book->description}}
                    </td>
                </tr>
            @endforeach
        </table>

    </body>
</html>
