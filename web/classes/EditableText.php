<?php

require_once 'vendor/autoload.php';
require_once 'classes/Utils.php';
require_once 'classes/EditableContent.php';

class EditableText extends EditableContent {

    private $parser;

    function __construct($id) {
        parent::__construct($id);
        $this->parser   = Parsedown::instance();
    }

    public function printHTML() {
         echo $this->parser->text($this->text());
    }

    private function printDiffs() {
        $text = $this->text();
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
        <form method="post" action="edit?page=<?php echo $_SERVER['REQUEST_URI']; ?>" id="edit_<?php echo $this->id; ?>">
        </form>
        <textarea class="edit_content_input" id="edit_id_<?php echo $this->id; ?>" rows="40" cols="150" name="edit_content" form="edit_<?php echo $this->id; ?>"><?php $this->printText(); ?></textarea>
        <input type="hidden" name="edit_id" value="<?php echo $this->id; ?>" form="edit_<?php echo $this->id; ?>" />
        <input id="login_input_submit" type="submit" name="save" value="Save" form="edit_<?php echo $this->id; ?>" />

        <input class="edit_show_revisions" id="show_revisions_<?php echo $this->id; ?>" type="submit" name="show_revisions" value="Show Revisions" />
        <!-- declared display:none for jquery animation -->
        <div style="display: none;" class="difflist" id="difflist_<?php echo $this->id; ?>">
            <?php $this->printDiffs(); ?>
        </div>

        <script src="jquery-3.1.0.min.js"></script>
        <!-- death to package managers -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
        <script>
            var simplemde = new SimpleMDE({ element: $("#edit_id_<?php echo $this->id; ?>")[0] });

            $(document).ready(function(){
                $("#show_revisions_<?php echo $this->id; ?>").click(function(){
                    $("#difflist_<?php echo $this->id; ?>").slideToggle();
                });
            });

        </script>
<?php
    }

    public function getDefaultContent() {
      return file_get_contents('res/template.md');
    }
}

?>
