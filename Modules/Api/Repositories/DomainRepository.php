<?php

namespace Modules\Api\Repositories;

use Laka\Core\Facades\Common;
use Modules\Api\Grids\DomainGrid;
use Laka\Core\Repositories\CoreRepository;
use Modules\Api\Entities\NewsModel;

class DomainRepository extends CoreRepository
{
    protected $presenterClass = DomainGrid::class;

    protected $modelClass = NewsModel::class;

    public function search($key)
    {
        $available = $this->searchAvailable($key);
        $populars = $this->searchPopular($key);
        $suggest = $this->searchSuggest($key);
        return collect(compact('available', 'populars', 'suggest'));
    }

    protected function searchAvailable($key)
    {
        $lstDomain = $this->parseDomain($key);
        $params = $this->parseParams($lstDomain, true);
        $response = Common::callApi('post', 'https://www.hostinger.vn/api/domain-search', $params);
        return $response;
    }

    protected function searchPopular($key)
    {
        $lstDomain = $this->parseDomain($key);
        $params = $this->parseParams($lstDomain);
        $response = Common::callApi('post', 'https://www.hostinger.vn/api/domain-search', $params);
        return $response;
    }

    protected function searchSuggest($key)
    {
        list($name,) = $this->parseDomain($key);
        $params = [
            'domain' => $name,
            'tlds' => config('api.prefix_domains')
        ];
        $response = Common::callApi('post', 'https://www.hostinger.vn/api/domain-suggest', $params);
        return $response;
    }

    protected function parseDomain($key)
    {
        list($prefix, $name) = array_reverse(explode('.', $key));
        if (blank($name)) {
            $name = $prefix;
            $prefix = 'com';
        }
        return [$name, $prefix];
    }

    protected function parseParams($paramsDomain, $available = false)
    {
        list($name, $prefix) = $paramsDomain;
        $lstPrefix = array_flip(config('api.prefix_domains'));
        array_forget($lstPrefix, $prefix);
        $lstPrefix = array_flip($lstPrefix);
        $domain = join('.', [$name, $prefix]);

        return [
            'q' => $domain,
            'tldList' => $available ? [$prefix] : $lstPrefix,
            'tldMajor' => $available ? [$prefix] : $lstPrefix,
            'exactSearch' => false,
            'domainsToIgnore' => $available ? [] : [$domain],
            'promotionsDomainName' => $available ? '' : $name,
            'promoteDomains' => 1,
            'hcaptcha_token' => ''
        ];
    }
}
