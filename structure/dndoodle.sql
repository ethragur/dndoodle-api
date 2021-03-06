

CREATE DATABASE IF NOT EXISTS dndoodle;


USE dndoodle;




CREATE TABLE dnd_user
(
    user_id     VARCHAR(36) PRIMARY KEY,
    user_name   VARCHAR(32) NOT NULL,
    user_gid    VARCHAR(64),
    user_pass   BINARY(60),
    user_email  VARCHAR(128),
    UNIQUE KEY  unique_user(user_name)
);

CREATE TABLE dnd_char
(
    char_id     VARCHAR(36) PRIMARY KEY,
    char_name   VARCHAR(64) NOT NULL,
    char_data   TEXT DEFAULT "",
    last_edit   INT UNSIGNED DEFAULT 0,
    user_id     VARCHAR(36),
    FOREIGN KEY (user_id) REFERENCES dnd_user(user_id),
    CONSTRAINT char_uniq UNIQUE (user_id, char_name)
    

/*    attr_STR    TINYINT UNSIGNED NOT NULL,
    attr_DEX    TINYINT UNSIGNED NOT NULL,
    attr_CON    TINYINT UNSIGNED NOT NULL,
    attr_INT    TINYINT UNSIGNED NOT NULL,
    attr_WIS    TINYINT UNSIGNED NOT NULL,
    attr_CHA    TINYINT UNSIGNED NOT NULL,

    skill_ACRO  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_ANHA  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_ARCA  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_ATHL  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_DECE  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_HIST  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_INSI  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_INTI  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_INVE  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_MEDI  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_NATU  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_PERC  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_PERF  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_PERS  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_RELI  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_SLHA  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_STEA  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL,
    skill_SURV  ENUM('PROF', 'EXPE', 'HALF', 'NONE') NOT NULL, */
)
