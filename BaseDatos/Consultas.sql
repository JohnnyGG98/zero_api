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