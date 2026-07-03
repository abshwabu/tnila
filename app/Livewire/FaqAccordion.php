<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class FaqAccordion extends Component
{
    public string $category = 'all';

    public ?int $openFaqId = null;

    public function updatedCategory(): void
    {
        $this->openFaqId = null;
    }

    public function toggle(int $faqId): void
    {
        $this->openFaqId = $this->openFaqId === $faqId ? null : $faqId;
    }

    public function render()
    {
        $faqs = Faq::query()->orderBy('category')->orderBy('order')->get();

        $categories = $faqs->pluck('category')->unique()->values();

        $filteredFaqs = $this->category === 'all'
            ? $faqs
            : $faqs->where('category', $this->category)->values();

        return view('livewire.faq-accordion', [
            'faqs' => $filteredFaqs,
            'categories' => $categories,
        ]);
    }
}
