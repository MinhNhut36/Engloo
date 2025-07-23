<?php

namespace App\Enum;

enum enrollment: int
{
    // đã hoàn thành: 0 , đang học: 1, đạt:2, không đạt:3
    case completed = 1;
    case studying = 2;
    case pass = 3;
    case fail =4;

    public function getEnrollment(): string
    {
        return match ($this) {
            self::completed => 'Đã hoàn thành',
            self::studying => 'Đang học',
            self::pass => 'Đạt',
            self::fail => 'Không đạt',
        };
    }

    public function getStatus(): string
    {
        return match ($this) {
            self::studying => 'card-status-studying',
            self::pass => 'card-status-pass',
            self::fail => 'card-status-fail',
        };
    }
}
