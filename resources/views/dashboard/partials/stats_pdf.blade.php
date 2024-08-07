<!DOCTYPE html>
<html>
<head>
    <title>Export des statistiques de vues</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Export des statistiques de vues du livret</h1>
<table>
    <thead>
    <tr>
        <th>Total des vues</th>
        <th>Vues du jour</th>
        <th>Vues de la semaine</th>
        <th>Vues du mois</th>
        <th>Vues entre deux dates</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $data['totalViews'] }}</td>
        <td>{{ $data['viewsToday'] }}</td>
        <td>{{ $data['viewsThisWeek'] }}</td>
        <td>{{ $data['viewsThisMonth'] }}</td>
        <td>
            @if(isset($data['viewsBetweenDates']))
                {{ $data['startDate'] }} au {{ $data['endDate'] }} : {{ $data['viewsBetweenDates'] }}
            @else
                Aucune donnée
            @endif
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
