-- Las reglas de valores (rangos, categorias, longitud minima) pertenecen
-- al dominio y no se duplican aqui con CHECK.

CREATE TABLE IF NOT EXISTS articles (
    id             VARCHAR(36)    PRIMARY KEY,
    description    VARCHAR(255)   NOT NULL,
    provider       VARCHAR(100)   NOT NULL,
    brand          VARCHAR(100)   NOT NULL,
    model          VARCHAR(100)   NOT NULL,
    category       VARCHAR(50)    NOT NULL,
    store          VARCHAR(100)   NOT NULL,
    quantity       INT            NOT NULL,
    purchase_price DECIMAL(12, 2) NOT NULL,
    sale_price     DECIMAL(12, 2) NOT NULL,
    iva            DECIMAL(5, 2)  NOT NULL,
    created_at     TIMESTAMPTZ    NOT NULL DEFAULT NOW(),
    updated_at     TIMESTAMPTZ    NOT NULL DEFAULT NOW()
);
