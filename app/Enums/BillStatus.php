<?php

namespace App\Enums;

enum BillStatus:string {
    case Sold = '1';
    case Exported = '2';
    case Delivered = '3';
}
