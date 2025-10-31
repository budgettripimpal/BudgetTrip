<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center w-full px-4 py-3 
                bg-blue-900 border border-transparent rounded-lg 
                font-semibold text-sm text-white uppercase tracking-widest 
                hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 
                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>