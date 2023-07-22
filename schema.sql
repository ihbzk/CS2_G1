DROP TABLE IF EXISTS "User" CASCADE;
DROP TABLE IF EXISTS "Role" CASCADE;
DROP TABLE IF EXISTS "Media" CASCADE;
DROP TABLE IF EXISTS "Product" CASCADE;
DROP TABLE IF EXISTS "Element" CASCADE;
DROP TABLE IF EXISTS "Page" CASCADE;
DROP TABLE IF EXISTS "PageElement" CASCADE;
DROP TABLE IF EXISTS "Comment" CASCADE;
DROP TABLE IF EXISTS "Sale" CASCADE;
DROP TABLE IF EXISTS "Category" CASCADE;

CREATE TABLE "Role" (
    id           SERIAL         NOT NULL,
    name         VARCHAR(64)    NOT NULL, 
    PRIMARY KEY (id)
);

CREATE TABLE "Media" (
    id            SERIAL         NOT NULL,
    url           VARCHAR(64)    NOT NULL,
    type          BOOLEAN        NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (url)
);

CREATE TABLE "Category" (
    id            SERIAL         NOT NULL,
    name          VARCHAR(64)    NOT NULL, 
    PRIMARY KEY (id)
);

CREATE TABLE "Sale" (
    id            SERIAL         NOT NULL,
    date          DATE           NOT NULL,
    amount        DECIMAL        NOT NULL, 
    PRIMARY KEY (id)
);

CREATE TABLE "User" (
    id            SERIAL         NOT NULL,
    id_role       INTEGER        NOT NULL,
    is_verified   BOOLEAN        NOT NULL DEFAULT FALSE, 
    firstname     VARCHAR(64)   NOT NULL, 
    lastname      VARCHAR(64)    NOT NULL,
    pseudo        VARCHAR(64)    NOT NULL, 
    birth_date    DATE           NOT NULL,
    email         VARCHAR(128)   NOT NULL,
    phone         VARCHAR(10)    DEFAULT NULL,
    country       CHAR(2)        DEFAULT NULL,
    thumbnail     VARCHAR(255)   DEFAULT NULL,
    zip_code      VARCHAR(6)     DEFAULT NULL,
    address       VARCHAR(256)   DEFAULT NULL,
    pwd           VARCHAR(256)   NOT NULL,
    token         VARCHAR(256)   DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_role) REFERENCES "Role"(id)
);

CREATE TABLE "Product" (
    id               SERIAL         NOT NULL,
    id_seller        INTEGER        NOT NULL,
    id_category      INTEGER        NOT NULL,
    name             VARCHAR(256)   NOT NULL, 
    description      VARCHAR(256)   NOT NULL,
    price            DECIMAL        NOT NULL, 
    stock            VARCHAR        NOT NULL,
    thumbnail        VARCHAR(255)   DEFAULT NULL, 
    slug             VARCHAR(256)   NOT NULL UNIQUE,
    meta_title       VARCHAR(256),
    meta_description VARCHAR(256),
    meta_keywords    VARCHAR(256),
    PRIMARY KEY (id),
    FOREIGN KEY (id_seller) REFERENCES "User"(id),
    FOREIGN KEY (id_category) REFERENCES "Category"(id)
);

CREATE TABLE "Comment" (
    id            SERIAL         NOT NULL,
    content       VARCHAR(256)   NOT NULL, 
    date          DATE           NOT NULL,
    id_user       INTEGER        NOT NULL,
    id_product    INTEGER        NOT NULL,
    id_reporter   INTEGER        DEFAULT NULL,
    is_reported   BOOLEAN        NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id),
    FOREIGN KEY (id_user) REFERENCES "User"(id),
    FOREIGN KEY (id_product) REFERENCES "Product"(id),
    FOREIGN KEY (id_reporter) REFERENCES "User"(id)

);

CREATE TABLE "Element" (
    id              SERIAL          NOT NULL,
    name            VARCHAR(256)    NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE "Page" (
    id               SERIAL         NOT NULL,
    id_user          INTEGER        NOT NULL,
    cover_image      VARCHAR(256)   DEFAULT NULL,
    cover_title      VARCHAR(256)   DEFAULT NULL,
    slug             VARCHAR(256)   NOT NULL,
    meta_title       VARCHAR(256),
    meta_description VARCHAR(256),
    meta_keywords    VARCHAR(256),
    PRIMARY KEY (id),
    FOREIGN KEY (id_user) REFERENCES "User"(id)
);

CREATE TABLE "PageElement" (
    id              SERIAL          NOT NULL,
    id_page         INTEGER         NOT NULL,
    id_element      INTEGER         NOT NULL,
    content         TEXT            NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_page) REFERENCES "Page"(id),
    FOREIGN KEY (id_element) REFERENCES "Element"(id)
);

CREATE TABLE "PageHistory" (
    id               SERIAL         NOT NULL,
    id_page          INTEGER        NOT NULL,
    id_user          INTEGER        NOT NULL,
    cover_image      VARCHAR(256)   NOT NULL,
    cover_title      VARCHAR(256)   NOT NULL,
    slug             VARCHAR(256)   NOT NULL,
    meta_title       VARCHAR(256),
    meta_description VARCHAR(256),
    meta_keywords    VARCHAR(256),
    created_at       TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (id_page) REFERENCES "Page"(id),
    FOREIGN KEY (id_user) REFERENCES "User"(id)
);
