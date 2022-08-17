


-----------------------------------------------------------------------------------------------------------------------------------------------------
--DROP TABLE IF EXISTS info.film_users;
--DROP TABLE IF EXISTS info.users;
-----------------------------------------------------------------------------------------------------------------------------------------------------


-----------------------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS info.users (
id serial4 NOT NULL,
login text NOT NULL,
"password" text NOT NULL,
auth_key text NOT NULL,
CONSTRAINT users_pkey PRIMARY KEY (id)
);
CREATE UNIQUE INDEX IF NOT EXISTS login_idx ON info.users USING btree (login);
-----------------------------------------------------------------------------------------------------------------------------------------------------


-----------------------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS info.film_users (
user_id int4 NOT NULL,
film_id int4 NOT NULL,
CONSTRAINT film_users_pkey PRIMARY KEY (user_id, film_id),
CONSTRAINT film_users_film_id_fkey FOREIGN KEY (film_id) REFERENCES public.film(film_id),
CONSTRAINT film_users_user_id_fkey FOREIGN KEY (user_id) REFERENCES info.users(id) ON DELETE CASCADE
);
-----------------------------------------------------------------------------------------------------------------------------------------------------




--INSERT INTO info.users (login, "password", auth_key) VALUES ('TestUser', '$2y$10$CIGQGgId8hf8mGh9/ZKXFevxwlx4PxzNdHol1LU8mQz6/jBJuqlrK', 'bxXqafTjNtw_PgIAc-N4cV-7xpOirozX');


