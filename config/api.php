<?php

return array(
    'api' => array(
        'google' => array(
            'maps' => array(
                'key' => $_ENV['GOOGLE_API_KEY'],
                'url' => $_ENV['GOOGLE_MAPS_URL'],
                'settings' => array(
                    'static_image' => array(
                        'zoom=15',
                        'size=600x400',
                        'format=png',
                    )
                )
            )
        )
    )
);