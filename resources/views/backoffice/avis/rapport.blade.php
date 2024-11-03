<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des Avis</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Rapport des Avis</h1>
    <p>Période : {{ $startDate }} - {{ $endDate }}</p>

    <table>
        <thead>
            <tr>
                <th>Nom du Client</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Date de l'Avis</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avis as $avisItem)
                <tr>
                    <td>{{ $avisItem->nomClient }}</td>
                    <td>{{ $avisItem->note }}</td>
                    <td>{{ $avisItem->commentaire }}</td>
                    <td>{{ $avisItem->dateAvis }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
