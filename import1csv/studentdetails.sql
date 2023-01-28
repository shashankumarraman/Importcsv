CREATE TABLE `user_info` (
  `u_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `age` int(10) NOT NULL,
  `class` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `user_add` (
  `a_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `add_street` varchar(200) NOT NULL,
  `add_city` varchar(200) NOT NULL,
  `add_state` varchar(200) NOT NULL,
  `hobby1` varchar(200) NOT NULL,
  `hobby2` varchar(200) NOT NULL,
  `hobby3` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user_info`
  ADD PRIMARY KEY (`u_id`);

ALTER TABLE `user_add`
  ADD PRIMARY KEY (`a_id`);

ALTER TABLE `user_info`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `user_add`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
