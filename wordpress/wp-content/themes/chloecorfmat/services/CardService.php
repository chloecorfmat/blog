<?php

namespace services;

require_once(get_template_directory().'/dto/CardDto.php');
use dto\CardDto;

class CardService
{
    /**
     * @param array $button
     * @return CardDto
     */
    public function buildCard(array $cardConfig):CardDto {
        $card = new CardDto();
        $card->image = $cardConfig['image'][0]['sizes']['medium'];
        $card->title = $cardConfig['title'];
        $card->text = $cardConfig['text'];
        if (isset($cardConfig['details']) && !empty($cardConfig['details'])) {
            $card->details = $cardConfig['details'];
        }

        return $card;
    }
}