<?php

namespace services;

require_once(get_template_directory().'/dto/ButtonDto.php');
use dto\ButtonDto;

class ButtonService
{
    /**
     * @param array $button
     * @return ButtonDto
     */
    public function buildButton(array $button):ButtonDto {
        switch ($button['acf_fc_layout']) {
            case 'anchor':
                $text = $button['text'];
                $data = null;
                $url = $button['anchor'];
                $icon = 'fa-solid fa-chevron-right';
                $target = '_self';
                $title = '';
                break;
            case 'file':
                $text = $button['text'];
                $data = '(' . strtoupper($button['file']['subtype']). ', '. $this->byteConvert($button['file']['filesize']) . ')';
                $url = $button['file']['url'];
                $icon = 'fa-solid fa-download';
                $target = '_blank';
                $title = $text . ' - Nouvelle fenêtre';
                break;
            default:
                $text = $button['text'];
                $data = null;
                $url = $button['url'];
                $icon = $button['icon'];
                $target = $button['new_window'] ? '_blank' : '_self';
                $title = $button['new_window'] ? $button['text'] . ' - Nouvelle fenêtre' : '';
        }

        $classes = '';
        switch ($button['style']) {
            case 'primary':
                $classes = "btn btn--primary";
                break;
            case 'primary-reverse':
                $classes = "btn btn--reverse btn--primary";
                break;
        }

        $btn = new ButtonDto();
        $btn->text = $text;
        $btn->data = $data;
        $btn->url = $url;
        $btn->icon = $icon;
        $btn->target = $target;
        $btn->title = $title;
        $btn->classes = $classes;

        return $btn;
    }

    private function byteConvert($bytes)
    {
        if ($bytes == 0)
            return "0.00 B";

        $s = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        $e = floor(log($bytes, 1024));

        return round($bytes/pow(1024, $e), 2).' '.$s[$e];
    }

}