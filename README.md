## Documento de Despliegue de la Aplicación

### Pre-requisitos:
- Instalar XAMPP para utilizar MySQL.
- Instalar Node.js y npm para ejecutar comandos npm.
- Instalar PHP y Composer para poder usar `php artisan`.
- Tener acceso a un terminal o línea de comandos.

### Configuración de la Base de Datos:
- Inicia el servidor MySQL desde XAMPP.
- Accede al gestor de base de datos MySQL y crea una base de datos vacía llamada `cypher2`.
- Importa el archivo `cypher2.sql` a la base de datos recién creada para estructurar las tablas y datos iniciales.

### Configuración del entorno de la aplicación:
- Clona o descarga el código fuente de la aplicación al directorio `cypher2`.
- Navega al directorio `cypher2` desde la línea de comandos.
- Abre el archivo `.env` y asegúrate de que las configuraciones de conexión a la base de datos están correctas (usualmente `DB_CONNECTION=mysql`, `DB_DATABASE=cyopher2`, etc.).

### Instalación de dependencias:
- En el directorio `cypher2`, abre dos terminales.
- En un terminal, ejecuta `npm install` para instalar las dependencias JavaScript necesarias.
- En el otro terminal, ejecuta `composer install` para instalar las dependencias de PHP requeridas.

### Ejecución de la aplicación:
- En el primer terminal donde ejecutaste `npm install`, inicia el frontend con `npm run dev`.
- En el segundo terminal, inicia el backend de la aplicación con `php artisan serve`.

### Acceso a la Aplicación:
- Utiliza los archivos `Cypher.htm` para acceder a la aplicación normal y `CypherAdmin.html` para acceder al panel de administración.
- Se recomienda abrir cada archivo en navegadores diferentes para evitar conflictos de sesión.
- Las credenciales de acceso para la aplicación normal son correo: guilleibannez@gmail.com y contraseña: 12341234.
- Para la administración usa correo: g@g.com y contraseña: 12341234.

### Notas adicionales:
- Si es necesario crear usuarios adicionales, se puede hacer a través del panel de administración o configurando adecuadamente los scripts de la base de datos.
- Asegúrate de probar ambos accesos para confirmar que la configuración del entorno está funcionando correctamente.
