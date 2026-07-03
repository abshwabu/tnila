<?php

namespace App\Livewire;

use App\Models\Industry;
use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProjectFilter extends Component
{
    #[Url(as: 'industry')]
    public string $industrySlug = '';

    public function mount(string $industrySlug = ''): void
    {
        $this->industrySlug = $industrySlug;
    }

    public function render()
    {
        $industries = Industry::query()->orderBy('name')->get();

        $projects = Project::query()
            ->with('industry')
            ->when(
                $this->industrySlug !== '',
                fn ($query) => $query->whereHas('industry', fn ($industryQuery) => $industryQuery->where('slug', $this->industrySlug))
            )
            ->latest('updated_at')
            ->get();

        return view('livewire.project-filter', [
            'industries' => $industries,
            'projects' => $projects,
        ]);
    }
}
