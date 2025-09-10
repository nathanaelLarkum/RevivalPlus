<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-c1 dark:bg-d1 border border-transparent rounded-md font-semibold text-xs text-c3 dark:text-d4 uppercase tracking-widest hover:bg-ch1 dark:hover:bg-dh1 focus:bg-ch1 dark:focus:bg-dh1 active:bg-ch1 dark:active:bg-dh1 focus:outline-none focus:ring-2 focus:ring-c1 focus:ring-offset-2 dark:focus:ring-offset-d3 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
