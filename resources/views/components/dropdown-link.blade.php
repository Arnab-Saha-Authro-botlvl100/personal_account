{{-- <a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out']) }}>{{ $slot }}</a> --}}
<a {{ $attributes->merge(['class' => 'block w-full dropdown-link px-4 py-2 text-start text-sm font-medium 
    text-gray-700 rounded-lg transition duration-300 ease-in-out 
    bg-gradient-to-r from-white to-gray-50 hover:from-gray-100 hover:to-gray-200 
    hover:text-gray-900 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-300']) }}>
    {{ $slot }}
</a>
