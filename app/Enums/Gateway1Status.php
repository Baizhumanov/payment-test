<?php

namespace App\Enums;

enum Gateway1Status: string
{
    case NEW = "new";
    case PENDING = "pending";
    case COMPLETED = "completed";
    case EXPIRED = "expired";
    case REJECTED = "rejected";
}
