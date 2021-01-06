<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
        <img {{ $attributes->merge(['src' => $path, 'class' => 'card-img-top', 'alt' => '']) }} />
        <a href={{route('seller.products')}} class="card-link"> Edit </a>
        <a href={{route('seller.products')}} class="card-link"> Delete </a>
    </div>
</div>
