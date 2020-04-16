<?php


namespace Service\SocialNetwork;


class TwitterAdapter implements SocialNetworkInterface
{
    private $twitter;

    public function __construct(Twitter $twitter)
    {
        $this->twitter = $twitter;
    }

    public function publisher(string $content): void
    {
        $this->twitter>sendTweet($content);
    }

}