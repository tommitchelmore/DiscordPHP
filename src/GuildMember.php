<?php


namespace Discord;


class GuildMember
{
    private $user;
    private $roles;
    private $joined_at;

    /**
     * Guild constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->user = new User($data->user);
        $this->roles = $data->roles;
        $this->joined_at = $data->joined_at;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return mixed
     */
    public function getJoinedAt()
    {
        return $this->joined_at;
    }

}
