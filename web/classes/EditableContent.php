<?php

include_once('vendor/autoload.php');
include_once('classes/Utils.php');

class EditableContent {

    const TABLE_CONTENT = 'page_content';
    const TABLE_HISTORY = 'page_content_history';

    const COLUMN_ID = 'id';
    const COLUMN_CONTENT = 'content';
    const COLUMN_TIMESTAMP = 'timestamp';

    private $parser;

    private $id;

    function __construct($id) {
        $this->id       = $id;
        $this->parser   = Parsedown::instance();
    }

    public function text() {
      $content = $db->where(self::COLUMN_ID, $this->id)->getOne(self::TABLE_CONTENT);

      if (!$content) {
        $content = array(
          self::COLUMN_ID = $this->id;
          self::COLUMN_CONTENT = self::getDefaultContent();
          self::COLUMN_TIMESTAMP = $db->now();
        );
        $db->insert(self::TABLE_CONTENT, $content);
      }

      return $content[self::COLUMN_CONTENT];
    }

    public function printText() {
        echo self::text();
    }

    public function printHTML() {
        echo $this->parser->text(self::text());
    }

    public function printEditBox() {
?>
        <form method="post" action=<?php echo $_SERVER['REQUEST_URI']; ?> id="edit">
        </form>
        <textarea rows="40" cols="150" name="text_info" form="edit"><?php self::printText(); ?></textarea>
        <input id="login_input_submit" type="submit" name="save" value="Save" form="edit" />
<?php
    }

    public function getContent() {
        if (Utils::editModeEnabled()) {
            self::printEditBox();
        } else {
            self::printHTML();
        }
    }

    public function getDefaultContent() {
      return file_get_contents('res/template.md');
    }
}

?>
