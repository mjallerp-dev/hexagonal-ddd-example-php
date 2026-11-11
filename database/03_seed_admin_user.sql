-- Usuario administrador base, activo, para el primer inicio de sesion.
--   Correo:     admin@example.com
--   Contrasena: Admin12345*
-- La contrasena se guarda cifrada con bcrypt, como la guarda la aplicacion.
-- Cambiala desde "Editar usuario" despues del primer inicio de sesion.
-- Si el usuario ya existe, no se modifica.

INSERT INTO users (id, name, email, password, role, status)
VALUES (
    '00000000-0000-4000-8000-000000000001',
    'Administrador',
    'admin@example.com',
    '$2y$12$s6K2nGC4eSqb4M3BBqK2d.ekGZO0HA53OHBdnhM.DwPItYxATiRNS',
    'ADMIN',
    'ACTIVE'
)
ON CONFLICT DO NOTHING;
