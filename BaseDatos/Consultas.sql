--Consultamos los cursos 

SELECT
prd_lectivo_nombre,
persona_primer_nombre, 
persona_primer_apellido,
curso_nombre,
curso_ciclo, 
curso_capacidad,
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