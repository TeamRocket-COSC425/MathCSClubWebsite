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
        global $db;
      $content = $db->where(self::COLUMN_ID, $this->id)->getOne(self::TABLE_CONTENT);

      if (!$content) {
        $content = array(
          self::COLUMN_ID => $this->id,
          self::COLUMN_CONTENT => self::getDefaultContent(),
          self::COLUMN_TIMESTAMP => $db->now()
        );
        $db->insert(self::TABLE_CONTENT, $content);
      }

      return $content[self::COLUMN_CONTENT];
    }

    public function save($content) {
        global $db;
        $oldcontent = $db->where(self::COLUMN_ID, $this->id)->getOne(self::TABLE_CONTENT);

        // If no changes are made, don't add any info to tables
        if ($oldcontent[self::COLUMN_CONTENT] === $content) {
            return;
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
    }

    public function printText() {
        echo self::text();
    }

    public function printHTML() {
        echo $this->parser->text(self::text());
    }

    private function printDiffs() {
        $text = self::text();
        $content = explode("\n", $text);

        global $db;
        $history = $db->where(self::COLUMN_ID, $this->id)->orderBy(self::COLUMN_TIMESTAMP, 'desc')->get(self::TABLE_HISTORY);

        $renderer = new Diff_Renderer_Html_Inline;

        foreach ($history as $row) {
            $oldtext = $row[self::COLUMN_CONTENT];
            $oldcontent = explode("\n", $oldtext);

            $diff = new Diff($oldcontent, $content, []);
            echo '<div class="diff"><div class="difftable">' . $diff->Render($renderer) . '</div>';

            ?>
            <form method="post" action="edit?page=<?php echo $_SERVER['REQUEST_URI']; ?>" id="revert">
                <input id="edit_revert" type="submit" name="revert" value="Revert to This Version" />
                <input id="edit_revert_to" type="hidden" name="revert_to" value="<?php echo $row[self::COLUMN_TIMESTAMP] ?>"/>
            </form>
            </div>
            <?php

            $content = $oldcontent;
            $text = $oldtext;
        }
    }

    public function printEditBox() {
?>
        <center>
        <h3>
            Editing "<?php echo $this->id?>":
        </h3>
        </center>
        <form method="post" action="edit?page=<?php echo $_SERVER['REQUEST_URI']; ?>" id="edit">
        </form>
        <textarea id="edit_content_input" rows="40" cols="150" name="edit_content" form="edit"><?php self::printText(); ?></textarea>
        <input type="hidden" name="edit_id" value="<?php echo $this->id; ?>" form="edit" />
        <input id="login_input_submit" type="submit" name="save" value="Save" form="edit" />

        <input id="edit_show_revisions" type="submit" name="show_revisions" value="Show Revisions" />
        <!-- declared display:none for jquery animation -->
        <div style="display: none;" class="difflist">
            <?php self::printDiffs(); ?>
        </div>

        <script src="jquery-3.1.0.min.js"></script>
        <!-- death to package managers -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
        <script>
            var simplemde = new SimpleMDE();

            $(document).ready(function(){
                $("#edit_show_revisions").click(function(){
                    $(".difflist").slideToggle();
                });
            });

        </script>
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
