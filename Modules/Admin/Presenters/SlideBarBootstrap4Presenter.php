<?php

namespace Modules\Admin\Presenters;

use Collective\Html\FormFacade;
use Nwidart\Menus\Presenters\Presenter;

/**
 * Class BasePresenter.
 *
 * @package namespace Modules\Core\Presenters;
 */
class SlideBarBootstrap4Presenter extends Presenter
{
    /**
     * {@inheritdoc }.
     */
    public function getOpenTagWrapper()
    {
        return '<ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">';
    }

    /**
     * {@inheritdoc }.
     */
    public function getCloseTagWrapper()
    {
        return '</ul>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        $attributes = preg_replace('/class="(\S+)"/', 'class="$1 '.$this->getActiveState($item, ' active').'"', $item->getAttributes());
        return '<li class="nav-item">
                <a href="' . $item->getUrl() . '" ' . $attributes . '>' . $item->getIcon() . ' <p class="d-inline">' . $item->title . '</p></a>
            </li>' . PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getActiveState($item, $state = ' class="active"')
    {
        return $item->isActive() ? $state : null;
    }

    /**
     * Get active state on child items.
     *
     * @param $item
     * @param string $state
     *
     * @return null|string
     */
    public function getActiveStateOnChild($item, $state = 'active')
    {
        return $item->hasActiveOnChild() ? $state : null;
    }

    /**
     * {@inheritdoc }.
     */
    public function getDividerWrapper()
    {
        return '<li class="divider"></li>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getHeaderWrapper($item)
    {
        return '<li class="dropdown-header">' . $item->title . '</li>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return '<li class="nav-item' . $this->getActiveStateOnChild($item, ' active') . '">
		          <a href="#'.$item->attributes['id'].'" class="nav-link">
					' . $item->getIcon() . ' <p class="d-inline">' . $item->title . '</p>
                    <i class="nav-arrow bi bi-chevron-right"></i>
			      </a>
			      <ul class="nav nav-treeview" id="'.$item->attributes['id'].'">
			      	' . $this->getChildMenuItems($item) . '
			      </ul>
		      	</li>'
        . PHP_EOL;
    }

    /**
     * Get multilevel menu wrapper.
     *
     * @param \Nwidart\Menus\MenuItem $item
     *
     * @return string`
     */
    public function getMultiLevelDropdownWrapper($item)
    {
        return '<li class="nav-item dropdown' . $this->getActiveStateOnChild($item, ' active') . '">
		          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					' . $item->getIcon() . ' ' . $item->title . '
			      	<b class="caret pull-right caret-right"></b>
			      </a>
			      <ul class="dropdown-menu">
			      	' . $this->getChildMenuItems($item) . '
			      </ul>
		      	</li>'
        . PHP_EOL;
    }
}
