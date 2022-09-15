<?php

if (!defined('ABSPATH')) {
    exit();
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', 'crb_attach_post_options');

Container::make('post_meta', 'post-details', __('Детали'))
    ->where('post_type', '=', 'news')
    ->add_fields(array(
        Field::make('image', 'img', __('Картинка'))
            ->set_width(10)
            ->set_value_type('url'),
        Field::make('date', 'date', __('Дата новости'))
            ->set_width(10),
        Field::make('rich_text', 'text', __('Текст новости'))
            ->set_width(100),
    ));
