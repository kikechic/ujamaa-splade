<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Intervention\Image\ImageManager;

class Helpers
{
    public static function logoSize($logo, $height = 70, $width = 100): object
    {

        return self::imageSizer(image: $logo, height: $height, width: $width);
    }

    protected static function imageSizer($image, $height, $width)
    {
        if (!$image) {
            return (object)[
                'height' => $height,
                'width' => $width,
            ];
        }

        $imageUrl = str_replace('https', 'http', strtolower($image->getUrl()));

        $modified = (new ImageManager)
            ->make($imageUrl)
            ->widen($width, function ($constraint) {
                $constraint->upsize();
            })
            ->heighten($height, function ($constraint) {
                $constraint->upsize();
            });

        return (object)[
            'height' => $modified->height(),
            'width' => $modified->width(),
        ];
    }

    public static function signatureSize($signature, $height = 50, $width = 80): object
    {
        return self::imageSizer(image: $signature, height: $height, width: $width);
    }
}
