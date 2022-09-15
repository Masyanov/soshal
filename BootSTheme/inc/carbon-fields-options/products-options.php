<?php

if (!defined('ABSPATH')) {
    exit();
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;



add_action('carbon_fields_register_fields', 'crb_attach_post_options');

Container::make('post_meta', 'post-details', __('Детали'))
    ->where('post_type', '=', 'products')
    ->add_fields(array(
        Field::make('image', 'img', __('Картинка'))
            ->set_width(24)
            ->set_value_type('url'),

        Field::make('text', 'price', __('Стоимость'))
            ->set_width(24),
        Field::make( 'select', 'crb_content_align', 'Производитель' )
            ->set_width(50)
            ->add_options( array(
                'Xiaomi' => 'Xiaomi',
                'Google' => 'Google',
                'Apple' => 'Apple',
            ) ),
        Field::make('rich_text', 'text', __('Текст новости'))
            ->set_width(50),
        Field::make('rich_text', 'complekt', __('Комплектация'))
            ->set_width(50),
        Field::make( 'media_gallery', 'photo' , 'Галерея' )
            ->set_type( array( 'image', 'video' )),



    ));