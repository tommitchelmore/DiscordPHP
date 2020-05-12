<?php


namespace Discord;


class Guild
{
    private $id;
    private $name;
    private $icon;

    /**
     * Guild constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->icon = $data->icon;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

}
