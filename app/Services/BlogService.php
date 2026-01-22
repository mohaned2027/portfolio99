<?php

namespace App\Services;

use App\Repository\BlogRepository;

class BlogService
{
    public function __construct(protected BlogRepository $blogRepository) {}

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
        return $this->blogRepository->store($data);
    }

    public function update($data, $id)
    {
        $blog = $this->blogRepository->getBlog($id);
        if (!$blog) return false;
        return $this->blogRepository->update($blog, $data);
    }

    public function delete($id)
    {
        $blog = $this->blogRepository->getBlog($id);
        if (!$blog) return false;
        return $this->blogRepository->delete($blog);
    }
}
