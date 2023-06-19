<?php 

namespace App\Enums;
 
enum OrderStatusEnum:string {
    case Open = 'open';
    case Closed = 'closed';
    case Inactive = 'inactive';
    case Rejected = 'rejected';
}