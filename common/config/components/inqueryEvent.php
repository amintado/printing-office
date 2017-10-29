<?php
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

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 10/28/2017
 * Time: 10:16 AM
 */

namespace common\config\components;


use amintado\inquery\EventInterface;

class inqueryEvent implements EventInterface
{
public static function afterAnswer($model)
{
    // TODO: Implement afterAnswer() method.
}
public static function afterCreate($model)
{
    return null;
}
public static function afterViewed($model)
{
    // TODO: Implement afterViewed() method.
}
public static function CreateError($model)
{
    // TODO: Implement CreateError() method.
}
public static function AnswerError($model)
{
    // TODO: Implement AnswerError() method.
}
}