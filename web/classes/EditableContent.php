<?php

include_once('vendor/autoload.php');
include_once('classes/Utils.php');

class EditableContent {

    private $parser;

    private $filename;
    private $dir;

    function __construct($file) {
        $this->filename = $file;
        $this->dir      = dirname($this->filename);
        $this->parser   = Parsedown::instance();
    }

    public function text() {
        return stream_get_contents(self::getStream());
    }

    public function printText() {
        echo self::text();
    }

    public function printHTML() {
        $text = stream_get_contents(self::getStream());
        echo $this->parser->text($text);
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

    public function getStream() {
        if (!file_exists($this->dir)) {
            mkdir($this->dir);
        }
        if (!file_exists($this->filename)) {
            $file = fopen($this->filename, 'w') or die("Unable to open file $file!");
            fwrite($file, file_get_contents('res/template.md'));
        }
        return fopen($this->filename, 'r');
    }
}

?>
