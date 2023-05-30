INSERT INTO users(nome, email, publisherPassword, creationDate) VALUES('a', 'a@gmail.com', 'a', '2022-10-03 20:20:00');
INSERT INTO users(nome, email, publisherPassword, creationDate) VALUES('b', 'b@gmail.com', 'b', '2022-10-03 20:20:10');

INSERT INTO publisher(userID, banned) VALUES (1, 'False');
INSERT INTO publisher(userID, banned) VALUES (2, 'True');

INSERT INTO post(publisherID, nLikes, nDislikes, nComments, postDate) VALUES(1, 1,2,3, '2022-10-03 20:25:00');
INSERT INTO post(publisherID, nLikes, nDislikes, nComments, postDate) VALUES(2, 3,4,5, '2022-10-03 20:25:10');

DELETE FROM users WHERE userID = 1;

DELETE FROM publisher WHERE publisherID = 1;

BEGIN TRANSACTION;

SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;

UPDATE publisher SET publisherID = 2
    WHERE banned = 'True';
  
UPDATE post SET publisherID = 2 

    WHERE publisherID= NULL;

END TRANSACTION;