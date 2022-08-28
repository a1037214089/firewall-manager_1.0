自己写的一款很水的firewall的管理器，写的不是很好，有需要的话就拿去玩吧。

注意事项：
	先创建数据库firewalld，在其中创建表admin，表的结构（这个看需求）
		create table admin(
			id int primary key AUTO_INCREMENT,
			username varchar(255) NOT NULL,
			password varchar(255)
		)
	另外要保证php程序能够执行firewall命令和写/etc/firewalld/zones/public.xml，建议修改sudoers文件