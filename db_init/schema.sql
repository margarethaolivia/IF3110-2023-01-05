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
    thumbnail VARCHAR(255),
    video_file VARCHAR(255),
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
    video_id INTEGER REFERENCES VIDEO ON DELETE CASCADE,
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
    video_id INTEGER REFERENCES VIDEO ON DELETE CASCADE,
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

CREATE OR REPLACE FUNCTION add_or_update_video_tags(video_id_arg INTEGER, tags_arg VARCHAR[])
RETURNS VOID AS $$
DECLARE
    v_tag_name VARCHAR;
    v_tag_id INTEGER;
BEGIN
    -- Iterate through the provided tags
    FOR v_tag_name IN SELECT unnest(tags_arg) AS tag_name
    LOOP
        -- Convert the tag to lowercase
        v_tag_name := LOWER(v_tag_name);

        -- Check if the tag already exists
        SELECT tag_id INTO v_tag_id FROM tag WHERE LOWER(tag_name) = v_tag_name;

        -- If the tag does not exist, create it
        IF v_tag_id IS NULL THEN
            INSERT INTO tag(tag_name) VALUES (v_tag_name) RETURNING tag_id INTO v_tag_id;
        END IF;

        -- Insert or update the relationship in video_tag
        INSERT INTO video_tag(video_id, tag_id) VALUES (video_id_arg, v_tag_id)
        ON CONFLICT (video_id, tag_id) DO NOTHING;
    END LOOP;

    -- Delete relationships not in the provided list of tags
    DELETE FROM video_tag
    WHERE video_id = video_id_arg AND video_tag.tag_id NOT IN (
        SELECT tag_id FROM tag WHERE LOWER(tag_name) = ANY(SELECT unnest(tags_arg))
    );

    -- Delete tags with zero relationships
    DELETE FROM tag
    WHERE tag_id NOT IN (SELECT video_tag.tag_id FROM video_tag);
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION delete_unused_tags()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM TAG
    WHERE tag_id = OLD.tag_id
    AND NOT EXISTS (
        SELECT 1
        FROM VIDEO_TAG
        WHERE tag_id = OLD.tag_id
    );

    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_delete_unused_tags
AFTER DELETE ON VIDEO_TAG
FOR EACH ROW
EXECUTE FUNCTION delete_unused_tags();