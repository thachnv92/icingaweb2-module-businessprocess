<?php

namespace Icinga\Module\Businessprocess\Html;

use Icinga\Module\Businessprocess\Web\Url;
use Icinga\Web\Url as WebUrl;

class Audio extends BaseElement
{
    protected $tag = 'audio';

    /** @var Url */
    protected $url;

    protected $defaultAttributes = array('controls' => '', 'style' => 'display: none', 'autoplay' => 'true');

    protected function __construct()
    {
    }

    /**
     * @param Url|string $url
     * @param array $urlParams
     * @param array $attributes
     *
     * @return static
     */
    public static function create($content, array $attributes = null)
    {
        $audio = new static();
        $audio->setContent($content);
        $audio->setAttributes($attributes);
        return $audio;
    }

    /**
     * @return Attribute
     */
    public function getSrcAttribute()
    {
        return new Attribute('src', $this->getUrl()->getAbsoluteUrl('&'));
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        // TODO: What if null? #?
        return $this->url;
    }
}

