insert into users(nome, email, publisherpassword, creationdate) values ('Ana', 'ana@gmail.com', 'miau', '2022-10-20 17:49:43');
insert into publisher(userid, banned) values (1, 'TRUE');
insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (1, 0, 0, 0, '2022-10-27 12:43:22');
insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (1, 1, 0, 0, '2022-10-27 12:43:22');
insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (1, 0, 1, 0, '2022-10-27 12:43:22');
insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (1, 0, 0, 1, '2022-10-27 12:43:22');
insert into users(nome, email, publisherpassword, creationdate) values ('Ana', 'ana@gmail.com', 'miau', '2022-10-20 17:49:43');
insert into publisher(userid, banned) values (1, 'TRUE');

insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (1, 0, 0, 0, '2022-10-27 12:43:22');
insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (1, 1, 0, 0, '2022-10-27 12:43:22');
insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (1, 0, 1, 0, '2022-10-27 12:43:22');
insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (1, 0, 0, 1, '2022-10-27 12:43:22');

insert into article(postid, title, articledescription, body, accepted) values (1, 'Noticia', 'blablablabla', 'blaalbblaalb', 'TRUE');
insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (1, 12, 3, 4, '2022-05-12 13:42:12');
insert into comment(postid, articleid, content) values (5, 1, 'Boas pessoal');
insert into users(nome, email, publisherpassword, creationdate) values ('Maria', 'mario@gmail.com', 'auau', '2022-09-30 17:43:21');
insert into publisher(userid, banned) values (2, 'FALSE');
insert into post(publisherid, nlikes, ndislikes, ncomments, postdate) values (2, 9, 7, 2, '2022-05-16 14:42:12');
insert into comment(postid, articleid, content) values (6, 1, 'Xau, Laura');
