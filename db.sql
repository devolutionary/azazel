create database if not exists raphael;

use raphael

drop table if exists article_has_tag;
drop table if exists comments;
drop table if exists articles;
drop table if exists tags;

create table articles (
articleID INT(11) NOT NULL AUTO_INCREMENT,
title VARCHAR(150) NOT NULL,
subtext TEXT NULL,
content TEXT NULL,
datetime INT(11) NOT NULL,
PRIMARY KEY (articleID)
) ENGINE = InnoDB;

create table tags (
tagName VARCHAR(50) UNIQUE NOT NULL,
PRIMARY KEY (tagName)
) ENGINE = InnoDB;

create table article_has_tag (
articleID INT(11) NOT NULL,
tagName VARCHAR(50) NOT NULL,
PRIMARY KEY (articleID, tagName),
KEY fk_articleID(articleID),
KEY fk_tagName(tagName),
CONSTRAINT fk_article_key_tags
FOREIGN KEY (articleID)
REFERENCES articles(articleID)
ON UPDATE CASCADE,
CONSTRAINT fk_tag_key_tags
FOREIGN KEY (tagName)
REFERENCES tags(tagName)
ON UPDATE CASCADE
) ENGINE = InnoDB;

create table comments (
commentID INT(11) NOT NULL AUTO_INCREMENT,
articleID INT(11) NOT NULL,
datetime INT(11) NOT NULL,
name VARCHAR(100) NOT NULL,
content TEXT NOT NULL,
status BOOLEAN NOT NULL,
ipaddress VARCHAR(100) NOT NULL,
agent TEXT NOT NULL,
PRIMARY KEY (commentID),
KEY fk_articleID(articleID),
CONSTRAINT fk_article_key_comments
FOREIGN KEY (articleID)
REFERENCES articles(articleID)
ON UPDATE CASCADE
) ENGINE = InnoDB;
