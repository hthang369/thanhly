<?php

namespace Modules\Home\Presenters;

use Nwidart\Menus\Presenters\Bootstrap\NavbarPresenter;

class SidebarBootstrap4Presenter extends NavbarPresenter
{
    public function getOpenTagWrapper()
    {
        return PHP_EOL . '<ul class="nav flex-column">' . PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '<li class="nav-item border"' . $this->getActiveState($item) . '><a href="' . $item->getUrl() . '" ' . $item->getAttributes() . '>' . $item->getIcon() . ' ' . $item->title . '</a></li>' . PHP_EOL;
    }
}
