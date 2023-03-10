<?php
namespace Modules\Admin\Enums;

use Laka\Core\Enums\BaseEnum;

class AttributesField extends BaseEnum
{
    const FIELD_IMAGE = 'attribute_images';
    const FIELD_ATTRIBUTE = 'attribute_attributes';
    const FIELD_VARIANT = 'attribute_variants';
    const FIELD_PREVIEW = 'attribute_preview';

    static $FIELDS_MAP = [
        self::FIELD_IMAGE => AttributesGroup::GROUP_IMAGE,
        self::FIELD_ATTRIBUTE => AttributesGroup::GROUP_ATTRIBUTE,
        self::FIELD_VARIANT => AttributesGroup::GROUP_VARIANT,
        self::FIELD_PREVIEW => AttributesGroup::GROUP_PREVIEW,
    ];
}