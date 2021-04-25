<?php


namespace App\Validators;


class ImageValidation
{
    private array $file;

    public function __construct(array $file)
    {
        $this->file = $file;
    }

    public function fileValidation(): bool
    {
        if (!$this->validateSize()) {
            $_SESSION['_flash']['error'] = 'Upload size limit is 2MB';
        }
        if (!$this->validateType()) {
            $_SESSION['_flash']['error'] = 'Upload type must by jpg/png/jpeg';
        } else {
            $_SESSION['_flash']['success'] = 'Upload successful';
        }
        return $this->validateSize() && $this->validateType();
    }

    public function validateSize(): bool
    {
        return $this->file['size'] <= 2000000;
    }

    public function validateType(): bool
    {
        $type = $this->getExtension($this->file['type']);
        return $type === 'jpg' || $type === 'png' || $type === 'jpeg';
    }

    private function getExtension(string $fileType): string
    {
        return substr($fileType, strpos($fileType, "/") + 1);
    }
}