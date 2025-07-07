<?php
// Configuración de conexión
$host = '34.41.107.152';
$dbname = 'PRACTICA';
$username = 'root';
$password = '';

// Establecer conexión
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_EXCEPTION);
    
    // Consulta SQL
    $sql = "SELECT PersonaID, Nombre, Apellido, FechaNacimiento 
            FROM datospersonales 
            WHERE Nombre = 'Luiggi' AND Apellido = 'Ybanez'";
    
    $result = $conn->query($sql);
    $persona = $result->fetch(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $error = "Error de conexión: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Datos de Juan Perez</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #4285F4; text-align: center; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
        }
        th, td { 
            padding: 12px; 
            text-align: center; 
            border: 1px solid #ddd; 
        }
        th { 
            background-color: #4285F4; 
            color: white; 
        }
        tr:nth-child(even) { 
            background-color: #f2f2f2; 
        }
        .error { 
            color: red; 
            padding: 20px; 
            border: 1px solid red; 
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>DATOS PERSONALES DE JUAN LUIGGI YBANEZ</h1>
    
    <?php if(isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php else: ?>
        <table>
            <tr>
                <th>PersonaID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Nacimiento</th>
                <th>Edad</th>
            </tr>
            <?php if($persona): ?>
            <tr>
                <td><?php echo htmlspecialchars($persona['PersonaID']); ?></td>
                <td><?php echo htmlspecialchars($persona['Nombre']); ?></td>
                <td><?php echo htmlspecialchars($persona['Apellido']); ?></td>
                <td><?php echo htmlspecialchars($persona['FechaNacimiento']); ?></td>
                <td>
                    <?php 
                    $birthDate = new DateTime($persona['FechaNacimiento']);
                    $today = new DateTime();
                    echo $today->diff($birthDate)->y . ' años';
                    ?>
                </td>
            </tr>
            <?php else: ?>
            <tr>
                <td colspan="5">No se encontraron datos para Juan Perez</td>
            </tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>
</body>
</html>