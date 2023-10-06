<?php
include_once (__DIR__ . '/Service.php');
include_once (APP_PATH . '/cores/Database.php');

class TagService extends Service
{   
    public function isTagValid($tag)
    {
        // Check if the tag only consists of alphabets
        if (!ctype_alpha($tag)) {
            if (strpos($tag, ' ') !== false) {
                throw new Exception("Each tag must consist of 1 word and be separated by a comma");
            }
            throw new Exception("Each tag must only consist of alphabets");
        }

        return true;
    }

    public function isTagsValid($tags)
    {
        foreach ($tags as $tag)
        {
            $this->isTagValid($tag);
        }

        return true;
    }

    public function getPopularTags()
    {
        $query = '
            SELECT tag.tag_name, COUNT(video_tag.video_id) as tag_count
            FROM tag
            JOIN video_tag ON tag.tag_id = video_tag.tag_id
            GROUP BY tag.tag_name
            ORDER BY tag_count DESC
            LIMIT 10
        ';
    
        $result = $this->getDatabase()->fetchAll(Database::fetchParam($query, []));
        $popularTags = array_column($result, 'tag_name');
        
        return $popularTags;
    }

    public function getVideoTags($video_id)
    {
        $query = "SELECT tag.tag_name
            FROM tag
            JOIN video_tag ON tag.tag_id = video_tag.tag_id
            WHERE video_tag.video_id = :video_id
        ";

        $result = $this->getDatabase()->fetchAll(Database::fetchParam($query, [Database::binding('video_id', $video_id)]));
        $tags = array_column($result, 'tag_name');
        return $tags;
    }

    public function updateVideoTags($video_id, $tags)
    {
        $query = 'SELECT add_or_update_video_tags(:video_id, :tags)';

        return $this->getDatabase()->execute(
            $query,
            [Database::binding('video_id', $video_id), Database::binding('tags', '{' . implode(',', $tags) . '}')]
        );
    }

}