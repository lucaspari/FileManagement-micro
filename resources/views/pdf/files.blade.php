<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files PDF</title>
</head>
<body>
<h2>Files List</h2>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Format</th>
        <th>Size</th>
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
    @foreach($files as $file)
        <tr>
            <td>{{ $file->name }}</td>
            <td>{{$file->format}}</td>
            <td>{{ $file->size }}</td>
            <td>{{ $file->details }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
