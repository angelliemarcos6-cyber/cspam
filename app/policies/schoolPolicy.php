public function viewAny(User $user): bool
{
    return $user->hasAnyRole(['SMM&E Monitor', 'Division Admin', 'School Head']);
}

public function view(User $user, School $school): bool
{
    if ($user->hasRole('School Head')) {
        return $user->school_id === $school->id;
    }
    return true; // monitor sees all
}
