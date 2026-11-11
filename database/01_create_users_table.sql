-- Las reglas de valores (rol, estado, longitud minima, formato del correo)
-- pertenecen al dominio y no se duplican aqui con CHECK.
-- UNIQUE en email es la excepcion: solo la base de datos puede impedir
-- duplicados cuando dos registros llegan al mismo tiempo.

CREATE TABLE IF NOT EXISTS users (
    id         VARCHAR(36)  PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(254) NOT NULL,
    password   VARCHAR(255) NOT NULL,
    role       VARCHAR(20)  NOT NULL,
    status     VARCHAR(20)  NOT NULL,
    created_at TIMESTAMPTZ  NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMPTZ  NOT NULL DEFAULT NOW(),

    CONSTRAINT uq_users_email UNIQUE (email)
);
