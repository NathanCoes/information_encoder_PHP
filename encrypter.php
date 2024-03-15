<?php

    //Include the encrypter.php where necessary.
    //Call your functions as follows:

    //The objective of the KEY is to maintain a dynamic key for all users.

    //To encrypt information: Encrypter::encrypt($string);
    //To decrypt information: Encrypter::decrypt($string);

    define('METHOD' , 'AES-256-CBC');

    class Encrypter {
    
        // Encryption keys, modify it with strings of the same length but generated at random.
        const KEY = 'XrU<{W~},@7Jb>y';
        const IV = 'ULD@Js!M9WEu8=GULD@Js!M9WE';
        
        /**
         * Encrypts a string using AES-256 in CBC mode
         * @param string $string The string to encrypt
         * @return string The encrypted string in base64 format
         */
        public static function encrypt($string) {
            $key = hash('sha256', self::KEY, true);
            $iv = substr(self::IV, 0, openssl_cipher_iv_length(METHOD));
            $encrypted = openssl_encrypt($string, METHOD, $key, OPENSSL_RAW_DATA, $iv);
            return base64_encode($encrypted);
        }
        
        /**
         * Decrypt a previously encrypted string with the encrypt() function
         * @param string $string The encrypted string in base64 format
         * @return string|false The original decrypted string or FALSE if it cannot be decrypted
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