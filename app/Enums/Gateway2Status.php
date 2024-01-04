<?php

namespace App\Enums;

enum Gateway2Status: string
{
    case CREATED = 'created';
    case IN_PROGRESS = 'inprogress';
    case PAID = 'paid';
    case EXPIRED = 'expired';
    case REJECTED = 'rejected';

    // В таблице даны одни статусы, а пример запроса применяет другой статус
    case COMPLETED = 'completed';
}
