<?php

namespace App\Policies;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RegistrationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Hanya admin dan super_admin yang dapat melihat daftar pendaftaran
        return $user->hasRole(['admin', 'super_admin']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Registration $registration): bool
    {
        // Admin, super_admin, dan orang tua yang membuat pendaftaran dapat melihat detail
        return $user->hasRole(['admin', 'super_admin']) || 
               ($user->hasRole('parent') && $registration->user_id === $user->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Semua user (terutama orang tua) dapat membuat pendaftaran
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Registration $registration): bool
    {
        // Hanya admin dan super_admin yang dapat mengubah status pendaftaran
        return $user->hasRole(['admin', 'super_admin']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Registration $registration): bool
    {
        // Hanya admin dan super_admin yang dapat menghapus pendaftaran
        return $user->hasRole(['admin', 'super_admin']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Registration $registration): bool
    {
        // Hanya admin dan super_admin yang dapat memulihkan pendaftaran yang dihapus
        return $user->hasRole(['admin', 'super_admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Registration $registration): bool
    {
        // Hanya super_admin yang dapat menghapus permanen pendaftaran
        return $user->hasRole('super_admin');
    }
}
