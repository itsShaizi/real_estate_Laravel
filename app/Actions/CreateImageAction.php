<?php

namespace App\Actions;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class CreateImageAction 
{
    public function handle(Model $model, string $image)
    {
        Storage::disk($this->getDisk($model))->makeDirectory($model->id . '/original/');

        Storage::disk($this->getDisk($model))->makeDirectory($model->id . '/thumb/');

        $filename = Str::random(40);

        $originalImage = InterventionImage::make($image);

        $originalImage->save(
            Storage::disk($this->getDisk($model))->path($model->id . '/original/') . $filename
        );

        $originalImage->resize(null, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save(
            Storage::disk($this->getDisk($model))->path($model->id . '/thumb/') . $filename
        );

        // Create Image record
        $image = new Image;
        $image->title = $filename;
        $image->ext = Str::afterLast($originalImage->mime(), '/');
        $image->type = $originalImage->mime();
        $image->sort_order = $model->images()->count();
        $image->width = $originalImage->width();
        $image->height = $originalImage->height();

        $model->images()->save($image);
    }

    public function getDisk($model): string
    {
        return (string) Str::of(get_class($model))->afterLast('\\')->snake()->lower()->plural();
    }
}
