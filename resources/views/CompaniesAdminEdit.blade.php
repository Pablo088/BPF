<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
     #tabla{
        background-color: rgba(209, 27, 42, 0.719);

     }
    </style>
</head>
<body>


<table class="table table-bordered border-primary">
        <thead>
            <tr class="table-secondary">
            <th>linea</th> 
            <th>Acciones1</th>
            <th>Compañía</th> 
            <th>Acciones2</th>
            </tr>
        </thead>
    <tbody>
    @foreach($busline as $buslines)
        <tr>
            <td class="table-primary">
                {{ $buslines->line_name }}
            </td>
            <td class="table-primary">
                <a href='/Lines/admin/Company/edit/linea/{{ $buslines->id }}' class="btn btn-success" id="boton">Editar</a>
            </td>
            <td class="table-info">
                @foreach($buscompany as $buscompanies)
                    {{ $buscompanies->company_name }}<br>
                @endforeach
            </td>
            <td class="table-info">
                <a href='/Lines/admin/Company/edit/compania/{{ $buslines->id }}' class="btn btn-success" id="boton">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
