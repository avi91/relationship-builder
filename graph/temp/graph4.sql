drop procedure if exists tc2;

delimiter #

create procedure tc2()
begin

declare done tinyint unsigned default 0;

create temporary table transitive(
  user1 int unsigned,
  user2 int unsigned,
  distance smallint unsigned default 0,
  path_string varchar(500)
)engine=innodb;
DROP VIEW if exists relationship2;
CREATE VIEW relationship2 (user1, user2) AS
SELECT user1, user2 FROM relationships
union
SELECT user2, user1 from relationships;

insert into transitive select user1, user2, 1, concat(user1, '.', user2, '.') from relationship2;

create temporary table tmp engine=innodb select * from transitive;
create temporary table tmp2 engine=innodb select * from transitive;

while not done do
    if exists(select 1 from relationship2 r inner join tmp t on r.user1 = t.user2 where t.path_string not like concat('%',r.user2,'.%')) then

        insert into transitive
            select t.user1, r.user2, t.distance+1, concat(t.path_string, r.user2, '.') from relationship2 r inner join tmp t on r.user1 = t.user2 where t.path_string not like concat('%',r.user2,'.%');

        insert into tmp2 select t.user1, r.user2, t.distance+1, concat(t.path_string, r.user2, '.') from relationship2 r inner join tmp t on r.user1 = t.user2 where t.path_string not like concat('%',r.user2,'.%');
        truncate table tmp;
        insert into tmp select * from tmp2;
        truncate table tmp2;

      else
        set done = 1;
      end if;
  end while;

  select distinct * from transitive order by user1, user2, distance;

  drop temporary table if exists transitive;
  drop temporary table if exists tmp;
  drop temporary table if exists tmp2;
  end #
