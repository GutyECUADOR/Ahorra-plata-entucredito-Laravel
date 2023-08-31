<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo Correo de Soporte</title>
</head>
<body>
    <h2>Asunto: {{ $formulario['asunto']}}</h2>
    <p>Email: {{ $formulario['email']}}</p>
    <p>Teléfono: {{ $formulario['telefono']}}</p>
    <p>Comentario/Problema: {{ $formulario['comentario']}}</p>
</body>
</html>