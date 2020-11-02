# Prueba laravel 
Pequeño proyecto para la construcción de una API RESTful.

El proyecto cuenta con todos los requerimientos que fueron solicitados para la prueba.

## Observaciones 

- Se modificó la longitud de los atributos que contienen URL para unificar el tamaño de estos
con la respuesta a una duda que se envío. En la duda se recomienda utilizar el tamaño de 450
caracteres para guardar una URL y en el diagrama de base de datos se indica una longitud de 255.

- Para crear contactos, empresas o documentos por el tipo de relación marcada como fuerte
con corporativos se permite su creación en una ruta en la que se indica el ID del corporativo
que tiene dicho recurso. Ejemplo: contactos/corporativos/{id}

- No se incluyen rutas para los métodos index y show de la tabla pivote que fue asociada a un modelo con
el nombre documentoArchivo puesto que esa información no es relevante si no está asociada a su
documento padre. Por la naturaleza de la relación propuesta en el diagrama entidad-relación se permite la 
asociación con otro corporativo en la ruta, o la carga de url de archivo a una misma relación, según
se necesite. Se permite la actualización para cambiar el url de archivo. Se permite eliminar registros 
salvo que exista únicamente 1 registro asociado a un documento y corporativo en esa tabla puesto 
que si se deja eliminar todos se rompe la relación indicada como fuerte.

## Extras

Se pretendía realizar una rama en el repositorio con las siguientes mejoras que no se indican como 
requerimientos del pequeño proyecto, pero que creo pueden mejorar la calidad del mismo. No se añadieron
al día del lunes pues creí que terminaría antes la prueba y también debía atender los deberes de la 
escuela.

- Añadir seeders a las demás tablas
- Mejorar el uso de la API respecto a los atributos de los recursos
- Mapear los atributos en las respuestas y solicitudes para facilitar el uso al cliente,
ejemplo: del modelo Contacto de "S_Nombre" a "nombre" 
- Paginar las respuestas desde la consulta a la base de datos principalmente en los métodos index
- Añadir HATEOAS a todos los recursos
- Añadir la opción de búsqueda y/u orden a las solicitudes. Ejemplo: {ruta}/?S_Nombre=Pedro

Para añadir HATEOAS de mejor forma se tendrían que separar los detalles de los métodos
show de los controladores para los modelos documento y corporativo.

Para mapear los atributos a unos más legibles para el cliente se crearían resource para todas
las respuestas y formrequest para todas las solicitudes, esto último además separaría la lógica
de validación.