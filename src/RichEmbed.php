<?php


namespace Discord;


class RichEmbed
{
    private $title;
    private $description;
    private $fields;

    /**
     * richEmbed constructor.
     * @param $title
     * @param $content
     */
    function __construct( $title, $content ) {

        if (!is_string($title)) { throw new \InvalidArgumentException("Title value must be a string"); }
        if (!is_string($content)) { throw new \InvalidArgumentException("Title value must be a string"); }

        $this->title = $title;
        $this->description = $content;
        $this->fields = array();
    }

    /**
     * Adds a field to the array
     *
     * @param $title
     * @param $content
     * @param $inline
     */
    public function addField($title, $content, $inline) {
        if (is_bool($inline)) {
            array_push($this->fields, array(
                "name" => $title,
                "value" => $content,
                "inline" => $inline
            ));
        } else {
            throw new \InvalidArgumentException("Inline must be a boolean value");
        }
    }

    /**
     * Builds array structure for sending
     *
     * @return array
     */
    public function build() {

        return array(
            "title" => $this->title,
            "description" => $this->description,
            "color" => 14883097,
            "fields" => $this->fields,
            "footer" => array("text" => "vSuite")
        );
    }
}
