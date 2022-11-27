<?php

namespace Modules\Admin\Services;

interface CrawlerInterface
{
    public function crawlerHandle();
    public function saveData($data);
}
