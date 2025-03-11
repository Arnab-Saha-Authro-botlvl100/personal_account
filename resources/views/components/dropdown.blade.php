{{-- @props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div> --}}

@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-2 bg-white/90 backdrop-blur-md shadow-lg'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp
<style>
    /* Dropdown background gradient */
    .dropdown-open {
        background: linear-gradient(135deg, rgba(253, 223, 122, 0.6), rgba(196, 72, 72, 0.4));
        backdrop-filter: blur(10px);
        transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    /* Dropdown links */
    .dropdown-link {
        text-align: right; /* Align text to the right */
        font-weight: bold;
        color: rgba(0, 0, 0, 0.989);
        padding: 10px 15px;
        display: block;
        position: relative;
        transition: color 0.3s ease-in-out;
    }

    /* Hover effect with border-bottom animation */
    .dropdown-link::after {
        content: '';
        display: block;
        width: 0;
        height: 3px;
        background: white;
        position: absolute;
        bottom: 0;
        right: 0;
        transition: width 0.3s ease-in-out;
    }

    .dropdown-link:hover {
        color: #fff;
    }

    .dropdown-link:hover::after {
        width: 100%;
        left: 0;
    }
</style>

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open" class="cursor-pointer transition duration-300 hover:scale-105">
        {{ $trigger }}
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 scale-90 translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-90 translate-y-2"
         class="absolute z-50 mt-2 {{ $width }} rounded-xl shadow-2xl {{ $alignmentClasses }} dropdown-open"
         style="display: none;"
         @click="open = false">
        <div class="rounded-xl ring-1 ring-black/10 {{ $contentClasses }} border border-white/20 transition duration-300 hover:shadow-xl p-2">
            {{ $content }}
        </div>
    </div>
</div>

