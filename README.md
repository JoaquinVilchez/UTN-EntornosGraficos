## Universidad Tecnológica Nacional Regional Rosario

**INFORMACIÓN**
Trabajo final basado en un sistema web para "Aviso de consultas" realizado en el año 2021 para la cátedra Entornos Gráficos de la carrera de Ingeniería en Sistemas de Información.

Docentes: Daniela Diaz - Julián Butti
Comisión: 4E03

**INTEGRANTES**
Schar, Juan - Scarafía, Mario Carande - Caciorgna, Gerardo - Vilchez, Joaquin - Zoch, Leandro

# Introducción

En el presente trabajo se buscará la creación de un sitio web que facilite el aviso, organización y optimización de las consultas entre los docentes y los alumnos de la facultad. Para esto se aplicará los conocimientos de maquetación, programación y análisis adquiridos a través de los años cursados en la carrera. El grupo seguirá los lineamientos planteados por la cátedra y teniendo en cuenta la experiencia de los integrantes se entregará un sitio web completo que permita satisfacer completamente la necesidad planteada en el módulo otorgado por la cátedra.

# Definición del Sitio Web

## Objetivos del sitio

-   Mejorar la comunicación alumno-docente para las consultas
-   Evitar que el alumno asista a consulta y que el docente se haya retirado.
-   Organizar las consultas en caso de haber varios alumnos que la requieran.
-   Optimizar los tiempos de consulta.

## Descripción del Sitio

El sistema de avisos de consultas poseerá tres tipos diferentes de usuario: Alumno, Docente o Administrador.

Los administradores podrán:

1.  Gestionar los permisos de usuarios, incluyendo el alta, modificación y baja de docentes, alumnos y otros administradores.
2.  Crear consultas semanales, definiendo el día de la semana (lunes, martes, miércoles, jueves, viernes o sábado) y el horario (8:00 - 23:00 hs).
3.  Los docentes podrán visualizar las consultas que tienen asignadas, ordenadas de manera cronológica, observando en primer lugar las consultas del día actual y de las consultas próximas más cercanas. También podrá navegar y visualizar las consultas anteriores.
4.  Los alumnos podrán inscribirse a las consultas, y se les notificará a los mismos cuando el estado de la consulta sea modificado a “cancelado”.
5.  El estado de las consultas puede variar entre “pendiente”, “confirmado” y “bloqueado”.

    -   _Consulta pendiente:_ La consulta existe para un día y horario determinado y todavía no llegó a realizarse dicha consulta.
    -   _Consulta confirmada:_ Una vez finalizada la consulta, el docente confirma la realización de la consulta.
    -   _Consulta bloqueada:_ En caso de que un docente no pueda asistir a ninguna consulta en el horario y día establecido las consultas asignadas a dicho día se cambian al estado “bloqueado”.

6.  El estado de asistencia del alumno a una consulta puede variar entre inscripto, cancelada, asistida o no asistida.

    -   Consulta activa: El alumno se anota a una consulta y está en espera
        de asistir a la misma.
    -   Consulta asistida: La consulta la acepta el
        profesor una vez asistido el alumno y le envía automáticamente un
        email al alumno para realizar una reseña.
    -   Consulta no asistida: La consulta la rechaza el profesor si el alumno no se presentó a la consulta.
    -   Consulta cancelada: Un alumno decide no asistir a una consulta y por lo tanto se cancela la misma siempre y cuando resten menos de 24 horas para realizar la misma. O si el profesor la cancela.

7.  El sistema deberá notificar al administrador cuando un docente haya
    bloqueado más de un XX% de consultas sobre el total en el trayecto
    del último mes.

8.  Las consultas pueden de modo presencial o virtual. En caso de ser consultas virtuales, se deberá asignar un enlace de
9.  El administrador dispondrá de una página para visualizar el porcentaje de asistencia de cada docente, permitiendo filtrar por mes, año o rango de fecha predeterminada.

10. Los docentes recibirán una notificación el día anterior con el listado de los alumnos que asistirán. Además se le avisará vía mail que ya tiene disponible el listado de alumnos.

11. El alumno podrá acceder a su cuenta en el sistema y visualizar todas las consultas que ha asistido y realizar una reseña sobre cada una. Además, una vez finalizado el horario de consulta que se encuentre en estado “confirmado”, se le enviará un correo electrónico al alumno invitando a dejar una reseña sobre la consulta desarrollada, permitiendo calificar con puntaje de 1 al 5 la experiencia en la misma.

12. Cuando un docente modifica el estado de una consulta a “bloqueada”, esto implica cambiar el estado de asistencias de los alumnos a “cancelado” e impide que los alumnos elijan dicha consulta, sin embargo, no invisibiliza el día y horario en el cual debería el docente dar la consulta, puede observar un mensaje con el motivo del bloqueo de la misma. Además, una vez que el docente decide bloquear la consulta, se enviará una notificación vía mail a los alumnos que ya se encuentran inscriptos para dicha consulta.
13. El docente que bloquea una consulta debe proponer un día y horario alternativo, con excepción que el bloqueo cubra la semana. Es por esto que se necesita que indique el motivo del bloqueo. El motivo queda como dato para futuros requerimientos del DISI (es un dato privado). El sistema debe levantar los horarios de consulta de un archivo suministrado por el DISI para de esta forma armar el cronograma de consultas para cada docente.
14. Además el usuario administrador podrá cuando considere necesario obtener un listado de todos los docentes que deberán dar consulta en un día especificado como también en caso de ser necesario el bloqueo de las consultas con la justificación de la misma.

# Definición de la Audiencia

Los usuarios que utilizaran el sitio web serán los docentes y alumnos de la universidad que necesiten administrar de manera óptima sus consultas y la notificación de las mismas.

El sitio web deberá tener en cuenta las capacidades del usuario:

-   **Por capacidad física:**

    El sitio deberá cumplir con las normas de usabilidad y accesibilidad
    necesaria para poder abordar a todos los alumnos con capacidades
    diferentes.

-   **Por capacidad técnica:**

    La audiencia que llegue al sitio web se asume con experiencia técnica
    básica para el uso y manejo de las funcionalidades del sitio web, por
    ello se deben plantear tanto accesos simples mediante enlaces y
    botones, como también otros más complejos, mediante el uso de
    buscadores y filtros.

-   **Por conocimiento de la institución:**
    Se tendrá en cuenta que los usuarios del sitio conocen la institución
    ya que forman parte del cursado de la materia y poseen el
    conocimiento de las asignaturas que cursan o de las cuales son
    docentes.
-   **Por necesidades de información:**

    Se asume que los usuarios del sitio serán administrativos, docentes y
    alumnos de la institución en cuestión, y por lo tanto, poseen un
    objetivo básico para el cual acceden al sistema.

-   **Por ubicación geográfica:**

    El sistema brinda la posibilidad de que los estudiantes y docentes de
    la facultad puedan ingresar desde sus diferentes localidades teniendo
    en cuenta la gran cantidad de personas que participan en la facultad
    año tras año.
