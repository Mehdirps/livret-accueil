<!DOCTYPE html>
<html>
<head>
    <title>Export des inventaires</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Export des états des lieux</h1>
<table>
    <thead>
    <tr>
        <th>Nom du client</th>
        <th>Date d'arrivée</th>
        <th>Date de départ</th>
        <th>Commentaire du client</th>
        <th>Status</th>
        <th>Pièces jointes</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['client_name'] }}</td>
            <td>{{ $item['start_date'] }}</td>
            <td>{{ $item['end_date'] }}</td>
            <td>{{ $item['client_comment'] }}</td>
            <td>
                @if($item['status'] == 'completed')
                    Terminé
                @else
                    En cours
                @endif
            </td>
            <td>
                @if(isset($item['attachments']))
                    @foreach($item['attachments'] as $attachment)
                        <a href="{{ $attachment }}" target="_blank">{{ $attachment }}</a>
                    @endforeach
                @else
                    Aucune pièce jointe
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
