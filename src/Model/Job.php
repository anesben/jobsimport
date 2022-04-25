<?php

namespace App\Model;

class Job {
    private $ref;
    private $title;
    private $description;
    private $url;
    private $companyName;
    private $publishedAt;

    public function __construct($ref, $title, $description, $url, $companyName, $publishedAt) {
        $this->ref = $ref;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->companyName = $companyName;
        $this->publishedAt = $publishedAt;
    }

    public function getRef() {
        return $this->ref;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function getPublishedAt() {
        return date("Y/m/d", strtotime($this->publishedAt));
    }
}