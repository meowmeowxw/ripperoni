<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
        <img {{ $attributes->merge(['src' => $path, 'class' => 'card-img-top', 'alt' => '']) }} />
        <button {{ $attributes->merge([
                'class' => 'btn btn-primary',
                'type' => 'button',
                'data-toggle' => 'collapse',
                'data-target' => '#collapse'.$id,
                'aria-expanded' => 'false',
                'aria-controls' => 'collapseButton'
                ]) }}>
            {{__('Edit')}}
        </button>
        <a {{ $attributes->merge(['href' => route('seller.products', $id), 'class' => 'btn btn-primary']) }}>
            Delete </a>
        <div {{ $attributes->merge(['class' => 'collapse', 'id' => 'collapse'.$id]) }}>
            <div class="card card-body">
                <form method="POST" action="{{route('seller.product.edit')}}">
                    @csrf

                    <x-formInput message="name" :lblName="__('Name')" :name="$name" type="text"/>
                    <x-formInput message="description" :lblName="__('Description')" :name="$description" type="text"/>
                    <x-formInput message="price" :lblName="__('Price')" :name="$price" type="number"/>
                    <x-formInput message="quantity" :lblName="__('Quantity')" :name="$quantity" type="number"/>

                    <div class="form-group row mb-0">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                    <input {{ $attributes->merge(['id' => 'product_id', 'name' => 'id', 'type' => 'hidden', 'value' => $id]) }} />
                </form>
            </div>

        </div>
    </div>
</div>
