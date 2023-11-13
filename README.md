# ApiRestTPE3

-getDiscos : Esta funcion obtiene todos los discos de la base de datos. Los puede obtener de manera ordenada por cualquiera de sus campos. Esta ultima funcionalidad, funciona 
gracias a los parametros 'order' y 'sort' obtenidos por $_GET de la URL. Order recibe un campo de los discos (nombre, autor, genero, o precio), y Sort puede ser solo ASC(ordena
ascendente) o DESC(descendiente). Ejemplo: 'localhost/3raEntrega/api/discos?order=autor&sort=ASC' con el metodo GET, la app obtendria todos los discos de la base de datos ordenados por autor de manera
descendiente.

-getDisco : Esta funcion obtiene un solo disco mediante su ID la cual obtiene como parametro de la URL. en caso de que no se encuentre un disco con esa misma ID devuelve un 404.
 Ejemplo: 'localhost/3raEntrega/api/discos/14' con el metodo GET, la app obtendria solo el disco con ID = 14, en nuestro caso es el disco "JIJIJI" del Indio Solari.

-deleteDisco : Esta funcion borra un disco de la base de datos. Primero obtiene su ID, luego lo busca en la base de datos y si existe lo elimina. Ejemplo:'localhost/3raEntrega/api/discos/1'
 con el metodo DELETE  , esta URL borraria el disco con id = 1 de la base de datos.

-createDisco : Esta funcion crea un disco nuevo en la base de datos. Primero obtiene todos los datos del disco a crear transformando el texto crudo de la request a un objeto JSON
, y luego almacena esos datos en variables para posteriormente insertarlo en la base de datos. Ejemplo: 'localhost/3raEntrega/api/discos' con el metodo POST, inserta un disco en la DB. Los datos de 
este disco son ingresados como texto crudo en POSTMAN y luego son transformados a JSON para poder ser agregados a la DB. Si ingreso como texto: 
  {
    "nombre": "The dark side of the moon",
    "autor": "Pink Floyd",
    "genero": "Rock",
    "precio": 8990.9
  }, 
la funcion agregaria un disco con esos mismos datos a la DB.

-update : Esta funcion modifica los datos de un disco ya existente en la DB, para ello obtiene el ID del disco a modifcar como parametro y obtiene los datos para modificar los
datos del disco de la misma forma que la funcion createDisco. Ejemplo: 'localhost/3raEntrega/api/discos/1' con el metodo PUT, modificaria los datos del disco con ID=1 y los
reemplazaria por la info ingresada como texto crudo en el cuerpo del mensaje de la misma forma que lo ahce la funcion createDisco.
