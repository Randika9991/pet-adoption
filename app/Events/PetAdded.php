<?php

namespace App\Events;

use App\Models\Pet;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PetAdded
{
    use Dispatchable, SerializesModels;

    public $pet;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pet $pet)
    {
        $this->pet = $pet;
    }
}

                                                            //laravel Events

// Laravel එකේ Events කියන්නේ Observer design pattern එක ක්‍රියාත්මක කිරීමට ඉස්සරහට දකින්න පුළුවන් ක්‍රමයක්.
// මෙකෙන් ඔබට ඔබේ application එක තුළ සිදුවන විවිධ ක්‍රියාකාරකම් සවිකරවා ඔවුන්ට ප්‍රතිචාර දක්වනවාට ඉඩ දෙනවා.
//
// Events කියන්නේ system එකේ විවිධ කොටස් වෙනම වෙනම ක්‍රියාත්මක කිරීම සඳහා ශක්තිමත් ක්‍රමයක්.
// ඔබේ application එකේ දී කිසියම් ක්‍රියාවක් සිදුවන විට (උදාහරණයක් වශයෙන්, user එකක් ලියාපදිංචි වීම හෝ order එකක් ලබාගැනීම)
// event එකක් trigger කළ හැකි අතර, listener ගණනාවක් event එකට ප්‍රතිචාර දක්වන්න පුළුවන්, ඒ මූලික logic එක වෙනස් නොකර.
//
// උදාහරණයක් (Example Use Case):
// User එකක් ඔබේ website එකේ register වුනා කියලා හිතන්න.
//
// - Welcoming email එකක් යවන්න.
// - Registration time එක log කරන්න.
// - Admin එකට notification එකක් යවන්න.

