<?php

namespace Discord;

use WebSocket\Client;
use WebSocket\Exception;


/**
 * Class Discord
 * @package Discord
 */
class Discord
{
    /**
     * @var
     */
    private $token;
    /**
     * @var string
     */
    private $baseUrl = 'https://discord.com/api/v6';

    /**
     * Discord constructor.
     * @param $botToken
     */
    function __construct($botToken)
    {
        $this->token = $botToken;
    }

    /**
     * @param $endpoint
     * @param $post
     * @param null $data
     * @return mixed|string
     */
    function makeRequest($endpoint, $post, $data = null) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_POST => $post,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $this->baseUrl . $endpoint,
            CURLOPT_USERAGENT => 'vSuite Panel (https://vsuite.dev, 1.0.0)',
            CURLOPT_HTTPHEADER => array("Content-Type:application/json", 'Authorization: Bot ' . $this->token)
        ));
        try {
            $res = json_decode(curl_exec($ch), false);
            curl_close($ch);

            return $res;

        } catch (\Exception $e) {
            return "Error when handling request: {$e}";
        }
    }

    /**
     * @return mixed
     */
    function getGateway() {
        $res = $this->makeRequest('/gateway/bot', false);
        return $res->url;
    }

    /**
     * @param $gateway
     * @return bool|string
     */
    function identifyGateway($gateway) {
        $client = new Client($gateway);
        try {
            $client->send(json_encode([
                'op' => 2,
                "d" => [
                    'token' => $this->token,
                    'properties' => [
                        '$os' => 'Linux',
                        '$browser' => 'vPanel',
                        '$device' => 'vSuite'
                    ]
                ],
            ]));

            $res = $client->receive();

            if (json_decode($res, true)["op"] == 10) {
                return true;
            } else {
                throw new Exception("Failed to identify with the Discord gateway");
            }

        } catch (Exception $e) {
            echo $e;
            return "Error";
        }
    }

    /**
     * @param $id
     * @return Guild
     */
    function getGuild($id) {
        return new Guild($this->makeRequest("/guilds/" . $id, false));
    }

    /**
     * @param Guild $guild
     * @param $id
     * @return GuildMember
     */
    function getGuildMember(Guild $guild, $id) {
        return new GuildMember($this->makeRequest("/guilds/" . $guild->getId() . '/members/' . $id, false));
    }

    /**
     * @param $content
     * @param $channelId
     * @param bool $embed
     */
    function sendContent($content, $channelId, $embed = false) {
        $this->makeRequest("/channels/{$channelId}/messages", true, $embed ? array("embed" => $content) : array("content" => $content));
    }

    /**
     * @param $content
     * @param $channelId
     */
    function sendMessage($content, $channelId) {
        $this->sendContent($content, $channelId, false);
    }

    /**
     * @param $content
     * @param $channelId
     */
    function sendEmbed($content, $channelId) {
        $this->sendContent($content, $channelId, true);
    }

}
