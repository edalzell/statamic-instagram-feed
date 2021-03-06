<?php

namespace Austenc\InstagramFeed\Tags;

use Instagram\Api;
use Statamic\Tags\Tags;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class InstagramFeed extends Tags
{
    public function index()
    {
        if (empty(config('instagram-feed.username')) || empty(config('instagram-feed.password'))) {
            return [];
        }

        try {
            $cachePool = new FilesystemAdapter('Instagram', 0, config('cache.stores.file.path'));
            $api = new Api($cachePool);
            $api->login(config('instagram-feed.username'), config('instagram-feed.password'));
            $profile = $api->getProfile($this->profile());

            return collect($profile->getMedias())->transform(function ($media) {
                return [
                    'id' => $media->getId(),
                    'width' => $media->getWidth(),
                    'height' => $media->getHeight(),
                    'image' => $media->getDisplaySrc(),
                    'thumb' => $media->getThumbnailSrc(),
                    'date' => $media->getDate()->format('Y-m-d H:i:s'),
                    'caption' => $media->getCaption(),
                    'comments' => $media->getComments(),
                    'likes' => $media->getLikes(),
                    'link' => $media->getLink(),
                ];
            })->take($this->params->get('limit', 12))->all();
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                return $th->getMessage()."\n".$th->getTraceAsString();
            }

            return [];
        }
    }

    protected function profile()
    {
        return $this->params->get(
            'profile',
            config('instagram-feed.profile') ?? config('instagram-feed.username')
        );
    }
}
