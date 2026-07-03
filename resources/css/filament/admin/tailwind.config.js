import preset from '../../../../vendor/filament/filament/tailwind.config.preset';

export default {
    presets: [preset],
    content: [
        './app/Filament/Resources/**/*.php',
        './app/Filament/Widgets/**/*.php',
        './app/Filament/Pages/**/*.php',
        './resources/views/components/**/*.blade.php',
        './resources/views/livewire/**/*.blade.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
};

