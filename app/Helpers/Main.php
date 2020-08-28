<?php

/**
 * get all languages that have "status = 'active' "
 */
function active_languages()
{
    return \App\Models\Language::active()->selection()->get();
}

/**
 * get default language from config/app.locale
 */
function default_language()
{
    return \Config::get('app.locale');
}

/**
 * upload image helper function
 * 
 * @var string 'directory' => path for uploading
 * @var string 'image' => uploaded image name
 */
function uploadImage($directory, $image)
{
    $image->store('/', $directory);
    $filename = $image->hashName();
    $path = $directory . '/' . $filename;
    return $path;
}