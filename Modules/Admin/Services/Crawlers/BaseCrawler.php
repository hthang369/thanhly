<?php

namespace Modules\Admin\Services;

use Goutte\Client;
use Modules\Admin\Entities\CrawlerPostNewsModel;
use Modules\Admin\Entities\PostCategoriesModel;
use Modules\Admin\Entities\PostImagesModel;
use Modules\Admin\Entities\PostsModel;
use Intervention\Image\ImageManagerStatic as Image;

abstract class BaseCrawler implements CrawlerInterface
{
    protected $crawlerNode;
    protected $crawlerClient;
    protected $crawler;

    public function __construct($node)
    {
        $this->crawlerNode = $node;

        $this->resetCrawlerClient();
    }

    public function __get($name)
    {
        return $this->crawlerNode->{$name};
    }

    protected function newCrawlerClient()
    {
        return new Client();
    }

    protected function resetCrawlerClient()
    {
        $this->crawlerClient = $this->newCrawlerClient();
    }

    public function saveData($data)
    {
        collect($data)->reverse()->each(function ($item) {
            $data = PostsModel::create(array_diff_key($item, ['post_image' => '']));
            PostImagesModel::create(['post_id' => $data->id, 'post_image' => $item['post_image']]);
            PostCategoriesModel::create(['post_id' => $data->id, 'category_id' => 5]);
            CrawlerPostNewsModel::create(['post_id' => $data->id, 'crawler_id' => $this->crawlerNode->id]);
        });
    }

    protected function downloadImages()
    {
        $results = PostImagesModel::select(['post_images.*'])
            ->join('crawler_posts_news', 'crawler_posts_news.post_id', '=', 'post_images.post_id')
            ->where('post_image', 'REGEXP', "^(https?://|www\\.)[\.A-Za-z0-9\-]+\\.[a-zA-Z]{2,4}")
            ->get();

        $results->each(function($item) {
            $fileInfo = pathinfo($item->post_image, PATHINFO_BASENAME);
            Image::make($item->post_image)->save(storage_path('app/public/upload/images').'//'.$fileInfo);
            $item->post_image = $fileInfo;
            $item->save();
        });
    }

    abstract protected function crawlerTitle($node);
    abstract protected function crawlerImage($node);
    abstract protected function crawlerDate($node);
    abstract protected function crawlerLink($node);
    abstract protected function crawlerExcerpt($node);
    abstract protected function crawlerContent($link);
}
