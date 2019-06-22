# Zero API

### Informacion
API creada en PHP 7, para consumir informacion de Zero (PF-Instituto-M3A-F1).
Con esta API unicamente consultamos informacion.

### Avances
1. Consultas de Carreras. 
2. Consultas de Periodos. 
3. Consultas de Cursos. 
4. Consultas de Persona(Solo foto).
5. Consulta de Alumnos. 
6. Consulta de Silabos.

### Como usarla
Iniciar el servidor en Xamp 
Escribir en el navegador **locahost/zero_api/** nos debe aparecer un mensaje indicandonos que no tenemos un url. 

### URL en funcionamiento
**Carreras**
1. /carrera/todos/
2. /carrera/buscar/{aguja}
3. /carrera/buscar/{id_carrera}

**Periodos**
1. /periodo/todos/
2. /periodo/buscar/{aguja}
3. /periodo/buscar/{id_periodo}
4. /periodo/carrera/{id_carrera}

**Cursos**
1. /curso/todos/
1. /curso/buscar/{aguja}
1. /curso/buscar/{id_curso}
2. /curso/periodo/{id_periodo}
3. /curso/docente/{aguja}
4. /curso/alumno/{aguja}

**Persona**
1. /persona/foto/{identificacion}
2. /persona/verfoto/{identificacion}

**Alumnos**
1. /alumno/todos/
2. /alumno/curso/{id_curso}
3. /alumno/buscar/{id_alumno}
4. /alumno/buscar/{aguja}

**Silabos**
1. /silabo/todos/
2. /silabo/buscar/{id_silabo}
3. /silabo/buscar/{aguja}
4. /silabo/periodo/{id_periodo}
5. /silabo/materia/{id_materia}
6. /silabo/docente/{identificacion}
7. /silabo/curso/{id_curso}
8. /silabo/pdf/{id_silabo}
9. /silabo/verpdf/{id_silabo}

### Como agregar mas funcionalidad
- **General**
  - Todos los nombres de archivos escribirlos en minuscula.
  - Todos los modelos deben extender de ConDB. 
  - Todas las Api deben extender de API. 
- **Modelo**
  - En la carpeta models, crear dos archivos. modelo.php modeloapi.php.
  - Estos dos archivos deben tener esta sintaxis. 
  - En el constructor de cada modeloapi.php iniciar el modelo correspondiente.