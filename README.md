# JuanPerona-Proun-Symfony

1-Despliegue:
La aplicación corre bajo el servidor que ofrece symfony (o un servidor local apache o nginx tipo xampp) y una base de datos mysql.<br>
Los endpoints funcionan bajo el host que ofrece el servidor de symfony, http://127.0.0.1:8000<br>
La base de datos está incluida en la raíz = proun.sql (se debe importar al mysql local)<br>
La configuración de la API con MYSQL es la siguiente: DATABASE_URL="mysql://root@127.0.0.1:3306/proun?serverVersion=10.4.27-MariaDB&charset=utf8mb4" (incluir la versión correcta del servidor mysql)<br>
EL proyecto se debe copiar o clonar a la carpeta htdocs de nuestro localhost.<br>

2-Acceso:<br>
Acceso al panel de administración de sonata: http://127.0.0.1:8000/admin/dashboard<br>

3-Conexión con los ENDPOINTS de la API mediante POSTMAN:<br>

LOGIN: http://127.0.0.1:8000/api/login_check<br>
    method: post<br>
    body: raw (json)<br>
    {
        "username":"juan@gmail.com",
        "password": "123456"
    }

Obtenemos el token JWT para realizar la autenticación con el resto de métodos mediante la opción: 
Authorization > Bearer Token > Token (rellenar el campo con el token obtenido al hacer login)

LISTAR ENVÍOS: http://127.0.0.1:8000/api/envio/list
    method: get
    Authorization > Bearer Token > Token

CREAR ENVÍOS: http://127.0.0.1:8000/api/envio/create
    method: post
    Authorization > Bearer Token > Token
    body: raw (json)
    {
        "recogida": {
            "nombre":"Daimiel",
            "latitud": "40.37032828636249",
            "longitud": "-3.6843720154096196"       
        },
        "destino": {
            "nombre": "Ciudad Real",
            "latitud": "40.37032828636249",
            "longitud": "-3.6843720154096196"        
        },
        "vehiculo": "coche"
    }

EDITAR ENVÍO: http://127.0.0.1:8000/api/envio/edit
    method: put
    Authorization > Bearer Token > Token
    {
    "uuid": "6428e786-419b-4304-8f9a-2ad80b493243",
                "destino": {
                    "nombre": "Puertollano",
                    "latitud": "40.37032828636249",
                    "longitud": "-3.6843720154096196"
                }
    }                
