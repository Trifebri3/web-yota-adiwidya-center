<?php

namespace App\Models;

use App\Enums\UserRole;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
protected $fillable = [
    'name',
    'email',
    'password',
    'nickname',
    'role',               // Tambahkan ini
    'membership_status',  // Tambahkan ini
    'division_id',        // Tambahkan ini jika menggunakan relasi
    'team_id',            // Tambahkan ini jika menggunakan relasi
    'gender',
    'dob',
    'pob',
    'phone_number',
    'citizenship',
    'domicile_address',
    'last_education',
    'main_skill',
    'emergency_contact_name',
    'emergency_contact_phone',
    'blood_type',
    'avatar', // Jika kolom foto profil bernama avatar
];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'role' => UserRole::class,
            'dob' => 'date',
            'joined_at' => 'date',
            'id_number' => 'encrypted',
        ];
    }


    public static function generateMemberId()
{
    $prefix = 'N.Y.C.A';
    $year = date('Y');

    // Hitung jumlah member yang sudah punya member_id di tahun ini
    $count = self::whereYear('created_at', $year)
        ->whereNotNull('member_id')
        ->count();

    // Mulai dari 05
    $number = 5 + $count;

    // Format 6 digit
    $formattedNumber = str_pad($number, 6, '0', STR_PAD_LEFT);

    return $prefix . '.' . $formattedNumber;
}
public function getAgeAttribute()
{
    return $this->date_of_birth ? $this->date_of_birth->age : '-';
}

public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    /**
     * RELASI: User belongs to a Team (Bidang)
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * HELPER: Cek apakah user adalah Kabid di divisi tertentu
     * Digunakan untuk delegasi akses penuh kabid.
     */
    public function isKabidOf($divisionId)
    {
        return $this->role === 'kabid' && $this->division_id == $divisionId;
    }

    /**
     * HELPER: Cek apakah user bagian dari Admin/OMC
     */
    public function isStaff()
    {
        return in_array($this->role, ['admin', 'omc', 'direktur']);
    }
    // Tambahkan ini di dalam class User
public function agendaPresences()
{
    return $this->hasMany(AgendaPresence::class);
}

/**
 * Mendapatkan agenda yang akan datang untuk user ini
 */
public function getUpcomingAgendasAttribute()
{
    return $this->agendaPresences()
                ->whereHas('agenda', function($q) {
                    $q->where('start_time', '>', now());
                })
                ->with('agenda')
                ->get();
}

public function workspaces(): BelongsToMany
    {
        // Parameter kedua adalah nama tabel pivot yang kita buat tadi
        return $this->belongsToMany(Workspace::class, 'workspace_user');
    }

    /**
 * Cek apakah user adalah Direktur
 */
public function isDirektur(): bool
{
    // Sesuaikan dengan Enum Role kamu
    return $this->role->value === 'direktur';
}

public function identity() { return $this->hasOne(Identity::class); }
public function skills() { return $this->hasMany(Skill::class); }
public function experiences() { return $this->hasMany(Experience::class); }
public function educations() { return $this->hasMany(Education::class); }
public function nonFormalEducations() { return $this->hasMany(NonFormalEducation::class); }
public function portfolios() { return $this->hasMany(Portfolio::class); }
public function organizations() { return $this->hasMany(PortfolioOrganization::class); }
public function achievements() { return $this->hasMany(Achievement::class); }
public function certifications() { return $this->hasMany(Certification::class); }
public function socialLinks() { return $this->hasMany(SocialLink::class); }
public function additionalSkills() { return $this->hasMany(AdditionalSkill::class); }



/**
 * Tugas personal yang diterima user
 */
public function personalTasks()
{
    return $this->hasMany(KabidTask::class, 'user_id');
}

/**
 * Tugas tim yang harus dikerjakan user (jika user punya team_id)
 */
public function teamTasks()
{
    return KabidTask::where('team_id', $this->team_id);
}

public function sentReports(): \Illuminate\Database\Eloquent\Relations\HasMany
{
    return $this->hasMany(LaporanBidang::class, 'user_id');
}
}
