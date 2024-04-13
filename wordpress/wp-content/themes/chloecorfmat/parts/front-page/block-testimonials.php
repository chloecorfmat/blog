<?php
    $block = get_field('block_testimonials');
    $title = $block['title'];
    $testimonials = [];

    foreach ($block['testimonials'] as $testimonial) {
        $source = null;

        switch ($testimonial['source']) {
            case "linkedin":
                $source = "https://www.linkedin.com/in/chloecorfmat/";
        }

        $t = [
            'source' => null,
            'text' => $testimonial['text'],
            'name' => $testimonial['name'],
            'position_and_company' => $testimonial['position_and_company']
        ];

        $testimonials[] = $t;
    }

?>

<div class="block-testimonials" id="block-testimonials">
    <div class="block-testimonials__container">
        <h2><?php echo $title ?></h2>
        <ul class="block-testimonials__list">
            <?php foreach ($testimonials as $testimonial) { ?>
                <li class="block-testimonials__item">
                    <blockquote <?php if (!is_null($testimonial['source'])) { ?> cite="<?php echo $testimonial['source'] ?>" <?php } ?> class="block-testimonials__blockquote">
                        <p class="block-testimonials__quote"><?php echo $testimonial['text'] ?></p>
                        <footer>
                            <p class="block-testimonials__quote-author"><?php echo $testimonial['name'] ?>, <?php echo $testimonial['position_and_company'] ?></p>
                        </footer>
                    </blockquote>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>