<?php
include_once (__DIR__ . '/Service.php');
include_once (APP_PATH . '/cores/Database.php');

class TagService extends Service
{   
    public function getAllTag() {
        $query = "SELECT * FROM tag";

        $tags = $this->getDatabase()->fetchAll(Database::fetchParam($query));

        return tags;
    }

    public function createTag($data) {
        $query = 'INSERT INTO tag (tag_name) VALUES (:tag_name)';

        $this->getDatabase()->execute(
            $query,
            [
                Database::binding('tag_name', $data['tag_name']),
            ]
        );

        return $this->getDatabase()->getLastInsertID();
    }
}