<?php

namespace Modules\Home\Presenters;

use Collective\Html\HtmlFacade as Html;
use Laka\Core\Presenters\BaseMenuPresenter;

class NavMenuBootstrap4Presenter extends BaseMenuPresenter
{
    protected $wrapperAttrs = [
        'class' => 'nav navmenu-nav'
    ];
    protected $dropdownAttrs = [
        'class' => 'collapse nav navmenu-nav'
    ];
    protected $exceptAttributes = ['link', 'link_name'];
    
    protected function getMenuDropdownUrl($item)
    {
        return '#'.$this->getDropdownUrl($item);
    }

    public function getMenuWithDropDownWrapper($item)
    {
        $this->elementAttrs['class'] = 'nav-item dropdown';
        return parent::getMenuWithDropDownWrapper($item);
    }

    public function getMultiLevelDropdownWrapper($item)
    {
        $this->elementAttrs['class'] = 'nav-item dropdown';
        return parent::getMultiLevelDropdownWrapper($item);
    }

    protected function getMenuDropdownWrapper($item)
    {
        $this->dropdownAttrs['id'] = $this->getDropdownUrl($item);
        return parent::getMenuDropdownWrapper($item);
    }

    protected function getMenuDropdownAttributes($item, $active)
    {
        $atributes = $this->getAttributes($item);
        $atributes['class'] .= $active.' dropdown-toggle';
        $atributes['data-toggle'] = 'collapse';
        return Html::attributes($atributes);
    }

    protected function getDropdownUrl($item)
    {
        return data_get($item->getProperties(), 'attributes.link_name');
    }
}
