<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // guard_name defaults to "web" (Spatie), permissions()/users relations come from the parent.
}
