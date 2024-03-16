# Information encoder algorithm (PHP example)


El código proporcionado es un ejemplo de una clase Encrypter que utiliza el algoritmo AES-256 en modo CBC (Cipher Block Chaining) para encriptar y desencriptar información. Aquí está una explicación técnica de cómo funciona el código:

**Definición de Constantes:**

- METHOD: Define el algoritmo de cifrado utilizado, en este caso, AES-256-CBC.
- KEY: La clave de encriptación utilizada para generar la clave de cifrado. Se recomienda que la clave sea una cadena de longitud fija generada aleatoriamente.
- IV: El vector de inicialización utilizado para iniciar el proceso de cifrado. También se recomienda que sea una cadena de longitud fija generada aleatoriamente.

**Función encrypt($string):**

- Esta función toma una cadena de texto como entrada y la encripta utilizando el algoritmo AES-256 en modo CBC.
- Convierte la clave de encriptación (KEY) en una clave válida para el algoritmo utilizando la función hash SHA-256.
- Genera un vector de inicialización (IV) válido para el algoritmo y de la longitud adecuada.
- Utiliza la función openssl_encrypt para cifrar la cadena de texto con la clave y el vector de inicialización generados.
- Devuelve la cadena encriptada en formato base64.

**Función decrypt($string):**

- Esta función toma una cadena encriptada en formato base64 como entrada y la desencripta utilizando el algoritmo AES-256 en modo CBC.
- Al igual que la función de encriptación, convierte la clave de encriptación (KEY) en una clave válida para el algoritmo utilizando la función hash SHA-256.
- Decodifica la cadena encriptada en formato base64 para obtener los datos encriptados.
- Utiliza la función openssl_decrypt para desencriptar los datos utilizando la clave y el vector de inicialización generados.
- Devuelve la cadena desencriptada.
  
En resumen, este código proporciona una manera segura de encriptar y desencriptar información utilizando el algoritmo AES-256 en modo CBC, lo que garantiza un alto nivel de seguridad y confidencialidad de los datos. 
En la carpeta *Example* encontrarás una actividad demostrativa

Integre el **encrypter.php** en su proyecto y accesa a sus dos funciones:
```
  Encrypter::encrypt($string)
```
y
```
  Encrypter::decrypt($string)
```

Lo demás queda a su imaginación.





