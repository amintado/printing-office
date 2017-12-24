/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

jQuery('#mainform').yiiActiveForm([{
    "id": "product-title",
    "name": "title",
    "container": ".field-product-title",
    "input": "#product-title",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {
            "message": "نام محصول باید یک رشته باشد.",
            "max": 255,
            "tooLong": "نام محصول حداکثر باید شامل 255 کارکتر باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {"message": "نام محصول نمی‌تواند خالی باشد."});
    }
}, {
    "id": "product-description",
    "name": "description",
    "container": ".field-product-description",
    "input": "#product-description",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {"message": "توضیحات باید یک رشته باشد.", "skipOnEmpty": 1});
        yii.validation.required(value, messages, {"message": "توضیحات نمی‌تواند خالی باشد."});
    }
}, {
    "id": "product-category",
    "name": "category",
    "container": ".field-product-category",
    "input": "#product-category",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "دسته باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "product-lock",
    "name": "lock",
    "container": ".field-product-lock",
    "input": "#product-lock",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "Lock باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "product-specification",
    "name": "specification",
    "container": ".field-product-specification",
    "input": "#product-specification",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {"message": "مشخصات باید یک رشته باشد.", "skipOnEmpty": 1});
    }
}, {
    "id": "product-technical_specification",
    "name": "technical_specification",
    "container": ".field-product-technical_specification",
    "input": "#product-technical_specification",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {"message": "مشخصات فنی باید یک رشته باشد.", "skipOnEmpty": 1});
    }
}, {
    "id": "product-status",
    "name": "status",
    "container": ".field-product-status",
    "input": "#product-status",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "وضعیت باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
    }
}], []);
})
;