<?php

namespace App\Services;

use App\Repository\BlogRepository;
use App\Utils\ImageManager;

class BlogService
{
    public function __construct(protected BlogRepository $blogRepository, protected ImageManager $imageManager) {}

    public function getBlogs()
    {
        return $this->blogRepository->getBlogs();
    }

    public function getBlog($id)
    {
        return $this->blogRepository->getBlog($id) ?? false;
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageManager->uploadSingleImage($data['image'], 'blogs', 's3');
            if (! $data['image']) {
                return false;
            }
        }

        return $this->blogRepository->store($data);
    }

    public function update($data, $id)
    {
        $blog = $this->blogRepository->getBlog($id);

        if (isset($data['image'])) {
            $data['image'] = $this->imageManager->uploadSingleImage($data['image'], 'blogs', 's3', $blog->image);
            if (! $data['image']) {
                return false;
            }
        }
        if (! $blog) {
            return false;
        }

        return $this->blogRepository->update($blog, $data);
    }

    public function delete($id)
    {
        $blog = $this->blogRepository->getBlog($id);
        if (! $blog) {
            return false;
        }
        $this->imageManager->deleteImageFromLocal($blog->image , 's3');

        return $this->blogRepository->delete($blog);
    }
}
