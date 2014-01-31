-- Questions/settings/my.sql 

DROP TABLE IF EXISTS engine4_question_question;
CREATE TABLE engine4_question_questions (
    question_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    description MEDIUMTEXT NULL,
    snapshot MEDIUMTEXT NULL,
    providers MEDIUMTEXT NULL,
    owner_id INT(11) UNSIGNED NOT NULL,
    owner_type INT(11) UNSIGNED NOT NULL,
    photo_id INT(11) UNSIGNED NOT NULL,
    creation_date DATETIME NOT NULL,
    modified_date DATETIME NOT NULL,
    view_count INT(11) UNSIGNED NOT NULL,
    comment_count INT(11) UNSIGNED NOT NULL,
    search TINYINT(1) NOT NULL,
    PRIMARY KEY (question_id),
    INDEX (photo_id),
    INDEX (owner_id)
);

INSERT IGNORE INTO engine4_core_menus (`name`, `type`, `title`, `order`) VALUES ('question_main', 'standard', 'Question Main Navigation Menu', 999);
INSERT IGNORE INTO engine4_core_menuitems (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `enabled`, `custom`, `order`) VALUES
('question_main_browse', 'question', 'Browse Questions', 'Question_Plugin_Menus::canViewQuestions', '{"route":"question_general","action":"browse"}', 'question_main', '', 1, 0, 1),
('question_main_manage', 'question', 'My Questions', 'Question_Plugin_Menus::canCreateQuestions', '{"route":"question_general","action":"manage"}', 'question_main', '', 1, 0, 2),
('question_main_create', 'question', 'Create Question', 'Question_Plugin_Menus::canCreateQuestions', '{"route":"question_general","action":"create"}', 'question_main', '', 1, 0, 3);
INSERT INTO engine4_activity_actiontypes (`type`, `module`, `body`, `enabled`, `displayable`, `attachable`, `commentable`, `shareable`, `is_generated`) VALUES
('question', 'question', '{item:$subject} asked {var:$question}', 1, 7, 1, 1, 1, 1);