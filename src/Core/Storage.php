<?php

namespace App\Core;

class Storage
{
    protected $basePath; // The base path for storing files

    /**
     * Create a new Storage instance.
     */
    public function __construct()
    {
        $this->basePath = ROOT_DIR . '/public'; // Set the base path as the "public" directory
    }

    /**
     * Store the uploaded file.
     *
     * @param array $file
     * @param string|null $path
     * @return string
     */
    public function store($file, $path = null)
    {
        $targetPath = $path ? $this->basePath . '/' . $path : $this->basePath;

        // Create the directory if it doesn't exist
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0777, true);
        }

        $fileName = $this->generateFileName($file);
        $filePath = $targetPath . '/' . $fileName;
        $fileUrl = $path ? url("/$path/$fileName") : url("/$fileName");

        // Move the uploaded file to the target path
        move_uploaded_file($file['tmp_name'], $filePath);

        // Return the file URL
        return $fileUrl;
    }

    /**
     * Generate a unique file name.
     *
     * @param array $file
     * @return string
     */
    protected function generateFileName($file)
    {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $extension;

        return $fileName;
    }
}
