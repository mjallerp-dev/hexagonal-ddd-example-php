-- Ejecutar conectado a la base "postgres". El resto de scripts se ejecutan
-- en orden sobre la base creada:
--   psql -h HOST -U USUARIO -d postgres     -f database/00_create_database.sql
--   psql -h HOST -U USUARIO -d pgarticlesdb -f database/01_create_users_table.sql
--   psql -h HOST -U USUARIO -d pgarticlesdb -f database/02_create_articles_table.sql
--   psql -h HOST -U USUARIO -d pgarticlesdb -f database/03_seed_admin_user.sql

CREATE DATABASE pgarticlesdb;
