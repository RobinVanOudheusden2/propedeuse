CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    role ENUM('admin', 'member') NOT NULL DEFAULT 'member',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE developers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL UNIQUE,
    country VARCHAR(80) NULL,
    founded_year SMALLINT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE platforms (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80) NOT NULL UNIQUE,
    manufacturer VARCHAR(80) NULL,
    release_year SMALLINT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE genres (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE games (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    release_date DATE NULL,
    pegi_age TINYINT UNSIGNED NULL,
    developer_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_games_developer
        FOREIGN KEY (developer_id) REFERENCES developers(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE game_genre (
    game_id BIGINT UNSIGNED NOT NULL,
    genre_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (game_id, genre_id),
    CONSTRAINT fk_game_genre_game
        FOREIGN KEY (game_id) REFERENCES games(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_game_genre_genre
        FOREIGN KEY (genre_id) REFERENCES genres(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE game_platform (
    game_id BIGINT UNSIGNED NOT NULL,
    platform_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (game_id, platform_id),
    CONSTRAINT fk_game_platform_game
        FOREIGN KEY (game_id) REFERENCES games(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_game_platform_platform
        FOREIGN KEY (platform_id) REFERENCES platforms(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE user_game_collections (
    user_id BIGINT UNSIGNED NOT NULL,
    game_id BIGINT UNSIGNED NOT NULL,
    status ENUM('wishlist', 'playing', 'completed', 'dropped') NOT NULL DEFAULT 'wishlist',
    rating TINYINT UNSIGNED NULL,
    notes TEXT NULL,
    added_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, game_id),
    CONSTRAINT chk_collection_rating CHECK (rating IS NULL OR (rating BETWEEN 1 AND 10)),
    CONSTRAINT chk_wishlist_no_rating CHECK (status <> 'wishlist' OR rating IS NULL),
    CONSTRAINT fk_collection_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_collection_game
        FOREIGN KEY (game_id) REFERENCES games(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);
