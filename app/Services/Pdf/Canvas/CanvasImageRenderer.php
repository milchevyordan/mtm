<?php

declare(strict_types=1);

namespace App\Services\Pdf\Canvas;

use Illuminate\Contracts\Support\Arrayable;

class CanvasImageRenderer extends CanvasRenderer implements Arrayable
{
    private ?string $imagePath;

    private float $width;

    private float $height;

    private string $resolution;

    public function __construct(
        float $x,
        float $y,
        string $imagePath,
        float $width,
        float $height,
        string $resolution = 'normal',
        ?bool $isOnEveryPage = false,
    ) {
        parent::__construct($x, $y, $isOnEveryPage);

        $this->imagePath = $imagePath;
        $this->width = $width;
        $this->height = $height;
        $this->resolution = $resolution;
    }

    public function toArray(): array
    {
        return [
            $this->imagePath,
            $this->x,
            $this->y,
            $this->width,
            $this->height,
            $this->resolution,
        ];
    }
}
