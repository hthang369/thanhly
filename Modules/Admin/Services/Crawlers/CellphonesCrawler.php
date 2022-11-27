<?php

namespace Modules\Admin\Services;

class CellphonesCrawler extends BaseCrawler
{
    public function crawlerHandle()
    {
        for ($i = $this->crawler_page_to; $i >= $this->crawler_page_from; $i--) {
            $post_data = [];
            $this->newCrawlerClient();
            $this->crawler = $this->crawlerClient->request('GET', $this->crawler_link);
            $this->crawler->filter($this->crawler_selector)->each(function ($node) use (&$post_data) {
                list($link, $title) = $this->crawlerTitle($node);
                array_push($post_data, [
                    'post_author' => 'sysadmin',
                    'post_title' => $title,
                    'post_link' => $link,
                    'post_excerpt' => $this->crawlerExcerpt($node),
                    'post_date' => now(),
                    'post_content' => $this->crawlerContent($node),
                    'post_type' => 'news',
                    'post_status' => 1,
                    'post_image' => $this->crawlerImage($node)
                ]);
            });
            $this->saveData($post_data);
        }

        $this->downloadImages();
    }
    protected function crawlerTitle($node)
    {
        if (!empty($this->title_selector))
            return head($node->filter($this->title_selector)->extract(['href', '_text']));

        return '';
    }
    protected function crawlerImage($node)
    {
        if (!empty($this->image_selector))
            return head($node->filter($this->image_selector)->extract(['data-src']));

        return '';
    }
    protected function crawlerDate($node)
    {
        if (!empty($this->date_selector))
            return $node->filter($this->date_selector)->text();

        return '';
    }
    protected function crawlerLink($node)
    {
        if (!empty($this->link_selector))
            return head($node->filter($this->link_selector)->extract(['href']));

        return '';
    }
    protected function crawlerExcerpt($node)
    {
        if (!empty($this->excerpt_selector))
            return $node->filter($this->excerpt_selector)->text();

        return '';
    }
    protected function crawlerContent($link)
    {
        if (!empty($this->content_selector)) {
            $crawlerContent = $this->newCrawlerClient();
            $content = $crawlerContent->request('GET', $link);
            return $content->filter($this->content_selector)->html();
        }

        return '';
    }

}
