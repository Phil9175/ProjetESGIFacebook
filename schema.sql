DROP SCHEMA IF EXISTS "concoursPhotos" CASCADE;

CREATE SCHEMA "concoursPhotos";

CREATE TABLE "concoursPhotos"."concours"
(
  "id_Concours" int NOT NULL,
  "name" VARCHAR  NOT NULL,
  "description" VARCHAR,
  "award" VARCHAR,
  "start_date" DATETIME_INTERVAL_CODE  NOT NULL,
  "end_date" DATETIME_INTERVAL_CODE  NOT NULL,
  "status" bool,
  "ranking" text,
  PRIMARY KEY ("idConcours")
);

CREATE TABLE "concoursPhotos"."participation"
(
  "id_competition" int NOT NULL,
  "id_participant" int NOT NULL,
  "id_photo"int NOT NULL,
  FOREIGN KEY ("id_competition")
      REFERENCES "concoursPhotos"."concours" ("id_competition") MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  FOREIGN KEY ("id_participant")
      REFERENCES "concoursPhotos"."participant" ("id_participant") MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE "concoursPhotos"."participant"
(
  "id_participant" int NOT NULL,
  "name" VARCHAR NOT NULL,
  "firstName" VARCHAR NOT NULL,
  "sex" VARCHAR,
  "email" VARCHAR NOT NULL,
  "birth_date" DATE ,
  "localisation" VARCHAR,
  "role" VARCHAR,
  PRIMARY KEY ("id_participant")
);
