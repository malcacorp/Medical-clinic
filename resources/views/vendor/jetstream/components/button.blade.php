<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-brand text-uppercase']) }}>
    {{ $slot }}
</button>
