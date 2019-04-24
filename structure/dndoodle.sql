

CREATE DATABASE IF NOT EXISTS dndoodle;


USE dndoodle;




CREATE TABLE dnd_user
(
    user_id     INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name   VARCHAR(32) NOT NULL,
    user_gid    VARCHAR(64),
    user_pass   BINARY(60)
    user_email  VARCHAR(128)
);

CREATE TABLE dnd_char
(
    char_id     INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    char_name   VARCHAR(64) NOT NULL,
    last_edit   INT UNSIGNED DEFAULT 0,
    user_id     INT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES dnd_user(user_id)
)

CREATE TABLE dnd_char_attr
(
    attr_STR    TINYINT UNSIGNED NOT NULL,
    attr_DEX    TINYINT UNSIGNED NOT NULL,
    attr_CON    TINYINT UNSIGNED NOT NULL,
    attr_INT    TINYINT UNSIGNED NOT NULL,
    attr_WIS    TINYINT UNSIGNED NOT NULL,
    attr_CHA    TINYINT UNSIGNED NOT NULL,
    char_id     INT UNSIGNED,
    FOREIGN KEY (char_id) REFERENCES dnd_char(char_id)
)

CREATE TABLE dnd_char_skills
(
    skill_ACRO TINYINT NOT NULL,
    {"KNOW": "PROF", "MODI": "-1"}
    skill_ANHA TINYINT NOT NULL,
    skill_ARCA TINYINT NOT NULL,
    skill_ATHL TINYINT NOT NULL,
    skill_DECE TINYINT NOT NULL,
    skill_HIST TINYINT NOT NULL,
    skill_INSI TINYINT NOT NULL,
    skill_INTI TINYINT NOT NULL,
    skill_INVE TINYINT NOT NULL,
    skill_MEDI TINYINT NOT NULL,
    skill_NATU TINYINT NOT NULL,
    skill_PERC TINYINT NOT NULL,
    skill_PERF TINYINT NOT NULL,
    skill_PERS TINYINT NOT NULL,
    skill_RELI TINYINT NOT NULL,
    skill_SLHA TINYINT NOT NULL,
    skill_STEA TINYINT NOT NULL,
    skill_SURV TINYINT NOT NULL,
    char_id     INT UNSIGNED,
    FOREIGN KEY (char_id) REFERENCES dnd_char(char_id)
)

CREATE TABLE dnd_char_saves
(
)
