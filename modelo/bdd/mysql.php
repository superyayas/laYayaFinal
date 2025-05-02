<?php
class yayaBD {
    private static $conexion = null;

    // Devuelve un mysqli conectado (Singleton)
    public static function conexionBD() {
        if (self::$conexion === null) {
            $config = parse_ini_file(__DIR__ . "/../../config.ini");
            $pass   = $config['contrasena'] ?? '';
            // Activar excepciones en mysqli
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            self::$conexion = new mysqli(
                $config['server'],
                $config['user'],
                $pass,
                $config['bd']
            );
            self::$conexion->set_charset('utf8');
        }
        return self::$conexion;
    }

    // Lectura: ejecuta SELECT con parámetros y devuelve array o null
    public static function consultaLectura(string $sql, mixed ...$params): ?array {
        $db   = self::conexionBD();
        $stmt = $db->prepare($sql);
        if ($params) {
            $types = '';
            foreach ($params as $p) {
                $types .= is_int($p) ? 'i' : 's';
            }
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->num_rows > 0
            ? $res->fetch_all(MYSQLI_ASSOC)
            : null;
    }

    // Inserción/Actualización/Borrado con parámetros
    public static function consultaInsercionBD(string $sql, mixed ...$params): bool {
        $db   = self::conexionBD();
        $stmt = $db->prepare($sql);
        if ($params) {
            $types = '';
            foreach ($params as $p) {
                $types .= is_int($p) ? 'i' : 's';
            }
            $stmt->bind_param($types, ...$params);
        }
        return $stmt->execute();
    }

    public static function cerrarConexion(): void {
        if (self::$conexion !== null) {
            self::$conexion->close();
            self::$conexion = null;
        }
    }
}
