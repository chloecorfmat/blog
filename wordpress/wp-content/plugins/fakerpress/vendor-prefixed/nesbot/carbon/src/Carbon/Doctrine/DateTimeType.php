<?php

/**
 * Thanks to https://github.com/flaushi for his suggestion:
 * https://github.com/doctrine/dbal/issues/2873#issuecomment-534956358
 *
 * @license MIT
 * Modified by Gustavo Bordoni on 21-April-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */
namespace FakerPress\ThirdParty\Carbon\Doctrine;

use FakerPress\ThirdParty\Carbon\Carbon;
use Doctrine\DBAL\Types\VarDateTimeType;

class DateTimeType extends VarDateTimeType implements CarbonDoctrineType
{
    /** @use CarbonTypeConverter<Carbon> */
    use CarbonTypeConverter;
}
