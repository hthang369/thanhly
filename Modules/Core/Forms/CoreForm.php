<?php
namespace Modules\Core\Forms;

use Laka\Core\Forms\Form;
use Nwidart\Modules\Facades\Module;

abstract class CoreForm extends Form
{
    protected $groupLangKey = '';
    protected $groupModuleKey = '';

    public function __construct()
    {
        parent::__construct();
        $this->groupModuleKey = Module::actived();
        $this->setLanguageName($this->getGroupKey([$this->groupLangKey]));
    }

    private function getGroupKey($params)
    {
        return join('::', [$this->groupModuleKey, join('.', $params)]);
    }

    public function getTitle()
    {
        $action = $this->formOptions['action'];
        $tranlator = trans();
        $groupKey = "{$this->languageName}.form_title";
        if (!$tranlator->has($groupKey)) {
            $groupKey = $this->getGroupKey(['common', 'form_title', $this->groupLangKey]);
        }

        return $tranlator->get("{$groupKey}.{$action}");
    }
}