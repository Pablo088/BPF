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
                <a href='/Lines/admin/Company/options/edit/linea/{{ $buslines->id }}' class="btn btn-success" id="boton">Editar</a>
                <a href='/Lines/admin/Company/options/eliminar/linea/{{ $buslines->id }}' class="btn btn-danger" id="boton">Eliminar</a>
            </td>
            <td class="table-info">
                
                    {{ $buslines->BusCompany->company_name}}<br>
                
            </td>
            <td class="table-info">
                <a href='/Lines/admin/Company/options/edit/compania/{{ $buslines->id }}' class="btn btn-success" id="boton">Editar</a>
                <a href='/Lines/admin/Company/options/eliminar/compania/{{ $buslines->id }}' class="btn btn-danger" id="boton">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
