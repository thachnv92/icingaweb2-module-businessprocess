<?php

namespace Icinga\Module\Businessprocess\Html;

use Icinga\Module\Businessprocess\Web\Url;
use Icinga\Web\Url as WebUrl;

class Source extends BaseElement
{
    protected $tag = 'source';

    /** @var Url */
    protected $url;

    protected $defaultAttributes = array('type' => '');

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
    public static function create($url, $urlParams = null, array $attributes = null)
    {
        $source = new static();
        $source->setAttributes($attributes);
        $source->attributes()->registerCallbackFor('src', array($source, 'getSrcAttribute'));
        $source->setUrl($url, $urlParams);
        return $source;
    }

    public function setUrl($url, $urlParams)
    {
        if ($url instanceof WebUrl) { // Hint: Url is also a WebUrl
            if ($urlParams !== null) {
                $url->addParams($urlParams);
            }

            $this->url = $url;
        } else {
            if ($urlParams === null) {
                $this->url = Url::fromPath($url);
            } else {
                $this->url = Url::fromPath($url, $urlParams);
            }
        }

        $this->url->getParams();
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

