CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE IF NOT EXISTS METUBE_USER (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL DEFAULT '',
    is_admin BOOLEAN NOT NULL,
    profile_pic VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
    updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
    CONSTRAINT check_all_user CHECK(LENGTH(username) > 0 AND LENGTH(first_name) > 0)
);


CREATE TABLE IF NOT EXISTS VIDEO (
    video_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES METUBE_USER,
    title VARCHAR(50) NOT NULL,
    thumbnail VARCHAR(255) NOT NULL,
    video_file VARCHAR(255) NOT NULL,
    video_desc VARCHAR(1024) NOT NULL DEFAULT '',
    is_official BOOLEAN NOT NULL DEFAULT FALSE,
    is_taken_down BOOLEAN NOT NULL DEFAULT FALSE,
    taken_down_by INTEGER REFERENCES METUBE_USER(user_id),
    take_down_comment VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
    updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
    CONSTRAINT check_all_video CHECK(LENGTH(title) > 0 AND (take_down_comment is NULL or LENGTH(take_down_comment) > 0))
);

CREATE TABLE IF NOT EXISTS COMMENT (
    video_id INTEGER REFERENCES VIDEO,
    comment_id SERIAL,
    comment_text VARCHAR(255) NOT NULL,
    user_id INTEGER NOT NULL REFERENCES METUBE_USER,
    created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
    updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
    CONSTRAINT comment_pk PRIMARY KEY(video_id, comment_id),
    CONSTRAINT check_all_comment CHECK(LENGTH(comment_text) > 0)
);

CREATE TABLE IF NOT EXISTS TAG (
    tag_id SERIAL PRIMARY KEY,
    tag_name VARCHAR(50) NOT NULL,
    CONSTRAINT check_all_tag CHECK(LENGTH(tag_name) > 0)
);

CREATE TABLE IF NOT EXISTS VIDEO_TAG (
    video_id INTEGER REFERENCES VIDEO,
    tag_id INTEGER REFERENCES TAG,
    CONSTRAINT video_tag_pk PRIMARY KEY(video_id, tag_id)
);


-- functions
CREATE OR REPLACE FUNCTION update_timestamp()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = current_timestamp;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- triggers
CREATE OR REPLACE TRIGGER update_user_timestamp
BEFORE UPDATE ON METUBE_USER
FOR EACH ROW
EXECUTE FUNCTION update_timestamp();

CREATE OR REPLACE TRIGGER update_video_timestamp
BEFORE UPDATE ON VIDEO
FOR EACH ROW
EXECUTE FUNCTION update_timestamp();

CREATE OR REPLACE TRIGGER update_comment_timestamp
BEFORE UPDATE ON COMMENT
FOR EACH ROW
EXECUTE FUNCTION update_timestamp();