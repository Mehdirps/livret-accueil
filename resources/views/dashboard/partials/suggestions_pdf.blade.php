<!DOCTYPE html>
<html>
<head>
    <title>Export des suggestions</title>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #4CAF50;
            color: white;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
        }
    </style>
</head>
<body>
<h1>Export des suggestions</h1>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Titre</th>
        <th>Message</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['email'] }}</td>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['message'] }}</td>
            <td>{{ $item['status'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
