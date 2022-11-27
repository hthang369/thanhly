<?php

namespace Modules\Home\Presenters;

use Collective\Html\FormFacade;
use Nwidart\Menus\Presenters\Presenter;

/**
 * Class BasePresenter.
 *
 * @package namespace Modules\Core\Presenters;
 */
class NavbarBootstrap4Presenter extends Presenter
{
    /**
     * {@inheritdoc }.
     */
    public function getOpenTagWrapper()
    {
        return PHP_EOL .
            FormFacade::button('<span class="navbar-toggler-icon"></span>', ['class' => 'navbar-toggler',
                'data-toggle' => 'collapse', 'data-target' => '#navbarContent',
                'aria-controls' => 'navbarContent',
                'aria-expanded' => 'false', 'aria-label' => 'Toggle navigation']) .
            '<div class="collapse navbar-collapse" id="navbarContent">' .
            '<ul class="navbar-nav mr-auto">' .
             PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getCloseTagWrapper()
    {
        return PHP_EOL . '</ul></div>' . PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '<li class="nav-item' . $this->getActiveState($item, ' active') . '"><a href="' . $item->getUrl() . '" ' . $item->getAttributes() . '>' . $item->getIcon() . ' ' . $item->title . '</a></li>' . PHP_EOL;
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
        return '<li class="nav-item dropdown' . $this->getActiveStateOnChild($item, ' active') . '">
		          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					' . $item->getIcon() . ' ' . $item->title . '
			      	<b class="caret"></b>
			      </a>
			      <ul class="dropdown-menu">
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
