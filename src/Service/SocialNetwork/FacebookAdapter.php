<?php


namespace Service\SocialNetwork;


class FacebookAdapter implements SocialNetworkInterface
{
    private $facebook;

    public function __construct(Facebook $facebook)
    {
        $this->facebook = $facebook;
    }

    public function publisher(string $content): void
    {
        $this->facebook>publish($content, new DateTime());
    }
}