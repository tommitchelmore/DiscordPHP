<?php


namespace Discord;

use Discord;


class User
{
private $id;
private $username;
private $discriminator;
private $avatar;

    /**
     * User constructor.
     * @param $data
     */
    public function __construct(Object $data)
    {
        $this->id = $data->id;
        $this->username = $data->username;
        $this->discriminator = $data->discriminator;
        $this->avatar = $data->avatar;
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getDiscriminator()
    {
        return $this->discriminator;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @return mixed
     */
    public function getAvatarUrl()
    {
        return strpos($this->avatar, '_', 1) ? 'https://cdn.discordapp.com/avatars/' . $this->getId() . '/' . $this->avatar . '.gif?size=128' : 'https://cdn.discordapp.com/avatars/' . $this->getId() . '/' . $this->avatar . '.png?size=128';
    }

}
