BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "accounts" (
	"id"	INTEGER,
	"email"	TEXT NOT NULL,
	"password"	TEXT NOT NULL,
	"admin"	INTEGER NOT NULL DEFAULT 0,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "hosts" (
	"id"	INTEGER,
	"account_id"	INTEGER,
	"hostname"	TEXT,
	"ip"	TEXT,
	"user"	TEXT,
	"password"	TEXT,
	"lastupdate"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO "accounts" VALUES (1,'pobfdm@gmail.com','a53bd0415947807bcb95ceec535820ee',1);
INSERT INTO "hosts" VALUES (5,1,'miohost1','192.167.2.31','fabio','6ff5613f2b767d6f4c02f4b0ae17e727','Tue Apr 6 8:48:33  2021');
INSERT INTO "hosts" VALUES (8,1,'miohost2','192.167.2.31','fabio','6ff5613f2b767d6f4c02f4b0ae17e727',NULL);
INSERT INTO "hosts" VALUES (9,1,'win7virtual','192.168.132.4','fabio','a53bd0415947807bcb95ceec535820ee','Tue Apr 6 13:55:13  2021');
COMMIT;
