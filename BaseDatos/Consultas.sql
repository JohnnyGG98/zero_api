--Consultamos los cursos

SELECT
pl.id_prd_lectivo,
prd_lectivo_nombre,
persona_primer_nombre,
persona_primer_apellido,
c.id_curso,
curso_nombre,
curso_ciclo,
curso_capacidad,
m.id_materia,
materia_nombre
FROM
public."Cursos" c, public."Personas" p,
public."Docentes" d, public."PeriodoLectivo" pl,
public."Materias" m
WHERE
c.id_prd_lectivo = pl.id_prd_lectivo AND
d.id_docente = c.id_docente AND
p.id_persona = d.id_persona AND
m.id_materia = c.id_materia;

--Consultamos los silabos

--Consultamos sin cursos
SELECT
prd_lectivo_nombre,
materia_nombre,
estado_silabo
FROM
public."Silabo" s, public."Materias" m,
public."PeriodoLectivo" pl
WHERE
pl.id_prd_lectivo = s.id_prd_lectivo AND
m.id_materia = s.id_materia


SELECT
prd_lectivo_nombre,
materia_nombre,
estado_silabo,
curso_nombre
FROM
public."Silabo" s, public."Materias" m,
public."PeriodoLectivo" pl, public."Cursos" c
WHERE
pl.id_prd_lectivo = s.id_prd_lectivo AND
m.id_materia = s.id_materia AND
c.id_materia = s.id_materia AND
c.id_prd_lectivo = s.id_prd_lectivo


SELECT
s.id_silabo,
prd_lectivo_nombre,
materia_nombre,
estado_silabo,
	STRING_AGG(
		curso_nombre, ', '
	) cursos
FROM
public."Silabo" s, public."Materias" m,
public."PeriodoLectivo" pl, public."Cursos" c
WHERE
pl.id_prd_lectivo = s.id_prd_lectivo AND
m.id_materia = s.id_materia AND
c.id_materia = s.id_materia AND
c.id_prd_lectivo = s.id_prd_lectivo
GROUP BY
id_silabo,
prd_lectivo_nombre,
materia_nombre,
estado_silabo
ORDER BY prd_lectivo_nombre

--Consulta para alumnos

SELECT
a.id_alumno,
p.id_persona,
persona_primer_nombre,
persona_primer_apellido,
persona_correo,
persona_celular,
persona_telefono
FROM
public."Alumnos" a, public."Personas" p
WHERE
p.id_persona = a.id_persona

ORDER BY
persona_primer_apellido,
persona_segundo_apellido

--Consultamos las carreras

SELECT
id_carrera,
carrera_nombre,
carrera_codigo
FROM public."Carreras"
WHERE carrera_activa = true
ORDER BY carrera_codigo;

--Consultamos los periodos

SELECT
id_prd_lectivo,
prd_lectivo_nombre
FROM public."PeriodoLectivo"
WHERE prd_lectivo_activo = true
ORDER BY
prd_lectivo_nombre,
prd_lectivo_fecha_fin DESC;

--Consultamos las actividades

SELECT
numero_unidad,
titulo_unidad,
us.id_unidad,
indicador,
ta.id_tipo_actividad,
instrumento,
valoracion,
fecha_envio,
fecha_presentacion,
nombre_tipo_actividad,
nombre_subtipo_actividad
FROM
public."UnidadSilabo" us,
public."EvaluacionSilabo" es,
public."TipoActividad" ta
WHERE
us.id_silabo = 3225 AND
us.id_unidad = es.id_unidad AND
ta.id_tipo_actividad = es.id_tipo_actividad

--Este no contiene el tipo de actividad

SELECT
numero_unidad,
titulo_unidad,
us.id_unidad,
indicador,
instrumento,
valoracion,
fecha_envio,
fecha_presentacion
FROM
public."UnidadSilabo" us,
public."EvaluacionSilabo" es
WHERE
us.id_silabo = 3225 AND
us.id_unidad = es.id_unidad
ORDER BY fecha_envio, fecha_presentacion


--Todos los cursos de un periodo
SELECT
DISTINCT curso_nombre
FROM
public."Cursos" c
WHERE
c.id_prd_lectivo = 21 AND
c.curso_activo = true
ORDER BY curso_nombre;

--Cursos por nombre de curso y periodo
SELECT
id_curso,
materia_nombre
FROM
public."Cursos" c,
public."Materias" m
WHERE
m.id_materia = c.id_materia AND
c.curso_nombre ILIKE '%M3A%' AND
c.id_prd_lectivo = 21
ORDER BY materia_nombre;
