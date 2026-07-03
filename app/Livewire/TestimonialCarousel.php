<?php

namespace App\Livewire;

use App\Models\Testimonial;
use Livewire\Component;

class TestimonialCarousel extends Component
{
    public int $index = 0;

    public function next(): void
    {
        $count = $this->testimonials()->count();

        if ($count > 0) {
            $this->index = ($this->index + 1) % $count;
        }
    }

    public function previous(): void
    {
        $count = $this->testimonials()->count();

        if ($count > 0) {
            $this->index = $this->index === 0 ? $count - 1 : $this->index - 1;
        }
    }

    public function select(int $index): void
    {
        $this->index = $index;
    }

    public function render()
    {
        $testimonials = $this->testimonials();
        $current = $testimonials->isNotEmpty() ? $testimonials[$this->index % $testimonials->count()] : null;

        return view('livewire.testimonial-carousel', [
            'testimonials' => $testimonials,
            'current' => $current,
        ]);
    }

    protected function testimonials()
    {
        return Testimonial::query()
            ->where('approved', true)
            ->with(['customer', 'project'])
            ->orderByDesc('featured')
            ->orderByDesc('id')
            ->take(8)
            ->get();
    }
}
