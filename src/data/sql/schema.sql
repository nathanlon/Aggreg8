CREATE TABLE event (id BIGINT AUTO_INCREMENT, total_money DECIMAL(20, 2), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE just_giving_event (id BIGINT AUTO_INCREMENT, jg_event_code VARCHAR(20), event_id BIGINT, INDEX event_id_idx (event_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE page (id BIGINT AUTO_INCREMENT, just_giving_page_code VARCHAR(20), charity_code VARCHAR(20), charity_name VARCHAR(200), money_raised DECIMAL(20, 2), just_giving_event_id BIGINT, INDEX just_giving_event_id_idx (just_giving_event_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE charity (id BIGINT AUTO_INCREMENT, code VARCHAR(20), name VARCHAR(200), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE just_giving_event ADD CONSTRAINT just_giving_event_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id);
ALTER TABLE page ADD CONSTRAINT page_just_giving_event_id_just_giving_event_id FOREIGN KEY (just_giving_event_id) REFERENCES just_giving_event(id);
