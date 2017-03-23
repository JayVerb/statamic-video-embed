<?php

namespace Statamic\Addons\VideoEmbed;

use Statamic\Extend\Modifier;

class VideoEmbedModifier extends Modifier
{
    /**
     * Modify a value
     *
     * @param mixed  $value    The value to be modified
     * @param array  $params   Any parameters used in the modifier
     * @param array  $context  Contextual values
     * @return mixed
     */
    public function index($value, $params, $context)
    {
        $autoplay = $this->getConfig('autoplay', false) ? 'true' : 'false';
        $loop = $this->getConfig('loop', false) ? 'true' : 'false';
        $api = $this->getConfig('api', false) ? 'true' : 'false';
        $showinfo = $this->getConfig('showinfo', true) ? 'true' : 'false';
        $controls = $this->getConfig('controls', true) ? 'true' : 'false';
      
        if (strpos($value, 'youtube') !== false || strpos($value, 'youtu.be') !== false)
        {
            $src = 'https://www.youtube.com/embed/';
            if (strpos($value, '?v=') !== false)
            {
              $src .= substr($value, strrpos($value, '=') + 1);
            }
            else
            {
              $src .= substr($value, strrpos($value, '/') + 1);
            }
            $src .= '?autoplay=' . $autoplay . '&loop=' . $loop . '&enablejsapi=' . $api . '&showinfo=' . $showinfo . '&controls=' . $controls;
        }
        elseif (strpos($value, 'vimeo') !== false)
        {
            $src = 'https://player.vimeo.com/video/' . substr($value, strrpos($value, '/') + 1) . '?autoplay=' . $autoplay . '&loop=' . $loop . '&api=' . $api . '&title=' . $showinfo . '&portrait=' . $showinfo . '&byline=' . $showinfo;
        }
        else
        {
          $src = '';
        }
        return $src;
    }
}
