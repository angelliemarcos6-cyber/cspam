<?p

protected $fillable = [
    'lrn', 'first_name', 'middle_name', 'last_name',
    'sex', 'birthdate', 'section_id',
];

public function section()
{
    return $this->belongsTo(Section::class);
}
