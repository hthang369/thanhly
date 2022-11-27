<?php
namespace Modules\Admin\Services\Weathers;

use Closure;
use Laka\Core\Facades\Common;

abstract class BaseWeather 
{
    protected $baseUrl = '';
    protected $viewName = '';

    public abstract function generateUrl();

    public abstract function renderData();

    public function getFullUrl()
    {
        $address = config($this->baseUrl);
        list($urlInfo, $params) = $this->generateUrl();
        $fullUrl = sprintf('%s/%s', $address, join('/', $urlInfo));
        return [$fullUrl, $params];
    }

    protected function execDataUrl()
    {
        list($fullUrl, $params) = $this->getFullUrl();
        return Common::callApi('get', $fullUrl, $params);
    }

    public function getDataInfo(Closure $callback)
    {
        $body = $this->execDataUrl();
        if (is_callable($callback)) {
            return $callback($body);
        }

        return null;
    }

    public function render()
    {
        $data = $this->renderData();
        return view(sprintf("admin::weathers.{$this->viewName}"), $data);
    }
}