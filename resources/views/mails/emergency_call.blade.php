<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Contacto desde Micrositio</title>
</head>
<body>
    <p>Estos son los datos del cliente:</p>
    <ul>
        <li>Nombre: {{ $request->name }}</li>
        <li>Teléfono: {{ $request->phone }}</li>
        <li>Email: {{ $request->email }}</li>
        <li>Tipo de Seguro: {{ $request->type }}</li>
        <li>Mensaje: {{ $request->message }}</li>
    </ul>
</body>
</html>