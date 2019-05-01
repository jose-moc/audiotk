<?php
/* 	Encriptación de contraseñas
 *	// Crear la contraseña:
 * 	$hash = Password::hash('micontraseña');
 * 	// Comprobar la contraseña introducida
 *	if (Password::verify('micontraseña', $hash)) {
 *		echo 'Contraseña correcta!\n';
 * 	} else {
 *		echo "Contraseña incorrecta!\n";
 * 	}
 */
class Password {
    const SALT = 'fd56FDG';

    public static function hash($password) {
        return hash('sha512', self::SALT . $password);
    }
    public static function verify($password, $hash) {
        return ($hash == self::hash($password));
    }
}
