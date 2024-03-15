<?php

    //Incluir el encrypter.php en donde sea necesario.
    //Haga el llamado de sus funciones de la siguiente manera:

    //El objetivo del KEY es mantener una llave dinamica para todos los usuarios.

    //Para incriptar información: Encrypter::encrypt($string);
    //Para desencriptar información: Encrypter::decrypt($string);

    define('METHOD' , 'AES-256-CBC');

    class Encrypter {
    
        // Llaves de encriptación
        const KEY = 'XrU<{W~},@7Jb>y';
        const IV = 'ULD@Js!M9WEu8=GULD@Js!M9WE';
        
        /**
         * Encripta un string utilizando AES-256 en modo CBC
         * @param string $string El string a encriptar
         * @return string El string encriptado en formato base64
         */
        public static function encrypt($string) {
            $key = hash('sha256', self::KEY, true);
            $iv = substr(self::IV, 0, openssl_cipher_iv_length(METHOD));
            $encrypted = openssl_encrypt($string, METHOD, $key, OPENSSL_RAW_DATA, $iv);
            return base64_encode($encrypted);
        }
        
        /**
         * Desencripta un string previamente encriptado con la función encrypt()
         * @param string $string El string encriptado en formato base64
         * @return string|false El string original desencriptado o FALSE si no se puede desencriptar
         */
        public static function decrypt($string) {
            $key = hash('sha256', self::KEY, true);
            $data = base64_decode($string);
            $iv = substr(self::IV, 0, openssl_cipher_iv_length(METHOD));
            $decrypted = openssl_decrypt($data, METHOD, $key, OPENSSL_RAW_DATA, $iv);
            return $decrypted;
        }
    }
?>