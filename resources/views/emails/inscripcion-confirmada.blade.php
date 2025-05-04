<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Inscripción</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 20px auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <!-- Cabecera -->
        @include('emails.header')

        <!-- Contenido -->
        <p>Estimado {{ $inscripcion['prof_resp'] }},</p>
        <p>Se ha confirmado la inscripción del grupo con la siguiente información:</p>
        <ul>
            <li><strong>Nombre del grupo:</strong> {{ $inscripcion['grupo'] }}</li>
            <li><strong>Centro:</strong> {{ App\Models\Centro::find($inscripcion['centro'])->dencen }}</li>
            <li><strong>Ciclo:</strong> {{ App\Models\Ciclo::find($inscripcion['ciclo'])->nombre }}</li>
            <li><strong>Categoría:</strong> {{ App\Models\Categoria::find($inscripcion['categoria'])->nombre }}</li>
            <li>Integrantes del grupo:
                <ul>
                    @foreach ($inscripcion['nombre'] as $key => $nombre)
                        @if (!empty($nombre))
                            <li>{{ $nombre }} {{ $inscripcion['apellido'][$key] }}</li>
                        @endif
                    @endforeach
                </ul>
            </li>
        </ul>
        <p>Si desea realizar alguna modificación en la inscripción, puede acceder a
            <a href="https://olimpiadas.cifpcarlos3.es/dashboard">Olimpiadas Informáticas</a>,
            con su cuenta de correo electrónico y la contraseña
            @if (@isset($password))
                <strong>{{ $password }}</strong>
            @else
                que recibió en el primer correo de inscripción.
            @endif
            </p>
        <p>Gracias por participar en las Olimpiadas Informáticas.</p>

        <!-- Pie de página -->
        @include('emails.footer')
    </div>
</body>
</html>
