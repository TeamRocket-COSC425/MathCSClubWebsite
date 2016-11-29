<?php

include_once('vendor/autoload.php');
include_once('classes/Utils.php');
include_once('classes/EditableImage.php');
include_once('classes/EditableText.php');

class EditableContent {

    const TABLE_CONTENT = 'page_content';
    const TABLE_HISTORY = 'page_content_history';

    const COLUMN_ID = 'id';
    const COLUMN_CONTENT = 'content';
    const COLUMN_TIMESTAMP = 'timestamp';

    public static function create($id) {
        global $db;
        $entry = $db->where(self::COLUMN_ID, $id)->getOne(self::TABLE_CONTENT);
        switch($entry['type']) {
            case 'text':
                return new EditableText($id);
            case 'image':
                return new EditableImage($id);
            default:
                return null;
        }
    }

    public $errors = array();

    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function text() {
        global $db;
      $content = $db->where(self::COLUMN_ID, $this->id)->getOne(self::TABLE_CONTENT);

      if (!$content) {
        $content = array(
          self::COLUMN_ID => $this->id,
          self::COLUMN_CONTENT => $this->getDefaultContent(),
          self::COLUMN_TIMESTAMP => $db->now()
        );
        $db->insert(self::TABLE_CONTENT, $content);
      }

      return $content[self::COLUMN_CONTENT];
    }

    public function save($content) {
        global $db;
        $oldcontent = $db->where(self::COLUMN_ID, $this->id)->getOne(self::TABLE_CONTENT);
        unset($oldcontent['type']);

        // If no changes are made, don't add any info to tables
        if ($oldcontent[self::COLUMN_CONTENT] === $content) {
            return 1;
        }

        // Sanity check, make sure there was something in the content table
        if ($oldcontent) {
            // Insert now outdated content into the history table, NOT updating timestamps
            $db->insert(self::TABLE_HISTORY, $oldcontent);
        }

        // Define new content data, with a fresh timestamp
        $newdata = array(
            self::COLUMN_CONTENT => $content,
            self::COLUMN_TIMESTAMP => $db->now()
        );

        // Insert new data into content table
        $db->where(self::COLUMN_ID, $this->id)->update(self::TABLE_CONTENT, $newdata);

        return 1;
    }

    public function printText() {
        echo $this->text();
    }

    public function printHTML() {
        echo $this->text();
    }

    public function printEditBox() {

    }

    public function getContent() {
        if (Utils::editModeEnabled()) {
            $this->printEditBox();
        } else {
            $this->printHTML();
        }
    }
}

?>
