INSERT INTO gs_an_table(name,email,naiyou,indate)VALUE('田中','test03@example.com','ないよ',sysdate());
INSERT INTO gs_an_table(name,email,naiyou,indate)VALUE('山田','test04@example.com','ないよ',sysdate());
INSERT INTO gs_an_table(name,email,naiyou,indate)VALUE('石井','test05@example.com','ないよ',sysdate());
INSERT INTO gs_an_table(name,email,naiyou,indate)VALUE('原田','test06@example.com','ないよ',sysdate());
INSERT INTO gs_an_table(name,email,naiyou,indate)VALUE('角','test011@example.com','ないよ',sysdate());

INSERT INTO gs_an_table(name,email,naiyou,indate)VALUE(:name, :email, :naiyou, sysdate());
