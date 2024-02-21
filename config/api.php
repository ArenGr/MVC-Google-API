<?php

return array(
    'api' => array(
        'google' => array(
            'key' => $_ENV['GOOGLE_API_KEY'],
            'url' => $_ENV['GOOGLE_MAP_URL'],
            'settings' => array(
                "zoom=7",
                "size=600x400",
//                'markers=color:red',
                'format=png',
            )
        )
    )
);