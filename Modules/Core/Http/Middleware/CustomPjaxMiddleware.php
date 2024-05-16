<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Pjax\Middleware\FilterIfPjax;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class CustomPjaxMiddleware extends FilterIfPjax
{
    public function handle(Request $request, Closure $next): BaseResponse
    {
        $response = $next($request);
        
        if (! $request->pjax() || $response->isRedirection() || blank($request->user())) {
            return $response;
        }
        
        $this->filterResponse($response, $request->header('X-PJAX-Selectors'))
            ->setUriHeader($response, $request)
            ->setVersionHeader($response, $request);

        return $response;
    }

    protected function filterResponse(BaseResponse $response, $container): self
    {
        $crawler = $this->getCrawler($response);

        $html = '';
        foreach(json_decode($container) as $item) {
            $html .= $this->fetchContainer($crawler, $item);
        }

        $response->setContent(
            $this->makeTitle($crawler).
            $html
        );

        return $this;
    }

    protected function fetchContainer(Crawler $crawler, $container): string
    {
        $content = $crawler->filter($container);
        
        if (! $content->count()) {
            abort(422);
        }

        return $content->outerHtml();
    }
}
