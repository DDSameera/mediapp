<?php

namespace App\Policies\Api\v1;

use App\Models\Api\v1\Medicine;
use App\Models\Api\v1\User;
use Illuminate\Support\Facades\Gate;

class MedicinePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; //All users can query medicine records
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Medicine $medicine): bool
    {
        return true; //All users can query medicine records
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

        return in_array($user->role->name, ["superadmin", "owner"]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Medicine $medicine): bool
    {
        return in_array($user->role->name, ["superadmin", "owner", "cashier", "manager"]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return in_array($user->role->name, ["superadmin", "manager",]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Medicine $medicine): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Medicine $medicine): bool
    {
        return in_array($user->role->name, ["superadmin", "owner"]);
    }
}
