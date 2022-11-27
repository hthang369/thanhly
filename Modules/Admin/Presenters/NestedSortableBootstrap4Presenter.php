<?php

namespace Modules\Admin\Presenters;

use Collective\Html\FormFacade;
use Laka\Core\Presenters\BaseMenuPresenter;

/**
 * Class BasePresenter.
 *
 * @package namespace Modules\Core\Presenters;
 */
class NestedSortableBootstrap4Presenter extends BaseMenuPresenter
{
    protected $wrapperTag = 'ol';
    protected $wrapperAttrs = [
        'class' => 'nav-menu sortable'
    ];
    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        $itemId = data_get($item->attributes, 'id');
        return
            '<li class="nav-item" id="'.$itemId.'">
                <div class="nav-link">
                    <span class="handle pr-2"><i class="fa fa-ellipsis-v"></i></span>
                    <span class="item_title">'.$item->title.'</span>
                    <span class="lft" id=""></span>
                </div>
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
        $itemId = data_get($item->attributes, 'id');
        return '<li class="nav-item" id="'.$itemId.'">
                    <div class="nav-link">
                        <span class="handle pr-2"><i class="fa fa-ellipsis-v"></i></span>
                        <span class="item_title">'.$item->title.'</span>
                        <span class="lft" id=""></span>
                    </div>
                    <ol class="nav-menu">
                        ' . $this->getChildMenuItems($item) . '
                    </ol>
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
        return '<li class="nav-item' . $this->getActiveStateOnChild($item, ' active') . '">
		          <a href="#" class="nav-link">
					' . $item->getIcon() . ' ' . $item->title . '
			      	<b class="caret pull-right caret-right"></b>
			      </a>
			      <ul class="nav flex-column">
			      	' . $this->getChildMenuItems($item) . '
			      </ul>
		      	</li>'
        . PHP_EOL;
    }
}
